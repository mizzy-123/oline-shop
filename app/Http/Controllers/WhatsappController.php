<?php

namespace App\Http\Controllers;

use App\Models\WaMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    public function resend(WaMessage $wamessage)
    {
        try {
            $pesan = $wamessage->message;
            $nomor = $wamessage->no_wa;
            $response = $this->sendWa($pesan, $nomor);
            if (!$response->badRequest()) {
                $wamessage->update([
                    'status' => 1
                ]);
                return back()->with('succesSend', 'Send message succesfull');
            } else {
                return back()->with('errorSend', 'Cannot send message or you are not connected');
            }
        } catch (\Throwable $th) {
            return back()->with('errorSend', 'Server error');
        }
    }

    public function sendWa($pesan, $nomor)
    {
        $response = Http::withHeaders([
            'key' => 'mysupersecretkey'
        ])->get('http://localhost:5001/send-message', [
            'session' => 'mysession',
            'to' => $nomor,
            'text' => $pesan
        ]);

        return $response;
    }
}
