<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'API Laravel',
    description: 'Documentation de l’API Laravel'
)]
#[OA\Server(
    url: 'http://localhost:8000/api/v1',
    description: 'Serveur local'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'Sanctum'
)]
class OpenApi
{
}