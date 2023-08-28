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
                    'key' => 'mysupersecretkey'
                ])->get('http://192.168.43.204:5001/start-session?scan=true', [
                    'session' => 'mysession'
                ]);

                if (!$response->failed()) {
                    $data = $response->json();

                    return view('dashboard.pages.scan', [
                        'status' => true,
                        'qr' => $data['data']['qr']
                    ]);
                } else {
                    return view('dashboard.pages.scan', [
                        'status' => false
                    ]);
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
}
