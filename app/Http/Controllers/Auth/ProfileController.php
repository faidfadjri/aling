<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function address()
    {
        return view('pages.client.profile.address');
    }

    public function addAddress()
    {
        return view('pages.client.profile.add-address');
    }
}
