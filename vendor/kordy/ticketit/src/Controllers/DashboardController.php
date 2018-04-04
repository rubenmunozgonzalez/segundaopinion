<?php

namespace Kordy\Ticketit\Controllers;
use App\Http\Controllers\Controller;
use App\Fileentry;
use Request;
use Excel;
use Kordy\Ticketit\Models\Agent;
use Kordy\Ticketit\Models\Category;
use Kordy\Ticketit\Models\Ticket;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index($type = 'all', $agent_id = 0, $category_id = 0, $user_id = 0, $begin_day = '00', $begin_month = '00', $begin_year = '0000', $end_day = '00', $end_month = '00', $end_year = '0000')
    {
        $tickets_count = Ticket::count();
        $open_tickets_count = Ticket::whereNull('completed_at')->count();
        $closed_tickets_count = Ticket::whereNotNull('completed_at')->count();

        // Per Category pagination
        $categories = Category::paginate(10, ['*'], 'cat_page');

        // Total tickets counter per category for google pie chart
        $categories_all = Category::all();
        $categories_share = [];
        foreach ($categories_all as $cat) {
            $categories_share[$cat->name] = $cat->tickets()->count();
        }

        // Total tickets counter per agent for google pie chart
        $agents_share_obj = Agent::agents()->with(['agentTotalTickets' => function ($query) {
            $query->addSelect(['id', 'agent_id']);
        }])->get();

        $agents_share = [];
        foreach ($agents_share_obj as $agent_share) {
            $agents_share[$agent_share->name] = $agent_share->agentTotalTickets->count();
        }

        // Per Agent
        $agents = Agent::agents(10);

        // Per User
        $users = Agent::users(10);

        $begin_date = \Carbon\Carbon::createFromDate($begin_year, $begin_month, $begin_day, 'Europe/Berlin');
        $end_date = \Carbon\Carbon::createFromDate($end_year, $end_month, $end_day, 'Europe/Berlin');
        $end_date->endOfDay();

        // Per Category performance data
        $ticketController = new TicketsController(new Ticket(), new Agent());
        if ($type == 'all') {

          if ($agent_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->agentAll($begin_date, $end_date, $agent_id);
          }
          elseif ($category_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->categoryAll($begin_date, $end_date, $category_id);
          }
          elseif ($user_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->userAll($begin_date, $end_date, $user_id);
          }
          else {
            $monthly_performance = $ticketController->categoryAll($begin_date, $end_date);
          }

        }
        if ($type == 'opened') {
          // Per Category performance data
          if ($agent_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->agentOpened($begin_date, $end_date, $agent_id);
          }
          elseif ($category_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->categoryOpened($begin_date, $end_date, $category_id);
          }
          elseif ($user_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->userOpened($begin_date, $end_date, $user_id);
          }
          else {
            $monthly_performance = $ticketController->categoryOpened($begin_date, $end_date);
          }
        }
        if ($type == 'closed') {
          // Per Category performance data
          if ($agent_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->agentClosed($begin_date, $end_date, $agent_id);
          }
          elseif ($category_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->categoryClosed($begin_date, $end_date, $category_id);
          }
          elseif ($user_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->userClosed($begin_date, $end_date, $user_id);
          }
          else {
            $monthly_performance = $ticketController->categoryClosed($begin_date, $end_date);
          }
        }

        if (request()->has('cat_page')) {
            $active_tab = 'cat';
        } elseif (request()->has('agents_page')) {
            $active_tab = 'agents';
        } elseif (request()->has('users_page')) {
            $active_tab = 'users';
        } else {
            $active_tab = 'cat';
        }

        return view(
            'ticketit::admin.index',
            compact(
                'open_tickets_count',
                'closed_tickets_count',
                'tickets_count',
                'categories',
                'agents',
                'users',
                'monthly_performance',
                'categories_share',
                'agents_share',
                'active_tab'
            ));
    }

    public function export($type = 'all', $agent_id = 0, $category_id = 0, $user_id = 0, $begin_day = '00', $begin_month = '00', $begin_year = '0000', $end_day = '00', $end_month = '00', $end_year = '0000')
    {
        $tickets_count = Ticket::count();
        $open_tickets_count = Ticket::whereNull('completed_at')->count();
        $closed_tickets_count = Ticket::whereNotNull('completed_at')->count();

        // Per Category pagination
        $categories = Category::paginate(10, ['*'], 'cat_page');

        // Total tickets counter per category for google pie chart
        $categories_all = Category::all();
        $categories_share = [];
        foreach ($categories_all as $cat) {
            $categories_share[$cat->name] = $cat->tickets()->count();
        }

        // Total tickets counter per agent for google pie chart
        $agents_share_obj = Agent::agents()->with(['agentTotalTickets' => function ($query) {
            $query->addSelect(['id', 'agent_id']);
        }])->get();

        $agents_share = [];
        foreach ($agents_share_obj as $agent_share) {
            $agents_share[$agent_share->name] = $agent_share->agentTotalTickets->count();
        }

        // Per Agent
        $agents = Agent::agents(10);

        // Per User
        $users = Agent::users(10);

        $begin_date = \Carbon\Carbon::createFromDate($begin_year, $begin_month, $begin_day, 'Europe/Berlin');
        $end_date = \Carbon\Carbon::createFromDate($end_year, $end_month, $end_day, 'Europe/Berlin');
        $end_date->endOfDay();

        // Per Category performance data
        $ticketController = new TicketsController(new Ticket(), new Agent());
        if ($type == 'all') {

          if ($agent_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->agentAll($begin_date, $end_date, $agent_id);
          }
          elseif ($category_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->categoryAll($begin_date, $end_date, $category_id);
          }
          elseif ($user_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->userAll($begin_date, $end_date, $user_id);
          }
          else {
            $monthly_performance = $ticketController->categoryAll($begin_date, $end_date);
          }

        }
        if ($type == 'opened') {
          // Per Category performance data
          if ($agent_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->agentOpened($begin_date, $end_date, $agent_id);
          }
          elseif ($category_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->categoryOpened($begin_date, $end_date, $category_id);
          }
          elseif ($user_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->userOpened($begin_date, $end_date, $user_id);
          }
          else {
            $monthly_performance = $ticketController->categoryOpened($begin_date, $end_date);
          }
        }
        if ($type == 'closed') {
          // Per Category performance data
          if ($agent_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->agentClosed($begin_date, $end_date, $agent_id);
          }
          elseif ($category_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->categoryClosed($begin_date, $end_date, $category_id);
          }
          elseif ($user_id != 0) {
            // Per Category performance data
            $monthly_performance = $ticketController->userClosed($begin_date, $end_date, $user_id);
          }
          else {
            $monthly_performance = $ticketController->categoryClosed($begin_date, $end_date);
          }
        }

        if (request()->has('cat_page')) {
            $active_tab = 'cat';
        } elseif (request()->has('agents_page')) {
            $active_tab = 'agents';
        } elseif (request()->has('users_page')) {
            $active_tab = 'users';
        } else {
            $active_tab = 'cat';
        }

        return $this->exportArray($monthly_performance);
    }

    function exportArray($arr) {
        $arr2 = [];
        $i = 0;
        foreach ($arr['interval'] as $key => $values) {
          $arr2[$i]['Fecha'] = $key;
          $j = 0;
          foreach ($values as $val) {
            $arr2[$i][$arr['categories'][$j++]] = $val;
          }
          $i++;
        }
        Excel::create(storage_path().'descargas/test.xml', function($excel) use ($arr2) {
          $excel->sheet('First sheet', function($sheet) use ($arr2) {
            $sheet->fromArray($arr2, null, 'A1', true);
            //$sheet->rows($arr, null, 'B1');
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
