<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.order', [
            'order' => Order::orderByDesc('created_at')->get()
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        if ($order && $request->status == 2) {
            foreach ($order->orderDetail()->get() as $o) {
                $p = Product::find($o->product_id);
                $p->update([
                    'qty' => $p->qty + $o->quantity
                ]);
            }
        }

        return back()->with('succes', 'Berhasil di update');
    }
}
