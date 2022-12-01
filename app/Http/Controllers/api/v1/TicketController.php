<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Ticket;
use App\Models\Parking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\TicketStoreRequest;
use App\Models\Parking_place;

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
        $parking_id = $parking->id;
        $parking_place = Parking_place :: find($request->input('parking_place_id'));

        $place = $this->availableOne($parking_id, $parking_place->row, $parking_place->column);
        $place = $place->first();

        if($place != [] ){

            $ticket = new Ticket();
            $ticket->parking_place_id = $request->input('parking_place_id');
            $ticket->vehicle_id = $request->input('vehicle_id');
            $id = $ticket->vehicle_id;
            $ticket->parking_id = $parking->id;
            $ticket->save();
        
            return response()->json(['message'=>'El carro con id '.$id.' ha sido parqueado' ,
                                    'data' => $ticket], 201);
        }else{

            return response()->json(['message'=>'Ese lugar de estacionamiento no esta disponible'
                                    ], 400);
        }
    }

    public function availables($parking_id)
    {
        //Lugares de estacionamiento disponibles
        $parking_places = Parking_place :: 
            whereDoesntHave('tickets', function ($query) 
            {
                $query->where('exit_time','=', null);
            })
            ->where('parking_id',$parking_id)->get();

        return $parking_places;
    }

    /**
     * Display a listing of individual available parking place.
     *
     * @param  $parking_id, $row, $column
     * @return $place
     */
    public function availableOne($parking_id, $row, $column)
    {   
        //Lugares de estacionamiento disponibles
        $parking_places = $this->availables($parking_id);
        
        //Mirar si uno en especifico esta disponible
        $place = $parking_places
            ->where('row', '=', $row)
            ->where('column', '=', $column);

            return $place;
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
    public function update(Request $request, Parking $parking, Ticket $ticket)
    {
        
        if($ticket->exit_time == null){
            $ticket->exit_time = now();
            $ticket->save();
            return response()->json(['message'=>'El carro con id '.$ticket->vehicle_id.' ha salido del parqueadero correctamente' ,
                                    'data' => $ticket], 200);
        }else{
            return response()->json(['message'=>'El carro con id '.$ticket->vehicle_id.' ya salio del parqueadero' ,
                                    'data' => $ticket], 400);
        }
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
