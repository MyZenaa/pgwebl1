<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonsModel extends Model
{
    protected $table = 'polygons';

    protected $guarded = ['$id'];


    public function geojson_polygons()
    {
        $polygons = $this->select(DB::raw('polygons.id, ST_AsGeoJSON(polygons.geom) as geom, polygons.name, polygons.description,st_area(geom,true) as area_m2, st_area(geom,true)/1000000 as area_km2, st_area(geom,true)/10000 as luas_hektar, polygons.created_at, polygons.updated_at, polygons.image, users.name as user_created'))
            ->leftJoin('users', 'polygons.user_id', '=', 'users.id')
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
                    'image' => $p->image,
                    'user_id' => $p->user_id,
                    'user_created' => $p->user_created,
                ]
            ];

            array_push($geojson['features'], $feature);


        }
        return $geojson;
    }

    public function geojson_polygon($id)
    {
        $polygons = $this->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description,st_area(geom,true) as area_m2, st_area(geom,true)/1000000 as area_km2, st_area(geom,true)/10000 as luas_hektar, created_at, updated_at, image'))
        ->where('id',$id)
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
                    'image' => $p->image,

                ]
            ];

            array_push($geojson['features'], $feature);


        }
        return $geojson;
    }

}
