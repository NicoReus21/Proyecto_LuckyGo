<?php

namespace Tests\Unit;

use App\Models\Role;
use Tests\TestCase;
use App\Models\Raffletor;
use Illuminate\Foundation\Testing\RefreshDatabase;


class RaffletorCountTest extends TestCase
{
    use RefreshDatabase;

    public function testRaffleListDisplaysCorrectNumberOfRaffletors()
    {
        // Crea algunos sorteadores simulados para la prueba
        Raffletor::factory()->count(5)->create();

        // Realiza la solicitud GET a la ruta del listado de sorteadores
        $response = $this->get(route('raffletors.index'));

        // Verifica que la respuesta tenga el código HTTP 200 (OK)
        $response->assertStatus(200);

        // Verifica que la tabla contenga exactamente 5 filas (una por cada sorteador creado)
        $response->assertSee('<tbody id="raffletorsTableBody">', false); // Verifica la existencia del tbody
        $response->assertSee('<tr class="bg-white">', false, true); // Verifica la existencia de las filas

        $raffletorsCount = Raffletor::count();
        $this->assertEquals(5, $raffletorsCount, 'El número de sorteadores creados no coincide'); // Asegura que se crearon 5 sorteadores exactamente

        $response->assertSeeText('Total de sorteadores: ' . $raffletorsCount); // Verifica que el texto con el número total de sorteadores esté presente
    }
}