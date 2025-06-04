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
        //membuat direktori penyimpanan jika belum ada
        if (!is_dir('storage')) {
            mkdir('./storage', 0777);
        }

        //metode untuk mendapatkan file untuk disimpan
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'name' => $request->name,
            'geom' => $request->geom_polygon,
            'description' => $request->description,
            'image' => $name_image,
            'user_id' => auth()->user()->id,
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
        $data = [
            'title' => 'Edit Polygon',
            'id' => $id,
        ];
        return view('edit-polygon', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Reuqest
        $request->validate(
            [
                'name' => 'required|unique:polygons,name,' . $id,
                'description' => 'required',
                'geom_polygon' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10240', // 10mb
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exist',
                'description.required' => 'Description is required',
                'geom_polygon.required' => 'Polygon is required',
            ]
        );
        // Create Image direktori
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }


        // Get old image file name
        $old_image = $this->polygons->find($id)->image;
        //Get Image File
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = $old_image;
        }
        // Delete old image file
        if ($old_image != null) {
            if (file_exists('./storage/images/' . $old_image)) {
                unlink('./storage/images/' . $old_image);
            } else {
                $old_image = null;
            }
        }

        // create data
        $data = [
            'name' => $request->name,
            'geom' => $request->geom_polygon,
            'description' => $request->description,
            'image' => $name_image,
        ];
        // Update data
        if (!$this->polygons->find($id)->update($data)) {
            return redirect()->route('map')->with('success', 'Polygon Failed to add');
        }

        //redirect to map
        return redirect()->route('map')->with('success', 'Polygon Has Been Added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->polygons->find($id)->image;

        if (!$this->polygons->destroy($id)) {
            return redirect()->route('map')->with('error', 'Polygon failed to delete!');
        }

        // Delete image file
        if ($imagefile != null) {
            if (file_exists('./storage/images/' . $imagefile)) {
                unlink('./storage/images/' . $imagefile);
            }
        }

        return redirect()->route('map')->with('success', 'Polygon has been deleted!');
    }
}
