<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return Item::paginate(20);
    }

    public function show(Item $item)
    {
        return $item->load([]);
    }

    public function search(Request $request)
    {
        return Item::search($request->input('query'))
            ->get()
            ->load([]);
    }
}
