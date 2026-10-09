<?php

namespace App\Http\Controllers;

use App\Models\TransportOffering;
use Illuminate\View\View;

class TransportController extends Controller
{
    public function index(): View
    {
        $vehicles = TransportOffering::active()->vehicles()->orderBy('sort_order')->orderBy('name')->get();
        $bodyTypes = TransportOffering::active()->bodyTypes()->orderBy('sort_order')->orderBy('name')->get();

        return view('transport.index', compact('vehicles', 'bodyTypes'));
    }
}
