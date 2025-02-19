<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::latest()->paginate(6); 

        return view('orders.index', compact('orders'));
    }

}