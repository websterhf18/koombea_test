<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvImportRequest;
use App\Imports\ContactsImport;
use App\Archivos;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ArchivosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $archivos = Archivos::all();
        return view('archivos', compact( 'archivos') );
    }
    public function import(CsvImportRequest $request){

        if ($request->has('header')) {
            $data = Excel::toArray(new ContactsImport, $request->file('csv_file'));
        } else {
            $path = $request->file('csv_file')->getRealPath();
            $data = array_map('str_getcsv', file($path));
        }
        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0][0] as $key => $value) {
                    $csv_header_fields[] = $value;
                }
            }
            $csv_data = array_slice($data[0], 1, 2);
            $csv_data_file = Archivos::create([
                'filename' => $request->file('csv_file')->getClientOriginalName(),
                'status' => 'On Hold',
                's3_url' => '',
                'has_header' => $request->has('header'),
                'json_data' => json_encode($data[0])
            ]);
        } else {
            return redirect()->back();
        }
        $csv_fields = array(
            'name',
            'date_birth',
            'phone',
            'address',
            'credit_card',
            'email',
            'id'
        );
        return view('import', compact( 'csv_header_fields', 'csv_data', 'csv_data_file', 'csv_fields'));
    }
}
