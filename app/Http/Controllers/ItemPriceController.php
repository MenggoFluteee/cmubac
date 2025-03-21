<?php

namespace App\Http\Controllers;

use App\Models\ItemPrice;
use App\Http\Requests\StoreItemPriceRequest;
use App\Http\Requests\UpdateItemPriceRequest;

class ItemPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemPriceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemPrice $itemPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemPrice $itemPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemPriceRequest $request, ItemPrice $itemPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemPrice $itemPrice)
    {
        //
    }
}
