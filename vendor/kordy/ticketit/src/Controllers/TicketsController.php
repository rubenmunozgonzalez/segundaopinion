<?php
namespace Kordy\Ticketit\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Input;
use Kordy\Ticketit\Models;
use Kordy\Ticketit\Models\Agent;
use Kordy\Ticketit\Models\Category;
use Kordy\Ticketit\Models\Setting;
use Kordy\Ticketit\Models\Ticket;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;

class TicketsController extends Controller
{
    protected $tickets;
    protected $agent;

    public function __construct(Ticket $tickets, Agent $agent)
    {
        $this->middleware('Kordy\Ticketit\Middleware\ResAccessMiddleware', ['only' => ['show']]);
        $this->middleware('Kordy\Ticketit\Middleware\IsAgentMiddleware', ['only' => ['edit', 'update']]);
        $this->middleware('Kordy\Ticketit\Middleware\IsAdminMiddleware', ['only' => ['destroy']]);

        $this->tickets = $tickets;
        $this->agent = $agent;
    }

    public function data(Datatables $datatables, $complete = false)
    {
        $user = $this->agent->find(auth()->user()->id);

        if ($user->isAdmin()) {
            if ($complete) {
                $collection = Ticket::complete();
            } else {
                $collection = Ticket::active();
            }
        } elseif ($user->isAgent()) {
            if ($complete) {
                $collection = Ticket::complete()->agentUserTickets($user->id);
            } else {
                $collection = Ticket::active()->agentUserTickets($user->id);
            }
        } else {
            if ($complete) {
                $collection = Ticket::userTickets($user->id)->complete();
            } else {
                $collection = Ticket::userTickets($user->id)->active();
            }
        }

        $collection
            ->join('users', 'users.id', '=', 'ticketit.user_id')
            ->join('ticketit_statuses', 'ticketit_statuses.id', '=', 'ticketit.status_id')
            ->join('ticketit_priorities', 'ticketit_priorities.id', '=', 'ticketit.priority_id')
            ->join('ticketit_categories', 'ticketit_categories.id', '=', 'ticketit.category_id')
            ->join('ticketit_categories as ticketit_units', 'ticketit_units.id', '=', 'ticketit.unit_id')
            ->select([
                'ticketit.id',
                'ticketit.subject AS subject',
                'ticketit_statuses.name AS status',
                'ticketit_statuses.color AS color_status',
                'ticketit_priorities.color AS color_priority',
                'ticketit_categories.color AS color_category',
                'ticketit.id AS agent',
                'ticketit.updated_at AS updated_at',
                'ticketit_priorities.name AS priority',
                'users.name AS owner',
                'ticketit.agent_id',
                'ticketit_categories.name AS category',
                'ticketit_units.name AS unit',
            ]);

        $collection = $datatables->of($collection);

        $this->renderTicketTable($collection);
        Carbon::setLocale('es');
        $collection->editColumn('updated_at', '{!! \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $updated_at)->diffForHumans() !!}');

        return $collection->make(true);
    }

    public function renderTicketTable(EloquentEngine $collection)
    {
        $collection->editColumn('subject', function ($ticket) {
            return (string) link_to_route(
                Setting::grab('main_route').'.show',
                $ticket->subject,
                $ticket->id
            );
        });

        $collection->editColumn('status', function ($ticket) {
            $color = $ticket->color_status;
            $status = $ticket->status;

            return "<div style='color: $color'>$status</div>";
        });

        $collection->editColumn('priority', function ($ticket) {
            $color = $ticket->color_priority;
            $priority = $ticket->priority;

            return "<div style='color: $color'>$priority</div>";
        });

        $collection->editColumn('category', function ($ticket) {
            $color = $ticket->color_category;
            $category = $ticket->category;

            return "<div style='color: $color'>$category</div>";
        });

        $collection->editColumn('agent', function ($ticket) {
            $ticket = $this->tickets->find($ticket->id);

            return $ticket->agent->name;
        });

        return $collection;
    }

