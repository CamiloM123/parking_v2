<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Ticket;
use App\Models\Parking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use function GuzzleHttp\Promise\each;
use App\Http\Requests\api\v1\ParkingStoreRequest;
use App\Models\Vehicle;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parkings = Parking::orderBy('name', 'asc')->get();
        return response()->json(['data' => $parkings], 200);
    }

    public function statistics(Parking $parking, Request $request)
    {
        $id = $parking->id;
        $tickets = Parking::find($id)->tickets()->get();
        $carros = 0;
        $motos = 0;
        $tickets = $tickets->filter(function ($ticket) {
            return $ticket->exit_time == null;
        });
        foreach($tickets as $ticket){
            $vehicle = $ticket->vehicle()->get()->first();
            $type = $vehicle->type_id;
            if($type == 1){
                $carros++;
            }else{
                $motos++;
            }
       
        }
            
        //Obtener cantidad de carros y cantidad de motos
            
           
        return response()->json(['message' => 'La cantidad de motos es de '.$motos.' y la cantidad de carros es de '.$carros,
                                 'data' => $tickets], 200);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingStoreRequest $request)
    {
        $parking = Parking::create($request->all());
        return response()->json(['data' => $parking], 201);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function show(Parking $parking)
    {
        return response()->json(['data' => $parking], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parking $parking)
    {
        $parking->update($request->all());
        return response()->json(['data' => $parking], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parking $parking)
    {
        $parking->delete();
        return response(null, 204);
    }
}
