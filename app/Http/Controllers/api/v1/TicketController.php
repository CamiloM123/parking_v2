<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\api\v1\TicketStoreRequest;
use App\Models\Parking;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::orderBy('id', 'asc')->get();
        return response()->json(['data' => $tickets], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketStoreRequest $request, Parking $parking)
    { 
        $ticket = new Ticket();
        $ticket->parking_place_id = $request->input('parking_place_id');
        $ticket->vehicle_id = $request->input('vehicle_id');
        $ticket->parking_id = $parking->id;
        $ticket->save();
        
        return response()->json(['data' => $ticket], 201);
    }

    public function unpark(Ticket $ticket)
    {
        $ticket->exit_time = now();
        return response()->json(['data' => $ticket], 200);
    }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return response()->json(['data' => $ticket], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        // $ticket->update($request->all());
        $ticket->exit_time = now();
        $ticket->save();
        return response()->json(['data' => $ticket], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response(null, 204);
    }
}
