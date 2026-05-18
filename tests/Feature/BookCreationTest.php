<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_book_is_created_with_valid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/books', [
            'title' => 'Dune',
            'author' => 'Frank Herbert',
            'summary' => 'Épopée de science-fiction centrée sur la planète Arrakis.',
            'isbn' => '9780441013593',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('books', [
            'title' => 'Dune',
            'author' => 'Frank Herbert',
            'summary' => 'Épopée de science-fiction centrée sur la planète Arrakis.',
            'isbn' => '9780441013593',
        ]);
    }

    public function test_book_is_not_created_with_invalid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/books', [
            'title' => 'Du',
            'author' => 'Frank Herbert',
            'summary' => 'Épopée de science-fiction centrée sur la planète Arrakis.',
            'isbn' => '9780441013593',
        ]);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('books', [
            'isbn' => '9780441013593',
        ]);
    }

    public function test_book_is_not_created_when_user_is_not_authenticated(): void
    {
        $response = $this->postJson('/api/v1/books', [
            'title' => 'Dune',
            'author' => 'Frank Herbert',
            'summary' => 'Épopée de science-fiction centrée sur la planète Arrakis.',
            'isbn' => '9780441013593',
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('books', [
            'isbn' => '9780441013593',
        ]);
    }
}