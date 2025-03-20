<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PolygonsModel;

class PolygonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->polygons = new PolygonsModel();
    }
    public function index()
    {
        $data=[
            'title' => 'Map',
        ];

        return view('map',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'geom' => $request->geom_polygon,
            'description' => $request->description,
        ];


        // Validate Reuqest
        $request->validate(
            [
                'name'=>'required|unique:polygons,name',
                'description'=>'required',
                'geom_polygon'=>'required',
            ],
            [
                'name.required'=>'Name is required',
                'name.unique'=>'Name already exist',
                'description.required'=>'Description is required',
                'geom_polygon.required'=>'polygon is required',
            ]
            );
        // create data
        if (!$this->polygons->create($data)) {
            return redirect()->route('map')->with('success', 'Polygons Failed to add');
        }

        //redirect to map
        return redirect()->route('map')->with('success', 'Polygons Has Been Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
