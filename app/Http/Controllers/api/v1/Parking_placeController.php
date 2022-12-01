<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Ticket;
use App\Models\Parking;
use Illuminate\Http\Request;
use App\Models\Parking_place;
use Illuminate\Support\Facades\DB;
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
        $id = $parking->id;
        if($request->input('status') == 'available'){
        
            //Obtener los lugares de estacionamiento que estan disponibles
            $parking_places = $this->availables($id);
            $count = $parking_places->count();

            //Obtener la cantidad de motos y carros que estan estacionados
            list($carros,$motos) = $this->countSta($id);

            return response()->json(['message' => 'La cantidad de motos es de '.$motos.' y la cantidad de carros es de '.$carros.'. La cantidad de lugares disponibles es de '.$count ,
                                     'data' => $parking_places], 200);

        }
        elseif($request->input('status') == 'availableOne'){
            
            //Mirar si un estacionamiento en especifico esta disponible
            $place = $this->availableOne($id, $request->input('row'), $request->input('column'));
            $place = $place->first();
            if($place != []){
            return response()->json(['message' => 'Ese lugar de estacionamiento si esta disponible',
                                    'data' => $place,
                                    ]
                                    , 200);
            }else{
                return response()->json(['message' => 'Ese lugar de estacionamiento no esta disponible'], 400);
            }
        }
        else{

            $parking_places = Parking_place::where('parking_id', $id)->orderBy('id', 'asc')->get();
            return response()->json(['data' => $parking_places], 200);

        }

        
    }

    /**
     * Display a listing of availables parking places.
     *
     * @param  $parking_id
     * @return $parking_places
     */

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
     * Return the parking statistics.
     *
     * @param  $parking_id
     * @return $carros, $motos
     */

    public function countSta($parking_id)
    {
        //Obtener la cantidad de motos y carros que estan estacionados
        $tickets = Parking::find($parking_id)->tickets()->get();
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
        return [$carros, $motos];
    }

    


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
