<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Получить список желаемого для конкретного пользователя
    public function index(User $user)
    {
        return response()->json($user->wishlist()->with('place')->get());
    }

    // Добавить место в список желаемого для пользователя
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'place_id' => 'required|exists:places,id',
        ]);

        if ($user->wishlist()->count() >= 3) {
            return response()->json(['error' => 'Пользователь не может иметь более 3 мест в списке желаемого'], 400);
        }

        if ($user->wishlist()->where('place_id', $validated['place_id'])->exists()) {
            return response()->json(['error' => 'Место уже в списке желаемого'], 400);
        }

        $user->wishlist()->create($validated);

        return response()->json(['message' => 'Место добавлено в список желаемого'], 201);
    }
}
