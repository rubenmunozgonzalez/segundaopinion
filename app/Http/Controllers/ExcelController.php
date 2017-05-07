<?php
  namespace App\Http\Controllers;

  use App\Http\Controllers\Controller;
  use App\Fileentry;
  use Request;
  use Excel;

  use Illuminate\Support\Facades\Storage;
  use Illuminate\Support\Facades\File;
  use Illuminate\Http\Response;

  class ExcelController extends Controller {
      function testExport() {
        Excel::create(storage_path().'descargas/test.xml', function($excel) {

          $excel->sheet('First sheet', function($sheet) {
            $sheet->fromArray(array(
              array('data1', 'data2'),
              array('data3', 'data4')
            ));
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
