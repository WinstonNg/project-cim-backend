<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Customer::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_no' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'account_no' => 'required',
            'account_type' => 'required',
            'balance' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()], 404);
        }

        $customer = new Customer([
            'email' => $request->get('email'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'contact_no' => $request->get('contact_no'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'account_no' => $request->get('account_no'),
            'account_type' => $request->get('account_type'),
            'balance' => $request->get('balance'),
        ]);

        $customer->save();

        return response()->json(["New customer created!"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        error_log($id);

        $rules = [
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_no' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'account_no' => 'required',
            'account_type' => 'required',
            'balance' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()], 404);
        }

        $customer = Customer::find($id);

        if ($customer == null) {
            return response()->json(["Specified customer not found"], 404);
        } 

        $customer-> email = $request->get('email');
        $customer-> first_name = $request->get('first_name');
        $customer-> last_name = $request->get('last_name');
        $customer-> contact_no = $request->get('contact_no');
        $customer-> address = $request->get('address');
        $customer-> city = $request->get('city');
        $customer-> state = $request->get('state');
        $customer-> account_no = $request->get('account_no');
        $customer-> account_type = $request->get('account_type');
        $customer-> balance = $request->get('balance');
        $customer->save();

        return response()->json(["Customer info updated!"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        error_log($id);

        $customer = Customer::find($id);

        if ($customer == null) {
            return response()->json(["Specified customer not found"], 404);
        } 
        $customer->delete();

        return response()->json(["Customer removed!"], 200);
    }
}
