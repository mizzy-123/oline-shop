<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\WaMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        if (Gate::check('admin')) {
            $wa = WaMessage::orderByDesc('created_at')->paginate(10);
            $mesage_failed = WaMessage::where('status', 2)->get()->count();
            $mesage_succes = WaMessage::where('status', 1)->get()->count();
            $total_order = Order::all()->count();
            $order_unpaid = Order::where('status', 0)->get()->count();
            $order_paid = Order::where('status', 1)->get()->count();
            $order_cancel = Order::where('status', 2)->get()->count();
            return view('dashboard.pages.dashboard', [
                'waMessage' => $wa,
                'mesage_failed' => $mesage_failed,
                'mesage_succes' => $mesage_succes,
                'total_order' => $total_order,
                'order_unpaid' => $order_unpaid,
                'order_paid' => $order_paid,
                'order_cancel' => $order_cancel
            ]);
        } else {

            // fake error
            $order = Auth::user()->order()->orderByDesc('created_at')->get();
            return view('dashboard.user-pages.dashboard', [
                'order' => $order
            ]);
        }
    }
}
