<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class GeolocationsController extends Controller
{
    public function departaments(){
        return DB::table('departaments')->get();
    }

    public function municipalities($id = null){
        $query = DB::table('municipalities');
        if($id !== null) $query->where('departament_id', $id);
        return $query->get();
    }
}
