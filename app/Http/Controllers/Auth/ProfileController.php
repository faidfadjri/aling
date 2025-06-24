<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function address()
    {
        return view('pages.client.profile.address');
    }

    public function addAddress($addressID = null)
    {
        return view('pages.client.profile.add-address', [
            'addressID' => $addressID
        ]);
    }
}
