<?php

namespace App\Services\Sex;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SexService
{
    protected string $endpoint;
    protected string $apiUrl;

    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
        $this->apiUrl = config('services.spring_api.base_url'). $endpoint ;
    }

    public function getAllSexs()
    {
        $token = Session::get('token');

        if (!$token) {
            throw new HttpException(401, 'Token de autenticação não encontrado');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get($this->apiUrl);

        if (!$response->successful()) {
            return $this->handleError($response);
        }

        return $response->json();
    }

    private function handleError($response)
    {
        $statusCode = $response->status();
        $body = $response->json();
        $message = $body['message'] ?? 'Erro desconhecido';

        Log::error('Erro na API de Sexos', [
            'status' => $statusCode,
            'response' => $body
        ]);

        return [
            'success' => false,
            'message' => $message,
            'status' => $statusCode,
        ];
    }
}
