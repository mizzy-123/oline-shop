<?php

namespace App\Http\Controllers;

use App\Models\Whatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ScanController extends Controller
{
    public function index()
    {
        $cek = Whatsapp::where('name', 'wa')->first();
        if ($cek->status == 0) {
            try {
                $response = Http::withHeaders([
                    'key' => env('KEY')
                ])->get(env('API_URL_WHATSSAPP') . 'start-session?scan=true', [
                    'session' => env('SESSION')
                ]);

                $data = $response->json();
                if (!$response->failed()) {

                    return view('dashboard.pages.scan', [
                        'status' => true,
                        'qr' => $data['data']['qr']
                    ]);
                } else {
                    return view('dashboard.pages.scan', [
                        'status' => false
                    ])->with('failed', $data['message']);
                }
            } catch (\Throwable $th) {
                return view('dashboard.pages.scan', [
                    'status' => false
                ]);
            }
        } else {
            return view('dashboard.pages.scan', [
                'status' => false,
                'qr' => '#'
            ]);
        }
    }

    public function status()
    {
        $statuswa = Whatsapp::where('name', 'wa')->first();
        return response()->json([
            'status' => $statuswa->status,
        ]);
    }

    public function disconnect()
    {
        try {
            $response = Http::withHeaders([
                'key' => env('KEY')
            ])->get(env('API_URL_WHATSSAPP') . 'delete-session', [
                'session' => env('SESSION')
            ]);

            $data = $response->json();

            if (!$response->failed()) {
                return back()->with('success', 'Disconnected successfull');
            } {
                return back()->with('failed', $data['message']);
            }
        } catch (\Throwable $th) {
            return back()->with('failed', 'Server error');
        }
    }
}
