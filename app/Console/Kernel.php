<?php

namespace App\Console;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Ambil semua pesanan yang memenuhi kriteria
            $ordersToUpdate = Order::where('status', 0)
                ->where('created_at', '<', now()->subDays(2))
                ->get();

            // Loop melalui setiap pesanan yang memenuhi kriteria
            foreach ($ordersToUpdate as $order) {
                // Update status pesanan
                $order->update([
                    'status' => 2
                ]);

                // Loop melalui setiap detail pesanan yang terkait
                foreach ($order->orderDetail()->get() as $orderDetail) {
                    // Ambil produk berdasarkan product_id
                    $product = Product::find($orderDetail->product_id);

                    // Update stok produk
                    if ($product) {
                        $product->update([
                            'qty' => $product->qty + $orderDetail->quantity
                        ]);
                    }
                }
            }

            // Log::info('masuk');
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
