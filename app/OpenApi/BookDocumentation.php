<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

class BookDocumentation
{
    #[OA\Get(
        path: '/api/v1/books',
        summary: 'Lister les livres',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Liste des livres'),
        ]
    )]
    public function index(): void
    {
    }

    #[OA\Post(
        path: '/api/v1/books',
        summary: 'Créer un livre',
        security: [['bearerAuth' => []]],
        tags: ['Books'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
            new OA\Parameter(name: 'Authorization', in: 'header', required: true, example: 'Bearer <token>'),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['title', 'author', 'summary', 'isbn'],
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'Dune'),
                    new OA\Property(property: 'author', type: 'string', example: 'Frank Herbert'),
                    new OA\Property(property: 'summary', type: 'string', example: 'Épopée de science-fiction centrée sur la planète Arrakis.'),
                    new OA\Property(property: 'isbn', type: 'string', example: '9780441013593'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Livre créé'),
            new OA\Response(response: 401, description: 'Non authentifié'),
            new OA\Response(response: 422, description: 'Erreur de validation'),
        ]
    )]
    public function store(): void
    {
    }

    #[OA\Get(
        path: '/api/v1/books/{book}',
        summary: 'Afficher un livre',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
            new OA\Parameter(name: 'book', in: 'path', required: true, example: 1),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Livre trouvé'),
            new OA\Response(response: 404, description: 'Livre introuvable'),
        ]
    )]
    public function show(): void
    {
    }

    #[OA\Put(
        path: '/api/v1/books/{book}',
        summary: 'Modifier un livre',
        security: [['bearerAuth' => []]],
        tags: ['Books'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
            new OA\Parameter(name: 'Authorization', in: 'header', required: true, example: 'Bearer <token>'),
            new OA\Parameter(name: 'book', in: 'path', required: true, example: 1),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['title', 'author', 'summary', 'isbn'],
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'Dune'),
                    new OA\Property(property: 'author', type: 'string', example: 'Frank Herbert'),
                    new OA\Property(property: 'summary', type: 'string', example: 'Épopée de science-fiction centrée sur la planète Arrakis.'),
                    new OA\Property(property: 'isbn', type: 'string', example: '9780441013593'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Livre modifié'),
            new OA\Response(response: 401, description: 'Non authentifié'),
            new OA\Response(response: 404, description: 'Livre introuvable'),
            new OA\Response(response: 422, description: 'Erreur de validation'),
        ]
    )]
    public function update(): void
    {
    }

    #[OA\Delete(
        path: '/api/v1/books/{book}',
        summary: 'Supprimer un livre',
        security: [['bearerAuth' => []]],
        tags: ['Books'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
            new OA\Parameter(name: 'Authorization', in: 'header', required: true, example: 'Bearer <token>'),
            new OA\Parameter(name: 'book', in: 'path', required: true, example: 1),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Livre supprimé'),
            new OA\Response(response: 401, description: 'Non authentifié'),
            new OA\Response(response: 404, description: 'Livre introuvable'),
        ]
    )]
    public function destroy(): void
    {
    }
}