<?php

namespace App\Http\Controllers;

use App\Models\Event;
use http\Env\Response;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EventController extends Controller
{

    public function listUsers(Event $event)
    {
        $users = $event->users;
        return response()->json(['message'=>null,'data'=>$users],200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return response()->json(['message'=>null,'data'=>$events],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string',
            'event_detail' => 'required|string',
            'event_type_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        try{
            $eventType = EventType::find($request->get('event_type_id'));
            if(!$eventType){
                return response()->json(["message"=>"Event not found"],404);
            }
            $event = Event::create([
                'event_name'=>$request->get('event_name'),
                'event_detail'=>$request->get('event_detail'),
                'event_type_id'=>$request->get('event_type_id'),
            ]);

        }catch (\Exception $e){
            return response()->json(["message"=>$e->getMessage()],400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        if($event){
            return response()->json(['message'=>'No encontrado','data'=>$event],404);
        } else{
            return response()->json(['message'=>'' , 'data'=>$event],200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
