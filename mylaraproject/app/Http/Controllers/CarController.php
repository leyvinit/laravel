<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;



class CarController extends Controller
{
    public function index(Request $request)
{
    $users = User::all();  // To populate the dropdown

    $selectedUser = null;
    $cars = collect();
    $message = null;

    if ($request->has('user_id')) {
        $selectedUser = User::find($request->user_id);
        if ($selectedUser) {
            if ($selectedUser->age >= 16) {
                $cars = Car::where('user_id', $selectedUser->id)->get();
                return view('cars.index', compact('users', 'selectedUser', 'cars', 'message'));
            } else {
                return view('cars.access-denied', compact('selectedUser', 'users'));
            }
        } else {
            $message = "User not found.";
        }
    }

    // If no user selected or user not found, show index with just users list
    return view('cars.index', compact('users', 'selectedUser', 'cars', 'message'));
}

}
