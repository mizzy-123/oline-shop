<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\WaMessage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "firstname" => "required|string",
            "lastname" => "required|string",
            "username" => "required|string",
            "email" => "required|string|email:dns|unique:users",
            "password" => ['required', 'confirmed', Rules\Password::defaults()],
            "alamat" => "required|string",
            "negara" => "required|string",
            "kota" => "required|string",
            "zip" => "required|integer"
        ]);
        $phoneNumber = $request->wanumber;

        $pattern = '#^(\\+62|0)\\d{9,12}$#';
        if (preg_match($pattern, $phoneNumber)) {
            if (substr($phoneNumber, 0, 1) === '0') {
                $modifiedPhoneNumber = '62' . substr($phoneNumber, 1);
                $phoneNumber = $modifiedPhoneNumber;
            } else if (substr($phoneNumber, 0, 1) === '+') {
                $modifiedPhoneNumber = '62' . substr($phoneNumber, 1);
                $phoneNumber = $modifiedPhoneNumber;
            }
            // return $phoneNumber;
        } else {
            return back()->withErrors("Nomor tidak valid")->withInput();
        }

        if (!$validated->fails()) {
            $filter = $request->except("firstname", "lastname", "username", "email", "alamat", "negara", "kota", "zip", "_token", "password", "wanumber", "password_confirmation");
            $hasOtherData = count(array_filter($filter)) > 0;
            if ($hasOtherData) {
                $data = $validated->validated();
                $pesan = $data['firstname'] . " " . $data['lastname'] . "\n\n" . "Your order" . "\n";
                $totalHarga = 0;
                DB::beginTransaction();
                for ($x = 1; $x <= $request->pProduct; $x++) {
                    $totalHarga = $totalHarga + ($request['price' . $x] * $request['quantity' . $x]);
                    $product = Product::find($request['productId' . $x]);
                    $dataPesan = "$product->name\n" . $request['quantity' . $x] . " x Rp." . $request['price' . $x] . " = Rp." . $request['price' . $x] * $request['quantity' . $x] . "\n\n";
                    $pesan .= $dataPesan;
                    $stock = $product->qty - $request['quantity' . $x];
                    if ($stock >= 0) {
                        $product->qty = $stock;
                        $product->save();
                    } else {
                        DB::rollBack();
                        return back()->withErrors("Insufficient stock for $product->name currently $product->qty left in stock")->withInput();
                    }
                }
                DB::commit();

                $hargaFix = $totalHarga + $request->shipper;
                $pesan .= "-----------------------------------------------------------------\n\nSub total = Rp.$totalHarga\n\nOngkir = Rp.$request->shipper\n\n-----------------------------------------------------------------\n\nGrand Total = Rp.$hargaFix\n\n";
                $pesan .= "-----------------------------------------------------------------\n\nPembayaran\n\nMuhammad Mizzy\nDana\n082141765353\n\nMUHAMMAD MIZZY\nBank Mandiri\n1350017150572\n\n";
                $pesan .= "Thank you for shopping";
                try {

                    $response = $this->sendWa($pesan, $phoneNumber);
                    if (!$response->failed()) {
                        WaMessage::create([
                            'name' => $data['firstname'] . " " . $data['lastname'],
                            'no_wa' => $phoneNumber,
                            'message' => $pesan,
                            'status' => 1
                        ]);
                    } else {
                        WaMessage::create([
                            'name' => $data['firstname'] . " " . $data['lastname'],
                            'no_wa' => $phoneNumber,
                            'message' => $pesan,
                            'status' => 2
                        ]);
                    }
                } catch (\Throwable $th) {
                    WaMessage::create([
                        'name' => $data['firstname'] . " " . $data['lastname'],
                        'no_wa' => $phoneNumber,
                        'message' => $pesan,
                        'status' => 2
                    ]);
                    return "error";
                }
            } else {
                return back()->withErrors("Yout cart is empty")->withInput();
            }

            return $this->registerUser($request);
        } else {
            return back()->withErrors($validated)
                ->withInput();
        }
    }

    public function sendWa($pesan, $nomor)
    {
        $response = Http::withHeaders([
            'key' => env('KEY')
        ])->get(env('API_URL_WHATSSAPP') . 'send-message', [
            'session' => env('SESSION'),
            'to' => $nomor,
            'text' => $pesan
        ]);

        return $response;
    }

    public function registerUser($request)
    {
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('verification.notice'))->with('verif', 'verifikasi email telah dikirim');
    }
}
