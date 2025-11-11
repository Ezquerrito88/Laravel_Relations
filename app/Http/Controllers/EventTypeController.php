<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\Validator;

class EventTypeController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    }
    public function listEvents(EventType $type){
        $events = $type->events;
        return response()->json(['message'=>null,'data'=>$events],200);
    }
}
