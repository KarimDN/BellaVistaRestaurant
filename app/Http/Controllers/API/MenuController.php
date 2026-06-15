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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        return new MenuItemResource($menuItem->load('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menuItem)
    {
        //
    }
}
