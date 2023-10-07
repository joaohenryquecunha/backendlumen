<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Points;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function index(){
        return response()->json(Points::all());
    }

    public function show(){
        
    }

    public function store(Request $request){
        $this->validate($request, [
            'user_id' => 'required',
            'hours_in' => 'required',
            'hours_out' => 'required',
        ]);

        $point = new Points;
        $point->user_id = $request->input('user_id');
        $point->hours_in = $request->input('hours_in');
        $point->hours_out = $request->input('hours_out');
        $point->save();

        return response()->json($point, 201);
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
   
   
}