<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // 1. Tampilkan katalog paket laundry di halaman depan pelanggan
    public function index()
    {
        $packages = Package::all();
        return view('customer.index', compact('packages'));
    }

    // 2. Proses simpan order pemesanan laundry (Checkout)
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'items'          => 'required|array',
            'items.*'        => 'nullable|integer|min:0',
        ]);

        // Ambil hanya paket laundry yang jumlah pesanannya lebih dari 0
        $orderedItems = array_filter($request->items, fn ($qty) => $qty > 0);

        if (empty($orderedItems)) {
            return back()->with('error', 'Pilih minimal satu paket laundry!');
        }

        DB::beginTransaction();
        try {
            // A. Simpan Header Pesanan ke tabel 'orders'
            $orderCode = 'LND-' . date('YmdHis') . '-' . strtoupper(Str::random(4));
            $order = Order::create([
                'user_id'        => Auth::id(), // ID akun pelanggan jika sedang login
                'customer_name'  => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'order_code'     => $orderCode,
                'total_price'    => 0,
                'status'         => 'Pending',
            ]);

            $totalPrice = 0;

            // B. Simpan Detail Pesanan ke tabel 'order_details'
            foreach ($orderedItems as $packageId => $quantity) {
                $package = Package::findOrFail($packageId);

                // Potong kuota/kapasitas harian di database
                $package->decrement('stock', $quantity);

                $subtotal = $package->price * $quantity;
                $totalPrice += $subtotal;

                OrderDetail::create([
                    'order_id'   => $order->id,
                    'package_id' => $package->id,
                    'quantity'   => $quantity,
                    'price'      => $package->price,
                    'subtotal'   => $subtotal,
                ]);
            }

            // C. Simpan akumulasi total_price ke tabel orders
            $order->update(['total_price' => $totalPrice]);

            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Pesanan laundry berhasil dibuat! Kode Nota: ' . $order->order_code);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan laundry: ' . $e->getMessage());
        }
    }

    // 3. Tampilkan rekap seluruh pesanan laundry masuk di Dashboard Admin
    public function adminDashboard()
    {
        $orders = Order::with('orderDetails.package')->latest()->get();
        return view('dashboard', compact('orders'));
    }

    // 4. Update status cucian (Pending -> Proses -> Selesai -> Batal)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status cucian nota #' . $order->order_code . ' berhasil diperbarui!');
    }
}