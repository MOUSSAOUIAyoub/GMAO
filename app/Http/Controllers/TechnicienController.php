<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technicien;
use App\Http\Resources\Technicien as TechnicienResource;

class TechnicienController extends Controller
{
    public function index()
    {
        

            $Techniciens = Technicien::all();
            return response()-> json(TechnicienResource::collection($Techniciens));
        
    
    }
}
