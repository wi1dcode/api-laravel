<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

class AuthDocumentation
{
    #[OA\Post(
        path: '/api/v1/register',
        summary: 'Inscription d’un utilisateur',
        tags: ['Auth'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'email', 'password'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
                    new OA\Property(property: 'email', type: 'string', example: 'john@example.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'password123'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Utilisateur créé',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'User created successfully'),
                    ]
                )
            ),
            new OA\Response(response: 422, description: 'Erreur de validation'),
        ]
    )]
    public function register(): void
    {
    }

    #[OA\Post(
        path: '/api/v1/login',
        summary: 'Connexion d’un utilisateur',
        tags: ['Auth'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'john@example.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'password123'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Connexion réussie',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'token', type: 'string', example: '1|token'),
                    ]
                )
            ),
            new OA\Response(response: 401, description: 'Identifiants invalides'),
            new OA\Response(response: 422, description: 'Erreur de validation'),
        ]
    )]
    public function login(): void
    {
    }

    #[OA\Post(
        path: '/api/v1/logout',
        summary: 'Déconnexion de l’utilisateur',
        security: [['bearerAuth' => []]],
        tags: ['Auth'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
            new OA\Parameter(name: 'Authorization', in: 'header', required: true, example: 'Bearer <token>'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Déconnexion réussie',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Logged out'),
                    ]
                )
            ),
            new OA\Response(response: 401, description: 'Non authentifié'),
        ]
    )]
    public function logout(): void
    {
    }
}