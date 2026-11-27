<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_request_is_stored_via_json(): void
    {
        $response = $this->postJson(route('contact.store'), [
            'name' => 'Teodoro Castillo',
            'email' => 'teodoro@tienda.es',
            'phone' => '600123456',
            'message' => 'Necesito digitalizar la gestión de facturas y stock de mi comercio.',
        ]);

        $response->assertCreated()
            ->assertJsonStructure(['message', 'id']);

        $this->assertDatabaseHas('contact_requests', [
            'name' => 'Teodoro Castillo',
            'email' => 'teodoro@tienda.es',
            'phone' => '600123456',
        ]);
    }

    public function test_contact_request_is_stored_via_standard_post(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Teodoro Castillo',
            'email' => 'teodoro@tienda.es',
            'phone' => '600123456',
            'message' => 'Quiero una página web sencilla para mi tienda de barrio.',
        ]);

        $response->assertRedirect('/#contact')
            ->assertSessionHas('contact_success');

        $this->assertDatabaseCount('contact_requests', 1);
    }

    public function test_contact_request_requires_valid_fields(): void
    {
        $response = $this->postJson(route('contact.store'), [
            'name' => '',
            'email' => 'correo-invalido',
            'phone' => '',
            'message' => 'corto',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'phone', 'message']);

        $this->assertDatabaseCount('contact_requests', 0);
    }
}
