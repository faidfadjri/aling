<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('pages.client.order.order', [
            'active' => 'order'
        ]);
    }

    public function checkout($productID = null)
    {
        $product = (object) [
            'id' => $productID,
            'title' => 'Ayam Potong 5KG',
            'price' => 40000,
            'image' => 'https://cdn.rri.co.id/berita/Palangkaraya/o/1727136526950-WhatsApp_Image_2024-09-24_at_07.05.34/dju4f310k9l3wam.jpeg',
            'quantity' => 1,
        ];

        $alamat = 'Jl. Raya Kby. Lama, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, 11540 (PT Akastra Toyota)';
        $biayaAdmin = 5000;

        $totalHarga = $product->price * $product->quantity;
        $totalTagihan = $totalHarga + $biayaAdmin;

        return view('pages.client.product.checkout', [
            'active' => 'product',
            'productID' => $productID,
            'product' => $product,
            'alamat' => $alamat,
            'biayaAdmin' => $biayaAdmin,
            'totalHarga' => $totalHarga,
            'totalTagihan' => $totalTagihan,
        ]);
    }
}
