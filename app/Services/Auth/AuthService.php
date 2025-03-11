<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        $response = Http::post("{$this->apiUrl}/login/initiate", $credentials);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Erro ao autenticar com a API');
    }

    public function tokenVerify(array $credentials){

        $response = Http::post("{$this->apiUrl}/login/verify", $credentials);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Erro ao autenticar o token com a API');
    }
}
