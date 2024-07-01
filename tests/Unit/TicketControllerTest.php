<?php
namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    public function test_verify_ticket_not_found()
    {
        $response = $this->get(route('validate_ticket', ['ticket_code' => 'LG999']));
        $response->assertRedirect();
        $response->assertSessionHas('message', 'el código ingresado no existe');
    }  
}
