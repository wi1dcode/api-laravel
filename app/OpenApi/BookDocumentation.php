<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

class BookDocumentation
{
    #[OA\Get(
        path: '/books',
        summary: 'Lister les livres',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Liste des livres',
                content: new OA\JsonContent(
                    example: [
                        'data' => [
                            [
                                'title' => 'Dune',
                                'author' => 'FRANK HERBERT',
                                'summary' => 'Épopée de science-fiction centrée sur la planète Arrakis.',
                                'isbn' => '9780441013593',
                                '_links' => [
                                    'self' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'GET'],
                                    'update' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'PUT'],
                                    'delete' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'DELETE'],
                                    'all' => ['href' => 'http://localhost:8000/api/v1/books', 'method' => 'GET'],
                                ],
                            ],
                        ],
                        'links' => [
                            'first' => 'http://localhost:8000/api/v1/books?page=1',
                            'last' => 'http://localhost:8000/api/v1/books?page=1',
                            'prev' => null,
                            'next' => null,
                        ],
                        'meta' => [
                            'current_page' => 1,
                            'from' => 1,
                            'last_page' => 1,
                            'links' => [],
                            'path' => 'http://localhost:8000/api/v1/books',
                            'per_page' => 2,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ]
                )
            ),
        ]
    )]
    public function index(): void
    {
    }

    #[OA\Post(
        path: '/books',
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
            new OA\Response(
                response: 201,
                description: 'Livre créé',
                content: new OA\JsonContent(
                    example: [
                        'data' => [
                            'title' => 'Dune',
                            'author' => 'FRANK HERBERT',
                            'summary' => 'Épopée de science-fiction centrée sur la planète Arrakis.',
                            'isbn' => '9780441013593',
                            '_links' => [
                                'self' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'GET'],
                                'update' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'PUT'],
                                'delete' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'DELETE'],
                                'all' => ['href' => 'http://localhost:8000/api/v1/books', 'method' => 'GET'],
                            ],
                        ],
                    ]
                )
            ),
            new OA\Response(response: 401, description: 'Non authentifié'),
            new OA\Response(response: 422, description: 'Erreur de validation'),
        ]
    )]
    public function store(): void
    {
    }

    #[OA\Get(
        path: '/books/{book}',
        summary: 'Afficher un livre',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(name: 'Accept', in: 'header', required: true, example: 'application/json'),
            new OA\Parameter(name: 'book', in: 'path', required: true, example: 1),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Livre trouvé',
                content: new OA\JsonContent(
                    example: [
                        'data' => [
                            'title' => 'Dune',
                            'author' => 'FRANK HERBERT',
                            'summary' => 'Épopée de science-fiction centrée sur la planète Arrakis.',
                            'isbn' => '9780441013593',
                            '_links' => [
                                'self' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'GET'],
                                'update' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'PUT'],
                                'delete' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'DELETE'],
                                'all' => ['href' => 'http://localhost:8000/api/v1/books', 'method' => 'GET'],
                            ],
                        ],
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Livre introuvable'),
        ]
    )]
    public function show(): void
    {
    }

    #[OA\Put(
        path: '/books/{book}',
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
            new OA\Response(
                response: 200,
                description: 'Livre modifié',
                content: new OA\JsonContent(
                    example: [
                        'data' => [
                            'title' => 'Dune Messiah',
                            'author' => 'FRANK HERBERT',
                            'summary' => 'Suite de Dune.',
                            'isbn' => '9780441172696',
                            '_links' => [
                                'self' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'GET'],
                                'update' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'PUT'],
                                'delete' => ['href' => 'http://localhost:8000/api/v1/books/1', 'method' => 'DELETE'],
                                'all' => ['href' => 'http://localhost:8000/api/v1/books', 'method' => 'GET'],
                            ],
                        ],
                    ]
                )
            ),
            new OA\Response(response: 401, description: 'Non authentifié'),
            new OA\Response(response: 404, description: 'Livre introuvable'),
            new OA\Response(response: 422, description: 'Erreur de validation'),
        ]
    )]
    public function update(): void
    {
    }

    #[OA\Delete(
        path: '/books/{book}',
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