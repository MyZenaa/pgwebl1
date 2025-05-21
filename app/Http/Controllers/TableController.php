<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;
use App\Models\PolygonsModel;
use App\Models\PolylinesModel;

class TableController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polygons = new PolygonsModel();
        $this->polylines = new PolylinesModel();
    }
    public function index()
    {
        $data = [
            'title' => 'table',
            'points' => $this->points->all(),
            'polygons' => $this->polygons->all(),
            'polylines' => $this->polylines->all(),

        ];

        return view('table',$data);
    }
}
