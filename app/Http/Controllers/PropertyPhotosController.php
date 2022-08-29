<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PropertyPhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Getting the files info
        $file = $request->file('File');
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = $file->getClientOriginalExtension();
        $filepath = $filename . "_" . time() . "_." . $fileExtension;
        
        // Storing the file to local disk
        $store = $request->file("File")->storeAs("public/property_photos", $filepath);

        // Saving the photo details to db
        $photo = new Photo();
        $photo->property_id = $request->get("property_id");
        $photo->photo_name = $filename;
        $photo->photo_path = $filepath;
        $photo->save();

        $response = array(
            "status" => "finished",
        );

        return json_encode($response);
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
