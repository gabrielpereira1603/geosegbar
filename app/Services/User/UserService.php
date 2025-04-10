<?php

namespace App\Services\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Client\ConnectionException;
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

    public function filterGetAllUsers($filters = [])
    {
        $token = Session::get('token');

        if (!$token) {
            throw new HttpException(401, 'Token de autenticação não encontrado');
        }

        $role_id = is_array($filters['role_id'] ?? null) ? $filters['role_id']['id'] : $filters['role_id'] ?? null;
        $client_id = $filters['client_id'] ?? null;

        $url = $this->apiUrl . '/filter?roleId=' . $role_id;

        if ($client_id) {
            $url .= '&clientId=' . $client_id;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get($url);

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

    public function createUser($payload)
    {
        $token = Session::get('token');

        if (!$token) {
            throw new HttpException(401, 'Token de autenticação não encontrado');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post($this->apiUrl . '/register' , $payload);
        if (!$response->successful()) {
            return $this->handleError($response);
        }

        return $response->json();
    }

    public function deleteUser($user_id)
    {
        $token = Session::get('token');
        if (!$token) {
            throw new HttpException(401, 'Token de autenticação não encontrado');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->delete("{$this->apiUrl}/$user_id");
        if (!$response->successful()) {
            return $this->handleError($response);
        }

        return $response->json();
    }

    public function changePassword($user_id, $payload){
        $token = Session::get('token');

        if (!$token) {
            throw new HttpException(401, 'Token de autenticação não encontrado');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->put($this->apiUrl . '/' . $user_id . '/password', $payload);
        if (!$response->successful()) {
            return $this->handleError($response);
        }

        return $response->json();
    }

    public function forgotPassword($payload){
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($this->apiUrl . '/forgot-password', $payload);
        if (!$response->successful()) {
            return $this->handleError($response);
        }

        return $response->json();
    }

    public function verifyResetCode($payload)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($this->apiUrl . '/verify-reset-code', $payload);
        if (!$response->successful()) {
            return $this->handleError($response);
        }

        return $response->json();
    }

    public function resetPassword($payload){
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($this->apiUrl . '/reset-password', $payload);
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
