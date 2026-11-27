<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Store a new contact request from the landing page form.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:120'],
                'email' => ['required', 'email', 'max:190'],
                'phone' => ['required', 'string', 'max:40'],
                'message' => ['required', 'string', 'min:10', 'max:2000'],
            ],
            [
                'name.required' => 'Por favor, introduce tu nombre.',
                'name.max' => 'El nombre no puede superar los 120 caracteres.',
                'email.required' => 'Por favor, introduce tu correo electrónico.',
                'email.email' => 'Introduce un correo electrónico válido.',
                'phone.required' => 'Por favor, introduce tu teléfono de contacto.',
                'phone.max' => 'El teléfono no puede superar los 40 caracteres.',
                'message.required' => 'Por favor, escribe un breve mensaje.',
                'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
                'message.max' => 'El mensaje no puede superar los 2000 caracteres.',
            ]
        );

        $contactRequest = ContactRequest::create($validated);

        Log::info('Nueva solicitud de contacto recibida', [
            'id' => $contactRequest->id,
            'email' => $contactRequest->email,
        ]);

        $successMessage = '¡Solicitud registrada! Un asistente de NovaTech se pondrá en contacto contigo para concertar la visita presencial.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $successMessage,
                'id' => $contactRequest->id,
            ], 201);
        }

        return redirect()->to('/#contact')->with('contact_success', $successMessage);
    }
}
