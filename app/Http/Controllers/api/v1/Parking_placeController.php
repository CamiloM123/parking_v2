<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Ticket;
use App\Models\Parking;
use Illuminate\Http\Request;
use App\Models\Parking_place;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Parking_placeStoreRequest;

class Parking_placeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Parking $parking, Request $request)
    {
        $parking_places = Parking_place::orderBy('id', 'asc')->get();
    
        if(isset($parking)){
        
            $parking_places = Parking_place::where('parking_id', $parking->id)->orderBy('id', 'asc')->get();
            
        }

        if($request->input('status') == 'available'){
            
            // $parking_places = collect();

            // foreach ($parking->parking_places as $parking_place) {
            //     $tickets = $parking_place->tickets;
            //     $ticket = $tickets->last();

            //     if($ticket->exit_time != null){
            //         $parking_places->push($parking_place);
            //     }
            //     // $ticket = Ticket :: where('parking_place_id', $parking_place->id)
            //     // ->last();
            //     // $parking_places->push($ticket);
            // }

            $parking_places = Parking_place :: whereDoesntHave('tickets', function($query){
                $query->where('exit_time', null);
            })->where('parking_id',$parking->id)->get();

        }

        return response()->json(['data' => $parking_places], 200);
    }
    /**
     * Display a listing of the resource but of an unique parking.
     *
     * @param  \Illuminate\Http\Parking  $parking
     * @return \Illuminate\Http\Response
     */

    // public function available(Request $request, Parking $parking)
    // {
        
    //     return response()->json(['data' =>  ], 200);
    // }

    /**
     * Display a listing of the resource but of an unique parking.
     *
     * @param  \Illuminate\Http\Parking  $parking
     * @return \Illuminate\Http\Response
     */

    // public function list(Parking $parking)
    // {
    //     if($parking->isset()){

    //     }
    //     $parking_places = Parking_place::where('parking_id', $parking->id)->orderBy('id', 'asc')->get();
    //     return response()->json(['data' => $parking_places], 200);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Parking_placeStoreRequest $request, Parking $parking)
    {
        $parking_place = new Parking_place();
        $parking_place->row = $request->row;
        $parking_place->column = $request->column;
        $parking_place->parking_id = $parking->id;
        $parking_place->save();
        
        return response()->json(['data' => $parking_place], 201);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parking_place  $parking_place
     * @return \Illuminate\Http\Response
     */
    public function show(Parking_place $parking_place)
    {
        return response()->json(['data' => $parking_place], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parking_place  $parking_place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parking_place $parking_place)
    {
        $parking_place->update($request->all());
        return response()->json(['data' => $parking_place], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parking_place  $parking_place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parking_place $parking_place)
    {
        $parking_place->delete();
        return response(null, 204);
    }
}
