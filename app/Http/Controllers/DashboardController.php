<?php

namespace App\Http\Controllers;

use App\Models\WaMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $wa = WaMessage::orderByDesc('created_at')->get();
        $mesage_failed = WaMessage::where('status', 2)->get()->count();
        $mesage_succes = WaMessage::where('status', 1)->get()->count();
        return view('dashboard.pages.dashboard', [
            'waMessage' => $wa,
            'mesage_failed' => $mesage_failed,
            'mesage_succes' => $mesage_succes
        ]);
    }
}
