<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolylinesModel extends Model
{
    protected $table = 'polylines';

    protected $guarded = ['$id'];

    public function gejson_polylines()
    {
        $polylines = $this->select(DB::raw('polylines.id, ST_AsGeoJSON(polylines.geom) as geom, polylines.name, polylines.description, ST_Length(geom,true) as Length_m, ST_Length(geom,true)/1000 as Length_km, polylines.created_at, polylines.updated_at, polylines.image, users.name as user_created'))
            ->leftJoin('users', 'polylines.user_id', '=', 'users.id')
            ->get();


        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polylines as $p) {

            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'length_m' => $p->length_m,
                    'length_km' => $p->length_km,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_id' => $p->user_id,
                    'user_created' => $p->user_created,
                ],
            ];

            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }
    public function geojson_polyline($id)
    {
        $polylines = $this->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description, ST_Length(geom,true) as Length_m, ST_Length(geom,true)/1000 as Length_km, created_at, updated_at, image'))
        ->where('id',$id)
        ->get();


        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polylines as $p) {

            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'length_m' => $p->length_m,
                    'length_km' => $p->length_km,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                ],
            ];

            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }
}
