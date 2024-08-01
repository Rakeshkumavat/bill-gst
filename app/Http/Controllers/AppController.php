<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view("dashbord");
    }
        // Function to soft delete
    public function delete($table, $id)
    {
        $param = array('is_deleted' => 1);
        DB::table($table)->where('id', $id)->update($param);

            // Redirect back
        return redirect()->back()->with( 'error','Party deleted successfully');
    }
}
