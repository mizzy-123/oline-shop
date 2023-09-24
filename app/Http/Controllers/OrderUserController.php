<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderUserController extends Controller
{
    public function detail(Order $order)
    {
        $tanggal = $order->created_at;
        $getCarbon = Carbon::parse($tanggal);
        $carbonKadaluarsa = $getCarbon->addDays(2);
        $tanggalKadaluarsa = $carbonKadaluarsa->format('Y-m-d H:i:s');
        $getTanggal = $tanggal->format('Y-m-d H:i:s');
        $perbedaanWaktu = $carbonKadaluarsa->diffForHumans();
        return view('dashboard.user-pages.detail-order', [
            'order' => $order,
            'dibuat' => $getTanggal,
            'kadaluarsa' => $tanggalKadaluarsa,
            'peringatan' => $perbedaanWaktu
        ]);
    }
}
