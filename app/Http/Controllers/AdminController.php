<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::get();

        return view('admin.adminList', compact('admins'));
    }
}
