<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShoppingListResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function show(Request $request): JsonResponse|ShoppingListResource
    {
        $list = $request->user()
            ->shoppingList()
            ->with('items:id,name,shopping_list_id')
            ->select('id', 'user_id', 'created_at', 'updated_at')
            ->first();

        if (!$list) {
            return response()->json(['message' => 'Liste introuvable.'], 404);
        }

        return new ShoppingListResource($list);
    }
}