<?php

namespace App\Services\Auth;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthService
{
    protected string $endpoint;
    protected string $apiUrl;

    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
        $this->apiUrl = config('services.spring_api.base_url'). $endpoint ;
    }

    public function login(array $credentials)
    {
        try {
            $response = Http::post("{$this->apiUrl}/login/initiate", $credentials);

            if ($response->successful()) {
                return $response->json();
            }

            $this->handleError($response);
        } catch (\Throwable $e) {
            Log::error('Erro inesperado na autenticação', ['exception' => $e]);
            throw new AuthenticationException('Ocorreu um erro inesperado ao autenticar.', [], 500);
        }
    }

    public function tokenVerify(array $credentials)
    {
        try {
            $response = Http::post("{$this->apiUrl}/login/verify", $credentials);

            if ($response->successful()) {
                return $response->json();
            }

            $this->handleError($response);
        } catch (\Throwable $e) {
            Log::error('Erro inesperado na verificação de token', ['exception' => $e]);
            throw new AuthenticationException('Ocorreu um erro inesperado ao verificar o token.', [], 500);
        }
    }

    private function handleError($response)
    {
        $statusCode = $response->status();
        $body = $response->json();
        $message = $body['message'] ?? 'Erro desconhecido';

        Log::error('Erro na API de autenticação', [
            'status' => $statusCode,
            'response' => $body
        ]);

        throw new HttpException($statusCode, $message);
    }

}
