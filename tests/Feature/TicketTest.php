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

class TicketTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_create_valid_ticket()
    {
        // $this->refreshDatabase();
        $this->seed();
        $vehicle = Vehicle :: first();
        $vehicle_id = $vehicle->id + 1;
        $parking_place = Parking_place :: first();
        $parking_place_id = $parking_place->id + 1;
        
        $id = Parking :: first()->id;
        // $user = User::factory()->create();
        $user = User::first();
        $response = $this
            ->actingAs($user)
            ->postJson("/api/v1/parkings/$id/tickets", [
                "vehicle_id" => $vehicle_id,
                "parking_place_id" => $parking_place_id,
            ])
            ->assertStatus(201)
            ->assertJson([
                "message" => 'El carro con id '.$vehicle_id.' ha sido parqueado',
            
            ]);

        $this->assertDatabaseHas('tickets', [
                "vehicle_id" => $vehicle_id,
                "parking_place_id" => $parking_place_id,
            ]);
        
    }

    public function test_create_invalid_parking_place_ticket()
    {
        // $this->refreshDatabase();
        $this->seed();

        $count = Ticket ::count();
        $ticket = Ticket :: first();
        $vehicle_id = $ticket->vehicle_id;
        $parking_place_id = $ticket->parking_place_id;
        
        $id = Parking :: first()->id;
        // $user = User::factory()->create();
        $user = User::first();
        $response = $this
            ->actingAs($user)
            ->postJson("/api/v1/parkings/$id/tickets", [
                "vehicle_id" => $vehicle_id,
                "parking_place_id" => $parking_place_id,
            ])
            ->assertStatus(400)
            ->assertJson([
                "message" => 'Ese lugar de estacionamiento no esta disponible',
            
            ]);

        $this->assertDatabaseCount('tickets', $count);
    }


    public function test_unpark_a_vehicle()
    {
        // $this->refreshDatabase();
        $this->seed();

        $ticket = Ticket :: first();
        $ticket_id = $ticket->id;

        $old_ticket = Ticket::find($ticket_id);
        $vehicle_id = $old_ticket->vehicle_id;

        $id = Parking :: first()->id;
        // $user = User::factory()->create();
        $user = User::first();
        $response = $this
            ->actingAs($user)
            ->putJson("/api/v1/parkings/$id/tickets/$ticket_id", [])
            ->assertStatus(200)
            ->assertJson([
                "message" => 'El carro con id '.$vehicle_id.' ha salido del parqueadero correctamente',
            
            ]);

        $new_ticket = Ticket::find($ticket_id);
        // $this->assertNotEquals($old_ticket->exit_time, $new_ticket->exit_time);
        $this->assertNotEquals(null , $new_ticket->exit_time);
        
    }

    public function test_invalid_unpark_a_vehicle_twice()
    {   
        $this->seed();
        
        $ticket = Ticket :: first();
        $ticket_id = $ticket->id;
        $vehicle_id = $ticket->vehicle_id;

        $id = Parking :: first()->id;
        $user = User::first();

        //Primero desparqueamos el vehiculo
        $response = $this
            ->actingAs($user)
            ->putJson("/api/v1/parkings/$id/tickets/$ticket_id", [])
            ->assertStatus(200)
            ->assertJson([
                "message" => 'El carro con id '.$vehicle_id.' ha salido del parqueadero correctamente',
            
            ]);

        $old_ticket = Ticket::find($ticket_id);
    
        //Segundo intento de desparquear el vehiculo

        $response = $this
            ->actingAs($user)
            ->putJson("/api/v1/parkings/$id/tickets/$ticket_id", [])
            ->assertStatus(400)
            ->assertJson([
                "message" => 'El carro con id '.$vehicle_id.' ya salio del parqueadero',
            
            ]);

        $new_ticket = Ticket::find($ticket_id);
        // $this->assertNotEquals($old_ticket->exit_time, $new_ticket->exit_time);
        $this->assertEquals($old_ticket , $new_ticket);
        
    }

    

    

}
