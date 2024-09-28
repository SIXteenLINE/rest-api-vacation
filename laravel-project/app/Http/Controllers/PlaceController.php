<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    // Получить все места
    public function index()
    {
        return Place::all();
    }

    // Добавить новое место
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:places,name',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        return Place::create($validated);
    }
}
