<?php

namespace App\Client;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SpringBoot
{
    protected string $base_url;

    public function __construct()
    {
        $this->base_url = config('services.spring_api.base_url');
    }

    public function get($endpoint, $params = []): Response
    {
        return Http::get("{$this->base_url}/{$endpoint}", $params);
    }

    public function post($endpoint, $data = []): Response
    {
        return Http::post("{$this->base_url}/{$endpoint}", $data);
    }
}
