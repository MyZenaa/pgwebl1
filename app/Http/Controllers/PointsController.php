<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->points = new PointsModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Map',
        ];

        return view('map', $data);
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
        // Validate Reuqest
        $request->validate(
            [
                'name' => 'required|unique:points,name',
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10240', // 10mb
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exist',
                'description.required' => 'Description is required',
                'geom_point.required' => 'Point is required',
            ]
        );
        // Create Image direktori
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //Get Image File
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }
        // create data
        $data = [
            'name' => $request->name,
            'geom' => $request->geom_point,
            'description' => $request->description,
            'image' => $name_image,
        ];
        // create data
        if (!$this->points->create($data)) {
            return redirect()->route('map')->with('success', 'Point Failed to add');
        }

        //redirect to map
        return redirect()->route('map')->with('success', 'Point Has Been Added');
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
            'title' => 'Edit Point',
            'id' => $id,
        ];
        return view('edit-point', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id, $request->all());
        // Validate Reuqest
        $request->validate(
            [
                'name' => 'required|unique:points,name,' . $id,
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10240', // 10mb
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exist',
                'description.required' => 'Description is required',
                'geom_point.required' => 'Point is required',
            ]
        );
        // Create Image direktori
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }


        // Get old image file name
        $old_image = $this->points->find($id)->image;
        //Get Image File
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
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
            'geom' => $request->geom_point,
            'description' => $request->description,
            'image' => $name_image,
        ];
        // Update data
        if (!$this->points->find($id)->update($data)) {
            return redirect()->route('map')->with('success', 'Point Failed to add');
        }

        //redirect to map
        return redirect()->route('map')->with('success', 'Point Has Been Added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->points->find($id)->image;

        if (!$this->points->destroy($id)) {
            return redirect()->route('map')->with('error', 'Point failed to delete!');
        }

        // Delete image file
        if ($imagefile != null) {
            if (file_exists('./storage/images/' . $imagefile)) {
                unlink('./storage/images/' . $imagefile);
            }
        }
        return redirect()->route('map')->with('success', 'Point has been deleted!');
    }
}
