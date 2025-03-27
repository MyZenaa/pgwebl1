<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonsModel extends Model
{
    protected $table = 'polygons';

    protected $guarded = ['$id'];


    public function gejson_polygons()
    {
        $polygons = $this->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description,st_area(geom,true) as area_m2, st_area(geom,true)/1000000 as area_km2, st_area(geom,true)/10000 as luas_hektar, created_at, updated_at'))
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'area_m2' => $p->area_m2,
                    'area_km2' => $p->area_km2,
                    'luas_hektar' => $p->luas_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                ]
            ];

            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

}
