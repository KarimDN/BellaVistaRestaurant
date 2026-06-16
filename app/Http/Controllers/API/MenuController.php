<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Http\Resources\MenuItemCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\MenuItemResource;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            new MenuItemCollection(MenuItem::with('category')->where('is_available', true)->get()),
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'is_available' => 'boolean',
        ]);

        $menuItem = MenuItem::create($validated);
        return response()->json(
            new MenuItemResource($menuItem->load('category')), 
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        return response()->json(
            new MenuItemResource($menuItem->load('category')), 
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
        'name' => 'sometimes|string|max:255',
        'description' => 'nullable|string',
        'price' => 'sometimes|numeric|min:0',
        'category_id' => 'sometimes|exists:categories,id',
        'is_available' => 'boolean',
        ]);

        $menuItem->update($validated);
        return response()->json(
            new MenuItemResource($menuItem->load('category')), 
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
