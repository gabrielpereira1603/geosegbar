<?php

namespace App\Services\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserService
{
    protected string $endpoint;
    protected string $apiUrl;

    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
        $this->apiUrl = config('services.spring_api.base_url'). $endpoint ;
    }

    public function getAllUsers()
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

    public function getUserById($id)
    {
        $token = Session::get('token');

        if (!$token) {
            throw new HttpException(401, 'Token de autenticação não encontrado');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get($this->apiUrl . '/' . $id);

        if (!$response->successful()) {
            return $this->handleError($response);
        }

        return $response->json();
    }

    public function updateUser($payload, $user_id)
    {
        $token = Session::get('token');

        if (!$token) {
            throw new HttpException(401, 'Token de autenticação não encontrado');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->put($this->apiUrl . '/' . $user_id, $payload);
        if (!$response->successful()) {
            return $this->handleError($response);
        }

        return $response->json();
    }
    public function deleteUser(int $userId)
    {
        $token = Session::get('token');

        if (!$token) {
            throw new HttpException(401, 'Token de autenticação não encontrado');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->delete("{$this->apiUrl}/$userId");

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

        Log::error('Erro na API de Usuários', [
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
