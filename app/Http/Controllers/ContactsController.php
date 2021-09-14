<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacts;
use App\Archivos;
use App\Services\ContactService;

class ContactsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $contactos = Contacts::all();
        return view('contactos', compact( 'contactos' ) );
    }
    public function import(Request $request){

        $data = Archivos::find($request->csv_data_file_id);
        $csv_data = json_decode($data->json_data, true);
        
        $csv_fields = array(
            'name',
            'date_birth',
            'phone',
            'address',
            'credit_card',
            'email',
            'id'
        );
        $data->status = 'Processing';
        $data->save();
        foreach ($csv_data as $index => $row) {
            if($index === 0)
                continue;

            $arrayFields = array();
            foreach ($csv_fields as $indexField => $field) {
                if ($data->has_header) {
                    $arrayFields[$field] = $row[$indexField];
                } else {
                    $arrayFields[$field] = $row[$indexField];
                }
            }
            $parseCC = ContactService::parse_cc_number($row[4]);
            $arrayFields['credit_card'] = ContactService::get_four_last($parseCC);
            $arrayFields['franchise'] = ContactService::get_cc_company($parseCC, false);
            Contacts::create($arrayFields);
        }
        $data->status = 'Terminated';
        $data->save();
        return redirect('/contactos');
    }
}
