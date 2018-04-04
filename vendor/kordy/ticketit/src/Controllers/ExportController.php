<?php
  namespace Kordy\Ticketit\Controllers;

  use App\Http\Controllers\Controller;
  use App\Fileentry;
  use Request;
  use Excel;
  use Kordy\Ticketit\Models\Agent;
  use Kordy\Ticketit\Models\Ticket;
  use Illuminate\Support\Facades\Storage;
  use Illuminate\Support\Facades\File;
  use Illuminate\Support\Facades\DB;
  use Illuminate\Http\Response;

  class ExportController extends Controller {
      protected $tickets;
      protected $agent;

      public function __construct(Ticket $tickets, Agent $agent)
      {
          $this->middleware('Kordy\Ticketit\Middleware\ResAccessMiddleware', ['only' => ['show']]);
          $this->middleware('Kordy\Ticketit\Middleware\IsAgentMiddleware', ['only' => ['edit', 'update']]);
          $this->middleware('Kordy\Ticketit\Middleware\IsAdminMiddleware', ['only' => ['destroy']]);

          $this->agent = $agent;
      }

      public function downloadPayments() {
        $user = Agent::find(auth()->user()->id);

        if ($user->isAdmin()) {
            $collection = Ticket::paid();
        } elseif ($user->isAgent()) {
            $collection = Ticket::paid()->agentUserTickets($user->id);
        } else {
            $collection = Ticket::paid()->userTickets($user->id);
        }

        $collection
            ->join('users', 'users.id', '=', 'ticketit.user_id')
            ->join('ticketit_statuses', 'ticketit_statuses.id', '=', 'ticketit.status_id')
            ->join('ticketit_priorities', 'ticketit_priorities.id', '=', 'ticketit.priority_id')
            ->join('ticketit_categories', 'ticketit_categories.id', '=', 'ticketit.category_id')
            ->join('ticketit_categories as ticketit_units', 'ticketit_units.id', '=', 'ticketit.unit_id')
            ->select([
                'ticketit.id',
                'users.name AS owner',
                'users.nid AS nid',
                'ticketit.subject AS subject',
                'ticketit_statuses.name AS status',
                'ticketit_statuses.color AS color_status',
                'ticketit_priorities.color AS color_priority',
                'ticketit_categories.color AS color_category',
                //'ticketit.id AS agent',
                'ticketit.updated_at AS updated_at',
                'ticketit_priorities.name AS priority',
                'ticketit.agent_id',
                'ticketit_units.name AS unit',
                'ticketit.price AS price',
            ]);
        $arr = $collection->get()->toArray();
        //$collection = $datatables->of($collection);

        //$this->renderTicketTable($collection);
        Carbon::setLocale('es');
        $collection->editColumn('updated_at', '{!! \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $updated_at)->diffForHumans() !!}');

        //return $collection->make(true);

        Excel::create(storage_path().'descargas/test.xml', function($excel) use ($arr) {

          $excel->sheet('First sheet', function($sheet) use ($arr) {
            $sheet->fromArray($arr);
          });
          // Set the title
          $excel->setTitle('Our new awesome title');

          // Chain the setters
          $excel->setCreator('Maatwebsite')
            ->setCompany('Maatwebsite');

          // Call them separately
          $excel->setDescription('A demonstration to change the file properties');
        })->download('xls');
      }
  }