    /**
     * Display a listing of active tickets related to user.
     *
     * @return Response
     */
    public function index()
    {
        $complete = false;
        return view('ticketit::index', compact('complete'));
    }

    /**
     * Display a listing of completed tickets related to user.
     *
     * @return Response
     */
    public function indexComplete()
    {
        $complete = true;

        return view('ticketit::index', compact('complete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (version_compare(app()->version(), '5.2.0', '>=')) {
            $priorities = Models\Priority::pluck('name', 'id');
            $categories = Models\Category::where('name', 'NOT LIKE', 'Unidad%')->pluck('name', 'id');
            $units = Models\Category::where('name', 'LIKE', 'Unidad%')->pluck('name', 'id');
        } else { // if Laravel 5.1
            $priorities = Models\Priority::lists('name', 'id');
            $categories = Models\Category::where('name', 'NOT LIKE', 'Unidad%')->lists('name', 'id');
            $units = Models\Category::where('name', 'LIKE', 'Unidad%')->lists('name', 'id');
        }

        return view('ticketit::tickets.create', compact('priorities', 'categories', 'units'));
    }

    /**
     * Store a newly created ticket and auto assign an agent for it.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
         $rules = [
            'subject'      => 'required',
            'content'      => 'required',
            'captcha'      => 'required|captcha',
            //'priority_id'  => 'required|exists:ticketit_priorities,id',
            'category_id'  => 'required|exists:ticketit_categories,id',
            'unit_id'      => 'required|exists:ticketit_categories,id',
            'symptoms'     => '',
            'since'        => '',
            'cause'        => '',
            'reason'       => '',
            'trigger'      => '',
            'intensity'    => '',
            'consecuences' => '',
            'reported'     => 'boolean',
            'tests'        => '',
            'treatments'   => '',
            'diagnostic'   => '',
            'attachments'  => '',
            'results'      => '',
            'suggested'    => ''];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            die(var_dump($validator->messages()));
            return redirect('/consultas/create')
                            ->withInput()
                            ->withErrors($validator,'ticket');
        }

        $ticket = new Ticket();

        $ticket->subject = $request->subject;

        $ticket->setPurifiedContent($request->get('content'));

        $ticket->symptoms = $request->symptoms;
        $ticket->since = $request->since;
        $ticket->cause = $request->cause;
        $ticket->reason = $request->reason;
        $ticket->trigger = $request->trigger;
        $ticket->intensity = $request->intensity;
        $ticket->consequences = $request->consequences;
        $ticket->reported = $request->reported;
        $ticket->tests = $request->tests;
        $ticket->treatments = $request->treatments;
        $ticket->diagnostic = $request->diagnostic;
        $ticket->results = $request->results;
        $ticket->suggested = $request->suggested;


        $ticket->priority_id = 2;
        $ticket->category_id = $request->category_id;
        $ticket->unit_id = $request->unit_id;

        $ticket->status_id = Setting::grab('default_status_id');
        $ticket->user_id = auth()->user()->id;
        $ticket->autoSelectAgent();

        $ticket->attachments = '';

        $ticket->save();

        foreach ($request->attachments as $file){
            if ($file) {
                $file->move('storage/informes/'.$ticket->id,$file->getClientOriginalName());
                $ticket->attachments .= '<a href="'.$ticket->id.'/download/'.$file->getClientOriginalName().'">'.$file->getClientOriginalName().'</a><br>';
            }
        }

        $ticket->save();

        session()->flash('status', trans('ticketit::lang.the-ticket-has-been-created'));
        session()->put('ticketid', $ticket->id);
        session()->put('price', Setting::grab('ticket_cost'));

        return redirect('consultas/'.$ticket->id);
        //return redirect()->action('\Kordy\Ticketit\Controllers\TicketsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ticket = $this->tickets->find($id);

        if (version_compare(app()->version(), '5.3.0', '>=')) {
            $status_lists = Models\Status::pluck('name', 'id');
            $priority_lists = Models\Priority::pluck('name', 'id');
            $category_lists = Models\Category::pluck('name', 'id');
        } else { // if Laravel 5.1
            $status_lists = Models\Status::lists('name', 'id');
            $priority_lists = Models\Priority::lists('name', 'id');
            $category_lists = Models\Category::lists('name', 'id');
        }

        $close_perm = $this->permToClose($id);
        $reopen_perm = $this->permToReopen($id);

        $cat_agents = Models\Agent::lists('name', 'id');
        //die(var_dump($cat_agents));
        //if (is_array($cat_agents)) {
            $agent_lists =  $cat_agents;

        //} else {
            //$agent_lists = ['auto' => 'Auto Select'];
        //}

        $comments = $ticket->comments()->paginate(Setting::grab('paginate_items'));

        //session()->flash('status', trans('ticketit::lang.the-ticket-has-been-created'));
        session()->put('ticketid', $ticket->id);
        session()->put('price', Setting::grab('ticket_cost'));
        return view('ticketit::tickets.show',
            compact('ticket', 'status_lists', 'priority_lists', 'category_lists', 'agent_lists', 'comments',
                'close_perm', 'reopen_perm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            //'subject'     => 'required|min:3',
            //'content'     => 'required|min:6',
            //'priority_id' => 'required|exists:ticketit_priorities,id',
            'category_id' => 'required|exists:ticketit_categories,id',
            'status_id'   => 'required|exists:ticketit_statuses,id',
            'agent_id'    => 'required',
        ]);

        $ticket = $this->tickets->findOrFail($id);

        //$ticket->subject = $request->subject;

        //$ticket->setPurifiedContent($request->get('content'));

        $ticket->status_id = $request->status_id;
        $ticket->unit_id = $request->category_id;
        //$ticket->priority_id = $request->priority_id;

        if ($request->input('agent_id') == 'auto') {
            $ticket->autoSelectAgent();
        } else {
            $ticket->agent_id = $request->input('agent_id');
        }

        $ticket->save();

        session()->flash('status', trans('ticketit::lang.the-ticket-has-been-modified'));

        return redirect()->route(Setting::grab('main_route').'.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ticket = $this->tickets->findOrFail($id);
        $subject = $ticket->subject;
        $ticket->delete();

        session()->flash('status', trans('ticketit::lang.the-ticket-has-been-deleted', ['name' => $subject]));

        return redirect()->route(Setting::grab('main_route').'.index');
    }

    /**
     * Mark ticket as complete.
     *
     * @param int $id
     *
     * @return Response
     */
    public function complete($id)
    {
        if ($this->permToClose($id) == 'yes') {
            $ticket = $this->tickets->findOrFail($id);
            $ticket->completed_at = Carbon::now();

            if (Setting::grab('default_close_status_id')) {
                $ticket->status_id = Setting::grab('default_close_status_id');
            }

            $subject = $ticket->subject;
            $ticket->save();

            session()->flash('status', trans('ticketit::lang.the-ticket-has-been-completed', ['name' => $subject]));

            return redirect()->route(Setting::grab('main_route').'.index');
        }

        return redirect()->route(Setting::grab('main_route').'.index')
            ->with('warning', trans('ticketit::lang.you-are-not-permitted-to-do-this'));
    }

    /**
     * Reopen ticket from complete status.
     *
     * @param int $id
     *
     * @return Response
     */
    public function reopen($id)
    {
        if ($this->permToReopen($id) == 'yes') {
            $ticket = $this->tickets->findOrFail($id);
            $ticket->completed_at = null;

            if (Setting::grab('default_reopen_status_id')) {
                $ticket->status_id = Setting::grab('default_reopen_status_id');
            }

            $subject = $ticket->subject;
            $ticket->save();

            session()->flash('status', trans('ticketit::lang.the-ticket-has-been-reopened', ['name' => $subject]));

            return redirect()->route(Setting::grab('main_route').'.index');
        }

        session()->put('ticketid', $ticket->id);
        session()->put('price', Setting::grab('ticket_cost'));

        return redirect('payment');

        //return redirect()->route(Setting::grab('main_route').'.index')
        //    ->with('warning', trans('ticketit::lang.you-are-not-permitted-to-do-this'));
    }

    /**
     * Reopen ticket from complete status.
     *
     * @param int $id
     *
     * @return Response
     */
    public function download($id, $file)
    {
        if ($this->permToReopen($id) == 'yes') {
            $ticket = $this->tickets->findOrFail($id);

            $path= storage_path(). "/informes/".$id."/".$file;

            $headers = array(
              'Content-Type: application/pdf',
            );

            return response()->download($path, $file, $headers);
        }

        return redirect()->route(Setting::grab('main_route').'.index')
            ->with('warning', trans('ticketit::lang.you-are-not-permitted-to-do-this'));
    }

    public function agentSelectList($category_id, $ticket_id)
    {
        $cat_agents = Models\Category::find($category_id)->agents()->agentsLists();
        if (is_array($cat_agents)) {
            $agents = ['auto' => 'Auto Select'] + $cat_agents;
        } else {
            $agents = ['auto' => 'Auto Select'];
        }

        $selected_Agent = $this->tickets->find($ticket_id)->agent->id;
        $select = '<select class="form-control" id="agent_id" name="agent_id">';
        foreach ($agents as $id => $name) {
            $selected = ($id == $selected_Agent) ? 'selected' : '';
            $select .= '<option value="'.$id.'" '.$selected.'>'.$name.'</option>';
        }
        $select .= '</select>';

        return $select;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function permToClose($id)
    {
        $close_ticket_perm = Setting::grab('close_ticket_perm');

        if ($this->agent->isAdmin() && $close_ticket_perm['admin'] == 'yes') {
            return 'yes';
        }
        if ($this->agent->isAgent() && $close_ticket_perm['agent'] == 'yes') {
            return 'yes';
        }
        if ($this->agent->isTicketOwner($id) && $close_ticket_perm['owner'] == 'yes') {
            return 'yes';
        }

        return 'no';
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function permToReopen($id)
    {
        $reopen_ticket_perm = Setting::grab('reopen_ticket_perm');
        if ($this->agent->isAdmin() && $reopen_ticket_perm['admin'] == 'yes') {
            return 'yes';
        } elseif ($this->agent->isAgent() && $reopen_ticket_perm['agent'] == 'yes') {
            return 'yes';
        } elseif ($this->agent->isTicketOwner($id) && $reopen_ticket_perm['owner'] == 'yes') {
            return 'yes';
        }

        return 'no';
    }

    /**
     * Calculate average closing period of days per category for number of months.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function categoryAll($begin_date, $end_date, $cat_id=0)
    {
        $records['categories'] = array();
        if ($cat_id != 0){
          $categories = Category::where('id', '=', $cat_id)->get();
          foreach ($categories as $cat) {
              $records['categories'][] = $cat->name;
          }
        }
        else {
          $categories = Category::all();
          foreach ($categories as $cat) {
              $records['categories'][] = $cat->name;
          }
        }

        $from = $begin_date;
        $to = $end_date;
        setlocale(LC_TIME, 'Spanish');
        while ( $from <= $to) {
            $records['interval'][$from->formatLocalized('%d %B %Y')] = [];
            foreach ($categories as $cat) {
                $records['interval'][$from->formatLocalized('%d %B %Y')][] = round($this->intervalTotal($from, $from, $cat->id), 1);
                //die(var_dump($from).var_dump($from->endOfDay()).var_dump($cat->id));
                //die(var_dump($this->intervalTotal($from, $from->endOfDay(), $cat->id)));
            }
            $from->addDay();
        }
        //die(var_dump($records['interval']));

        return $records;
    }
    /**
     * Calculate average closing period of days per category for number of months.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function categoryOpened($begin_date, $end_date, $cat_id=0)
    {
        $records['categories'] = array();
        if ($cat_id != 0){
          $categories = Category::where('id', '=', $cat_id)->get();
          foreach ($categories as $cat) {
              $records['categories'][] = $cat->name;
          }
        }
        else {
          $categories = Category::all();
          foreach ($categories as $cat) {
              $records['categories'][] = $cat->name;
          }
        }

        $from = $begin_date;
        $to = $end_date;
        setlocale(LC_TIME, 'Spanish');
        while ( $from <= $to) {
            $records['interval'][$from->formatLocalized('%d %B %Y')] = [];
            foreach ($categories as $cat) {
                $records['interval'][$from->formatLocalized('%d %B %Y')][] = round($this->intervalOpened($from, $from, $cat->id), 1);
                //die(var_dump($from).var_dump($from->endOfDay()).var_dump($cat->id));
                //die(var_dump($this->intervalTotal($from, $from->endOfDay(), $cat->id)));
            }
            $from->addDay();
        }
        //die(var_dump($records['interval']));

        return $records;
    }
    /**
     * Calculate average closing period of days per category for number of months.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function categoryClosed($begin_date, $end_date, $cat_id=0)
    {
        $records['categories'] = array();
        if ($cat_id != 0){
          $categories = Category::where('id', '=', $cat_id)->get();
          foreach ($categories as $cat) {
              $records['categories'][] = $cat->name;
          }
        }
        else {
          $categories = Category::all();
          foreach ($categories as $cat) {
              $records['categories'][] = $cat->name;
          }
        }

        $from = $begin_date;
        $to = $end_date;
        setlocale(LC_TIME, 'Spanish');
        while ( $from <= $to) {
            $records['interval'][$from->formatLocalized('%d %B %Y')] = [];
            foreach ($categories as $cat) {
                $records['interval'][$from->formatLocalized('%d %B %Y')][] = round($this->intervalClosed($from, $from, $cat->id), 1);
                //die(var_dump($from).var_dump($from->endOfDay()).var_dump($cat->id));
                //die(var_dump($this->intervalTotal($from, $from->endOfDay(), $cat->id)));
            }
            $from->addDay();
        }
        //die(var_dump($records['interval']));

        return $records;
    }
    /**
     * Calculate average closing period of days per category for number of months.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function agentAll($begin_date, $end_date, $agent_id=0)
    {
        $records['agents'] = array();
        if ($agent_id != 0){
          $agents = Agent::where('id', '=', $agent_id)->get();
          foreach ($agents as $age) {
              $records['categories'][] = $age->name;
          }
        }
        else {
          $agents = Agent::all();
          foreach ($agents as $age) {
              $records['categories'][] = $age->name;
          }
        }

        $from = $begin_date;
        $to = $end_date;
        setlocale(LC_TIME, 'Spanish');
        while ( $from <= $to) {
            $records['interval'][$from->formatLocalized('%d %B %Y')] = [];
            foreach ($agents as $age) {
                $records['interval'][$from->formatLocalized('%d %B %Y')][] = round($this->intervalTotal($from, $from, 0, $agent_id), 1);
                //die(var_dump($from).var_dump($from->endOfDay()).var_dump($cat->id));
                //die(var_dump($this->intervalTotal($from, $from->endOfDay(), $cat->id)));
            }
            $from->addDay();
        }
        //die(var_dump($records['interval']));

        return $records;
    }
    /**
     * Calculate average closing period of days per category for number of months.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function agentOpened($begin_date, $end_date, $agent_id=0)
    {
        $records['agents'] = array();
        if ($agent_id != 0){
          $agents = Agent::where('id', '=', $agent_id)->get();
          foreach ($agents as $age) {
              $records['categories'][] = $age->name;
          }
        }
        else {
          $agents = Agent::all();
          foreach ($agents as $age) {
              $records['categories'][] = $age->name;
          }
        }

        $from = $begin_date;
        $to = $end_date;
        setlocale(LC_TIME, 'Spanish');
        while ( $from <= $to) {
            $records['interval'][$from->formatLocalized('%d %B %Y')] = [];
            foreach ($agents as $age) {
                $records['interval'][$from->formatLocalized('%d %B %Y')][] = round($this->intervalOpened($from, $from, 0, $age->id), 1);
                //die(var_dump($from).var_dump($from->endOfDay()).var_dump($cat->id));
                //die(var_dump($this->intervalTotal($from, $from->endOfDay(), $cat->id)));
            }
            $from->addDay();
        }
        //die(var_dump($records['interval']));

        return $records;
    }
    /**
     * Calculate average closing period of days per category for number of months.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function agentClosed($begin_date, $end_date, $agent_id=0)
    {
        $records['agents'] = array();
        if ($agent_id != 0){
          $agents = Agent::where('id', '=', $agent_id)->get();
          foreach ($agents as $age) {
              $records['categories'][] = $age->name;
          }
        }
        else {
          $agents = Agent::all();
          foreach ($agents as $age) {
              $records['categories'][] = $age->name;
          }
        }

        $from = $begin_date;
        $to = $end_date;
        setlocale(LC_TIME, 'Spanish');
        while ( $from <= $to) {
            $records['interval'][$from->formatLocalized('%d %B %Y')] = [];
            foreach ($agents as $age) {
                $records['interval'][$from->formatLocalized('%d %B %Y')][] = round($this->intervalClosed($from, $from, 0, $age->id), 1);
                //die(var_dump($from).var_dump($from->endOfDay()).var_dump($cat->id));
                //die(var_dump($this->intervalTotal($from, $from->endOfDay(), $cat->id)));
            }
            $from->addDay();
        }
        //die(var_dump($records['interval']));

        return $records;
    }
    /**
     * Calculate average closing period of days per category for number of months.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function userAll($begin_date, $end_date, $user_id=0)
    {
        $records['categories'] = array();
        if ($user_id != 0){
          $users = Agent::where('id', '=', $user_id)->get();
          foreach ($users as $user) {
              $records['categories'][] = $user->name;
          }
        }
        else {
          $users = Agent::all();
          foreach ($users as $user) {
              $records['categories'][] = $user->name;
          }
        }

        $from = $begin_date;
        $to = $end_date;
        setlocale(LC_TIME, 'Spanish');
        while ( $from <= $to) {
            $records['interval'][$from->formatLocalized('%d %B %Y')] = [];
            foreach ($users as $user) {
                $records['interval'][$from->formatLocalized('%d %B %Y')][] = round($this->intervalTotal($from, $from, 0, 0, $user_id), 1);
                //die(var_dump($from).var_dump($from->endOfDay()).var_dump($cat->id));
                //die(var_dump($this->intervalTotal($from, $from->endOfDay(), $cat->id)));
            }
            $from->addDay();
        }
        //die(var_dump($records['interval']));

        return $records;
    }
    /**
     * Calculate average closing period of days per category for number of months.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function userOpened($begin_date, $end_date, $user_id=0)
    {
        $records['agents'] = array();
        if ($user_id != 0){
          $users = Agent::where('id', '=', $user_id)->get();
          foreach ($users as $user) {
              $records['categories'][] = $user->name;
          }
        }
        else {
          $users = Agent::all();
          foreach ($users as $user) {
              $records['categories'][] = $user->name;
          }
        }

        $from = $begin_date;
        $to = $end_date;
        setlocale(LC_TIME, 'Spanish');
        while ( $from <= $to) {
            $records['interval'][$from->formatLocalized('%d %B %Y')] = [];
            foreach ($users as $user) {
                $records['interval'][$from->formatLocalized('%d %B %Y')][] = round($this->intervalOpened($from, $from, 0, 0, $user->id), 1);
                //die(var_dump($from).var_dump($from->endOfDay()).var_dump($cat->id));
                //die(var_dump($this->intervalTotal($from, $from->endOfDay(), $cat->id)));
            }
            $from->addDay();
        }
        //die(var_dump($records['interval']));

        return $records;
    }
    /**
     * Calculate average closing period of days per category for number of months.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function userClosed($begin_date, $end_date, $user_id=0)
    {
        $records['agents'] = array();
        if ($user_id != 0){
          $users = Agent::where('id', '=', $user_id)->get();
          foreach ($users as $user) {
              $records['categories'][] = $user->name;
          }
        }
        else {
          $users = Agent::all();
          foreach ($users as $user) {
              $records['categories'][] = $user->name;
          }
        }

        $from = $begin_date;
        $to = $end_date;
        setlocale(LC_TIME, 'Spanish');
        while ( $from <= $to) {
            $records['interval'][$from->formatLocalized('%d %B %Y')] = [];
            foreach ($users as $user) {
                $records['interval'][$from->formatLocalized('%d %B %Y')][] = round($this->intervalClosed($from, $from, 0, 0, $user->id), 1);
                //die(var_dump($from).var_dump($from->endOfDay()).var_dump($cat->id));
                //die(var_dump($this->intervalTotal($from, $from->endOfDay(), $cat->id)));
            }
            $from->addDay();
        }
        //die(var_dump($records['interval']));

        return $records;
    }
    /**
     * Calculate the date length it took to solve a ticket.
     *
     * @param Ticket $ticket
     *
     * @return int|false
     */
    public function ticketPerformance($ticket)
    {
        if ($ticket->completed_at == null) {
            return false;
        }

        $created = new Carbon($ticket->created_at);
        $completed = new Carbon($ticket->completed_at);
        $length = $created->diff($completed)->days;

        return $length;
    }

    /**
     * Calculate the average date length it took to solve tickets within date period.
     *
     * @param $from
     * @param $to
     *
     * @return int
     */
    /*public function intervalPerformance($from, $to, $cat_id = false)
    {
        if ($cat_id) {
            $tickets = Ticket::where('unit_id', $cat_id)->whereBetween('completed_at', [$from, $to])->get();
        } else {
            $tickets = Ticket::whereBetween('completed_at', [$from, $to])->get();
        }

        if (empty($tickets->first())) {
            return false;
        }

        $performance_count = 0;
        $counter = 0;
        foreach ($tickets as $ticket) {
            $performance_count += $this->ticketPerformance($ticket);
            $counter++;
        }
        $performance_average = $performance_count / $counter;

        return $performance_average;
    }*/
    /**
     * Calculate the total tickets within date period.
     *
     * @param $from
     * @param $to
     *
     * @return int
     */
    public function intervalTotal($from, $to, $cat_id = false, $agent_id = false, $user_id = false)
    {
        if ($cat_id) {
            //$tickets = Ticket::where('category_id', $cat_id)->whereBetween('completed_at', [$from, $to])->get();
            $tickets = Ticket::where('unit_id', $cat_id)->whereBetween('created_at', [$from->format('Y-m-d'), $to->endOfDay()->format('Y-m-d H:i:s')])->get();
            //$tickets = Ticket::where('unit_id', $cat_id)->get();
        }
        elseif ($agent_id) {
            $tickets = Ticket::where('agent_id', $agent_id)->whereBetween('created_at', [$from->format('Y-m-d'), $to->endOfDay()->format('Y-m-d H:i:s')])->get();
        }
        elseif ($user_id) {
            $tickets = Ticket::where('user_id', $user_id)->whereBetween('created_at', [$from->format('Y-m-d'), $to->endOfDay()->format('Y-m-d H:i:s')])->get();
        }
        else {
            //$tickets = Ticket::whereBetween('completed_at', [$from, $to])->get();
            $tickets = Ticket::whereBetween('created_at', [$from, $to])->get();
            //$tickets = Ticket::all();
        }
        //die(var_dump($from->format('Y-m-d').$to->format('Y-m-d H:i:s')));

        if (empty($tickets->first())) {
            return false;
        }

        //$performance_count = 0;
        $counter = 0;
        foreach ($tickets as $ticket) {
            //$performance_count += $this->ticketPerformance($ticket);
            $counter++;
        }
        //$performance_average = $performance_count / $counter;

        return $counter;
    }
    /**
     * Calculate the total tickets within date period.
     *
     * @param $from
     * @param $to
     *
     * @return int
     */
    public function intervalOpened($from, $to, $cat_id = false, $agent_id = false, $user_id = false)
    {
        if ($cat_id) {
            //$tickets = Ticket::where('category_id', $cat_id)->whereBetween('completed_at', [$from, $to])->get();
            $tickets = Ticket::where('unit_id', $cat_id)->whereNull('completed_at')->whereBetween('created_at', [$from->format('Y-m-d'), $to->endOfDay()->format('Y-m-d H:i:s')])->get();
            //$tickets = Ticket::where('unit_id', $cat_id)->get();
        }
        elseif ($agent_id) {
            $tickets = Ticket::where('agent_id', $agent_id)->whereNull('completed_at')->whereBetween('created_at', [$from->format('Y-m-d'), $to->endOfDay()->format('Y-m-d H:i:s')])->get();
        }
        elseif ($user_id) {
            $tickets = Ticket::where('user_id', $agent_id)->whereNull('completed_at')->whereBetween('created_at', [$from->format('Y-m-d'), $to->endOfDay()->format('Y-m-d H:i:s')])->get();
        }
        else {
            //$tickets = Ticket::whereBetween('completed_at', [$from, $to])->get();
            $tickets = Ticket::whereNull('completed_at')->whereBetween('created_at', [$from, $to])->get();
            //$tickets = Ticket::all();
        }
        //die(var_dump($from->format('Y-m-d').$to->format('Y-m-d H:i:s')));

        if (empty($tickets->first())) {
            return false;
        }

        //$performance_count = 0;
        $counter = 0;
        foreach ($tickets as $ticket) {
            //$performance_count += $this->ticketPerformance($ticket);
            $counter++;
        }
        //$performance_average = $performance_count / $counter;

        return $counter;
    }

    /**
     * Calculate the total tickets within date period.
     *
     * @param $from
     * @param $to
     *
     * @return int
     */
    public function intervalClosed($from, $to, $cat_id = false, $agent_id = false, $user_id = false)
    {
        if ($cat_id) {
            //$tickets = Ticket::where('category_id', $cat_id)->whereBetween('completed_at', [$from, $to])->get();
            $tickets = Ticket::where('unit_id', $cat_id)->whereBetween('completed_at', [$from->format('Y-m-d'), $to->endOfDay()->format('Y-m-d H:i:s')])->get();
            //$tickets = Ticket::where('unit_id', $cat_id)->get();
        }
        elseif ($agent_id) {
            $tickets = Ticket::where('agent_id', $agent_id)->whereBetween('completed_at', [$from->format('Y-m-d'), $to->endOfDay()->format('Y-m-d H:i:s')])->get();
        }
        elseif ($user_id) {
            $tickets = Ticket::where('user_id', $agent_id)->whereBetween('completed_at', [$from->format('Y-m-d'), $to->endOfDay()->format('Y-m-d H:i:s')])->get();
        }
        else {
            //$tickets = Ticket::whereBetween('completed_at', [$from, $to])->get();
            $tickets = Ticket::whereBetween('completed_at', [$from, $to])->get();
            //$tickets = Ticket::all();
        }
        //die(var_dump($from->format('Y-m-d').$to->format('Y-m-d H:i:s')));

        if (empty($tickets->first())) {
            return false;
        }

        //$performance_count = 0;
        $counter = 0;
        foreach ($tickets as $ticket) {
            //$performance_count += $this->ticketPerformance($ticket);
            $counter++;
        }
        //$performance_average = $performance_count / $counter;

        return $counter;
    }}
