<?php

namespace Tests\Feature;

use App\Models\Parking;
use App\Models\Parking_place;
use Tests\TestCase;
use App\Models\Ticket;
use App\Models\Vehicle;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParkingPlaceTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_statistics_park()
    {
        // $this->refreshDatabase();
        $this->seed();

        $id = Parking :: first()->id;
        $parking_place_id = Parking_place :: first()->id;
        $vehicle_id = Vehicle :: first()->id;
        
        $motos = 0;
        $carros = 1;
        $total = 14;
        
        //Primero obtenemos las estadisticas actuales del parqueadero
        $user = User::first();
        $response = $this
            ->actingAs($user)
            ->getJson("/api/v1/parkings/$id/parking_places?status=available", [])
            ->assertStatus(200)
            ->assertJson([
                "message" => "La cantidad de motos es de ".$motos.
                " y la cantidad de carros es de ".$carros.
                ". La cantidad de lugares disponibles es de ".$total."",
            ]);
        
        //Ahora agregamos una moto al parqueadero
        $vehicle_id = $vehicle_id + 1;
        $parking_place_id = $parking_place_id + 2;
    
        $response = $this
            ->actingAs($user)
            ->postJson("/api/v1/parkings/$id/tickets", [
                "vehicle_id" => $vehicle_id,
                "parking_place_id" => $parking_place_id,
            ]);

        //Ahora obtenemos las estadisticas actuales del parqueadero nuevamente
        $response = $this
            ->actingAs($user)
            ->getJson("/api/v1/parkings/$id/parking_places?status=available", [])
            ->assertStatus(200)
            ->assertJson([
                "message" => "La cantidad de motos es de ".($motos+1).
                " y la cantidad de carros es de ".($carros).
                ". La cantidad de lugares disponibles es de ".($total-1)."",
            ]);
                 
    }

    public function test_get_statistics_unpark()
    {
        // $this->refreshDatabase();
        $this->seed();

        $id = Parking :: first()->id;
        $ticket = Ticket :: first();
        $ticket_id = $ticket->id;
        $motos = 1;
        $carros = 0;
        $total = 14;
        
        //Primero obtenemos las estadisticas actuales del parqueadero
        $user = User::first();

        $response = $this
            ->actingAs($user)
            ->getJson("/api/v1/parkings/$id/parking_places?status=available", [])
            ->assertStatus(200)
            ->assertJson([
                "message" => "La cantidad de motos es de ".$motos.
                " y la cantidad de carros es de ".$carros.
                ". La cantidad de lugares disponibles es de ".$total."",
            ]);
        
        //Ahora sacamos un carro del parqueadero
        $response = $this
            ->actingAs($user)
            ->putJson("/api/v1/parkings/$id/tickets/$ticket_id", []);

        //Ahora obtenemos las estadisticas actuales del parqueadero nuevamente
        $response = $this
            ->actingAs($user)
            ->getJson("/api/v1/parkings/$id/parking_places?status=available", [])
            ->assertStatus(200)
            ->assertJson([
                "message" => "La cantidad de motos es de ".($motos-1).
                " y la cantidad de carros es de ".($carros).
                ". La cantidad de lugares disponibles es de ".($total+1)."",
            ]);
          
    }
    
    public function test_get_parking_place_available()
    {   
        $this->seed();
        
        $ticket = Ticket :: first();
        $ticket_id = $ticket->id;
        $vehicle_id = $ticket->vehicle_id;
        $parking_place_id = $ticket->parking_place_id;
        $parking_place = Parking_place :: find($parking_place_id);

        $row = $parking_place->row;
        $column = $parking_place->column;

        $id = Parking :: first()->id;
        // $user = User::factory()->create();
        $user = User::first();
        $response = $this
            ->actingAs($user)
            ->getJson("/api/v1/parkings/$id/parking_places?status=availableOne", [
                    "row" => $row,
                    "column" => $column,
            ])
            ->assertStatus(400)
            ->assertJson([
                "message" => "Ese lugar de estacionamiento no esta disponible",
            
            ]);

        $new_ticket = Ticket::find($ticket_id);
        // $this->assertNotEquals($old_ticket->exit_time, $new_ticket->exit_time);
        $this->assertDatabaseHas('tickets', [
            "vehicle_id" => $vehicle_id,
            "parking_place_id" => $parking_place_id,
        ]);
        
    }


    public function test_invalid_get_parking_place_available()
    {   
        $this->seed();
        
        $ticket = Ticket :: first();
        $ticket_id = $ticket->id;
        $vehicle_id = $ticket->vehicle_id;
        $parking_place_id = $ticket->parking_place_id;
        $parking_place = Parking_place :: find($parking_place_id);

        $row = $parking_place->row;
        $column = $parking_place->column;

        $id = Parking :: first()->id;
        // $user = User::factory()->create();
        $user = User::first();
        $response = $this
            ->actingAs($user)
            ->getJson("/api/v1/parkings/$id/parking_places?status=availableOne", [
                    "row" => $row,
                    "column" => $column,
            ])
            ->assertStatus(400)
            ->assertJson([
                "message" => "Ese lugar de estacionamiento no esta disponible",
            
            ]);

        $new_ticket = Ticket::find($ticket_id);
        // $this->assertNotEquals($old_ticket->exit_time, $new_ticket->exit_time);
        $this->assertDatabaseHas('tickets', [
            "vehicle_id" => $vehicle_id,
            "parking_place_id" => $parking_place_id,
        ]);
        
    }
}
