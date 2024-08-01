<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Get all parties
        $parties = Party::all();

        // Get all parties with specific columns
        // $parties = Party::select(
        //     'id',
        //     'party_type',
        //     'full_name',
        //     'phone_no',
        //     'address',
        //     'account_holder_name',
        //     'account_no',
        //     'bank_name',
        //     'ifsc_code',
        //     'branch_address',
        //     'created_at'
        // )->get();

        return view("party.index",compact('parties'));
    }


    public function addParty()
    {
        return view("party.add");
    }

    public function createParty(Request $request)
    {
        // dd($request);
        // Valildation
        $request->validate([
            'party_type' => 'required',
            'full_name' => 'required|string|min:2|max:20',
            'phone_no' => 'required|numeric|digits:10',
            'address' => 'required|max:255',
            'account_holder_name' => 'required|string|min:2|max:20',
            'account_no' => 'required|numeric|min:12',
            'bank_name' => 'required|max:255',
            'ifsc_code' => 'required|max:50',
            'branch_address' => 'required|max:255',
        ]);

        $param = $request->all();

        // Remove token from post data before inserting
        unset($param['_token']);
        Party::create($param);
        // $param = new Party;
        // $param->full_name = $request->full_name;
        // $param->save();
        // Party::create();

        // Redirect to add party back
        return redirect()->route('add-party')->withStatus("Party created successfully");

        //return redirect()->route('add-party')->with('success', 'Party created successfully');
    }

    public function editParty($party_id)
    {
        $data['party'] = Party::find($party_id);
        return view("party.edit", $data);
    }

    public function updateParty($id, Request $request)
    {
        // Valildation
        $request->validate([
            'party_type' => 'required',
            'full_name' => 'required|string|min:2|max:20',
            'phone_no' => 'required|numeric|digits:10',
            'address' => 'required|max:255',
            'account_holder_name' => 'required|string|min:2|max:20',
            'account_no' => 'required|numeric|min:12',
            'bank_name' => 'required|max:255',
            'ifsc_code' => 'required|max:50',
            'branch_address' => 'required|max:255',
        ]);

        // Update the record
        $param = $request->all();
        unset($param['_token']);
        unset($param['_method']);
        Party::where('id', $id)->update($param);
        return redirect()->route('manage-parties')->withStatus("Party updated successfully");
    }

    public function deleteParty(Party $party)
    {
        $party->delete();
        return redirect()->route('manage-parties')->with( 'error','Party deleted successfully');
    }

}
