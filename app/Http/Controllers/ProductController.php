<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(Request $request)
    {
        $keyword = $request->input('search');

        return view('pages.client.product.product', [
            'active'  => 'product',
            'keyword' => $keyword
        ]);
    }

    public function detail()
    {
        $product = (object) [
            'id' => 1,
            'title' => 'Ayam Potong 5KG',
            'price' => 40000,
            'original_price' => 50000,
            'discount_percent' => 20,
            'rating' => 4.6,
            'sold' => 500,
            'description' => 'Ayam potong segar 5KG, diproses higienis dan siap olah. Daging tebal, empuk, tanpa suntikan. Cocok untuk rumah tangga, usaha kuliner, dan acara besar. Simpan beku agar tetap segar.',
            'image' => 'https://cdn.rri.co.id/berita/Palangkaraya/o/1727136526950-WhatsApp_Image_2024-09-24_at_07.05.34/dju4f310k9l3wam.jpeg',
        ];

        $reviews = [
            (object) [
                'rating' => 5,
                'name' => 'Rina S.',
                'role' => 'Ibu Rumah Tangga',
                'comment' => 'Saya sudah beberapa kali beli ayam potong di sini, dan selalu puas. Dagingnya segar, bersih, dan tidak berbau. Potongannya juga rapi, jadi tinggal masak saja. Anak-anak di rumah jadi lahap makannya!',
            ],
            (object) [
                'rating' => 5,
                'name' => 'Budi P.',
                'role' => 'Pemilik Warung',
                'comment' => 'Daging ayam sangat membantu usaha saya. Selalu segar dan tepat waktu pengirimannya. Harga bersaing juga.',
            ],
            (object) [
                'rating' => 5,
                'name' => 'Sinta R.',
                'role' => 'Koki Catering',
                'comment' => 'Kualitas terjaga. Daging tebal dan bersih, sangat cocok untuk kebutuhan catering besar.',
            ],
            (object) [
                'rating' => 5,
                'name' => 'Sinta R.',
                'role' => 'Koki Catering',
                'comment' => 'Kualitas terjaga. Daging tebal dan bersih, sangat cocok untuk kebutuhan catering besar.',
            ],
            (object) [
                'rating' => 5,
                'name' => 'Sinta R.',
                'role' => 'Koki Catering',
                'comment' => 'Kualitas terjaga. Daging tebal dan bersih, sangat cocok untuk kebutuhan catering besar.',
            ],
            (object) [
                'rating' => 5,
                'name' => 'Sinta R.',
                'role' => 'Koki Catering',
                'comment' => 'Kualitas terjaga. Daging tebal dan bersih, sangat cocok untuk kebutuhan catering besar.',
            ],
            (object) [
                'rating' => 5,
                'name' => 'Sinta R.',
                'role' => 'Koki Catering',
                'comment' => 'Kualitas terjaga. Daging tebal dan bersih, sangat cocok untuk kebutuhan catering besar.',
            ],
        ];

        return view('pages.client.product.product-detail', [
            'active' => 'product',
            'product' => $product,
            'reviews' => $reviews,
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
