<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $totalHarga = 0;
        for ($x = 1; $x <= $request->pProduct; $x++) {
            $totalHarga = $totalHarga + ($request['price' . $x] * $request['quantity' . $x]);
        }
        $hargaFix = $totalHarga + $request->shipper;

        return $hargaFix;
    }
}
