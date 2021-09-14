<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacts;

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
    public function import(){
        
    }
}
