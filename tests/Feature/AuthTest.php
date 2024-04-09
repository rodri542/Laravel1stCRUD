<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function a_user_can_see_entrenador(): void
    {
        $response = $this->get('/entrenadores');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_see_bienvenido()
    {
        $response = $this->get('/bienvenido');
        $response->assertStatus(200);
    }


       /** @test */
       public function a_user_can_create_a_entrenador()
       {
           $newsData = [
               'nombreEn' => 'Pepe',
               'edad' => 1,
               'ciudad' => 'Puebla',
           ];
   
           $this->post('/entrenadores', $newsData)
                ->assertRedirect('/entrenadores');
   
           $this->assertDatabaseHas('entrenadors', ['nombreEn' => 'Pepe']);
       }


}
