<?php

namespace Tests\Unit;

use App\Http\Controllers\RaffleController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RaffleRegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    public function test_Register_winner_update()
    {
        // Insertar un sorteo de ejemplo en la base de datos
        DB::table('raffles')->insert([
            [
                'status' => 1,
                'winner_number' => '[1,2,3,4,5]',
                'winner_number_lucky' => '[1,2,3,4,5]',
                'end_date' => '2024-06-23',
                'raffletor_id' => null,
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);

        $request = Request::create('/raffletors', 'POST', [
            'raffle_id' => 1, 
            'winner_numbers' => [1, 2, 3, 4, 5],
            'winner_numbers_lucky' => [1, 2, 3, 4, 5],
        ]);

        $controller = new RaffleController;
        $response = $controller->updateWinner($request);

        $this->assertDatabaseHas('raffles', [
            'id' => 1,
            'status' => 2,
            'winner_number' => json_encode([1, 2, 3, 4, 5]),
            'end_date' => '2024-06-23',
            'raffletor_id' => null,
        ]);
    }
}
