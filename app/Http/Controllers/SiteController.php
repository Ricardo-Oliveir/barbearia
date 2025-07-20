<?php

namespace App\Http\Controllers;

use App\Models\AvailableSlot;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SiteController extends Controller
{
    public function index()
    {
$groupedSlots = AvailableSlot::where('slot_datetime', '>', now())
            ->orderBy('slot_datetime', 'asc')
            ->get()
            ->groupBy(function ($slot) {
                return Carbon::parse($slot->slot_datetime)->format('Y-m-d');
            });

        $products = Product::orderBy('created_at', 'desc')->get();

        return view('home', [
            'groupedSlots' => $groupedSlots,
            'products' => $products
        ]);
    }
}
