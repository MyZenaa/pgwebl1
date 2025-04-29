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
        $polylines = $this->select(DB::raw('ST_AsGeoJSON(geom) as geom, name, description, ST_Length(geom,true) as Length_m, ST_Length(geom,true)/1000 as Length_km, created_at, updated_at, image'))
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
