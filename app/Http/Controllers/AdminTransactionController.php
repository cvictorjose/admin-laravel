<?php namespace App\Http\Controllers;

use Validator;
use Session;
use Response;
use View;

use \App\AdminTransaction;
use \App\Http\Requests;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminTransactionController  extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * name:    Traackinglist
     * params:
     * return:
     * desc:    Traackinglist admin
     */
    public function transactionlist(){
        $data['acList']         = AdminTransaction::getTransactionList();
        return \View::make('admin.transactionlist')->with('data', $data);
    }



}