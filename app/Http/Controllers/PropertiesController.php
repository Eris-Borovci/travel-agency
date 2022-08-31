<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("property.add_property");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timestampIn = strtotime($request->get("check_in"));
        $dateIn = date("Y-m-d", $timestampIn);

        $timestampOut = strtotime($request->get("check_out"));
        $dateOut = date("Y-m-d", $timestampOut);

        $property = new Property();

        $property->partner_id = \Auth::user()->id;
        $property->property_selection = $request->get("property_selection");
        $property->property_name = $request->get("property_name");
        $property->current_location = $request->get("current_location");
        $property->marker_location = $request->get("marker_location");
        $property->rooms_details = $request->get("rooms_details");
        $property->check_in = $dateIn;
        $property->check_out = $dateOut;
        $property->price = $request->get("price");
        $property->max_people = $request->get("max_people");

        $property->save();

        $response = json_encode(array(
            "status" => "finished",
            "request" => $request->all(),
            "property_id" => $property->id,
        ));

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
