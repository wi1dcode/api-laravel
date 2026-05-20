<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request): ItemResource
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5|max:50',
        ]);

        $list = $request->user()->shoppingList()->firstOrCreate([
            'user_id' => $request->user()->id,
        ]);

        $item = $list->items()->create($validated);

        return new ItemResource($item);
    }

    public function update(Request $request, Item $item): JsonResponse|ItemResource
    {
        if ($item->shoppingList->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Action non autorisée.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|min:5|max:50',
        ]);

        $item->update($validated);

        return new ItemResource($item);
    }

    public function destroy(Request $request, Item $item): JsonResponse
    {
        if ($item->shoppingList->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Action non autorisée.'], 403);
        }

        $item->delete();

        return response()->json(null, 204);
    }
}