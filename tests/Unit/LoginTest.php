<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\admin;
use App\Models\Raffletor;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_admin()
    {
        $admin = Admin::create([
            'name' => 'Antonio Barraza',
            'email' => 'antonio.barraza.guzman@gmail.com',
            'password' => bcrypt('Luckygo23'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'antonio.barraza.guzman@gmail.com',
            'password' => 'Luckygo23',
        ]);

        $response->assertRedirect(route('raffletors.manage'));
        $this->assertAuthenticatedAs($admin, 'admin');
    }
    
}