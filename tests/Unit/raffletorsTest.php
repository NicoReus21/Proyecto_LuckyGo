<?php

namespace Tests\Unit;

use App\Mail\PasswordMailable;
use Illuminate\Http\Request;
use App\Models\Raffletor;
use App\Http\Controllers\RaffletorController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RaffletorsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    public function test_store_success()
    {
        Mail::fake();

        $request = Request::create('/raffletors', 'POST', [
            'name_create' => 'Freddy Mercury',
            'age_create' => 30,
            'email_create' => 'fmercury@example.com',
        ]);

        $controller = new RaffletorController();
        $controller->store($request);
        Mail::assertSent(PasswordMailable::class);
    }
}
