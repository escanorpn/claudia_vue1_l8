<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\quiz;

class QuizController extends Controller
{
    //
    public function index(Request $request)
    {
        $response = [];
        $data=quiz::all();
       
        return response()->json([
            "success" => true,
            "val" => "2", 
            "message" => "Link updated",
            "data" => $data,
        ]);
    }
    public function update(Request $request)
    {
        $response = [];
        $affected=quiz::where('id', 1)->update(['link' => $request->link]);
       
        return response()->json([
            "success" => true,
            "val" => "2", 
            "message" => "Link updated",
            "affected" => $affected,

        ]);
    }
}
