<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

pest()->use(RefreshDatabase::class);

beforeEach(function () {
    Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'manager']);
});

it('renders the registration page', function () {
    $this->get('/register')->assertOk();
});


it('allows new users to register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'phone' => '+1234567890',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'admin'
    ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
    ]);
});
