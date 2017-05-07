<?php
  namespace Kordy\Ticketit\Controllers;

  use App\Http\Controllers\Controller;
  use App\Fileentry;
  use Request;
  use Excel;
  use Kordy\Ticketit\Models\Agent;
  use Illuminate\Support\Facades\Storage;
  use Illuminate\Support\Facades\File;
  use Illuminate\Http\Response;

  class ExportController extends Controller {
      function exportArray($arr) {
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
