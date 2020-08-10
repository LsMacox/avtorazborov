<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function cabinet() {
        return redirect()->route( auth()->user()->getRole().'.proposal.index');
    }
}
