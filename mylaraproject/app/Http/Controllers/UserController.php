<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
   public function index(Request $request)
{
    $query = User::query();

    // Age filter
    if ($request->age_filter == 'under15') {
        $query->where('age', '<', 15);
    } elseif ($request->age_filter == 'above15') {
        $query->where('age', '>', 15);
    }

    // Search filter
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $users = $query->get();

    return view('users.index', compact('users'));
}



}
