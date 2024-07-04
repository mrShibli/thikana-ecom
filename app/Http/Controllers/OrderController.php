<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index (Request $request) {
        $status = $request->get ("status");
        $orders = order::with ("products");
        if ($status && $status !== '') {
            $orders = $orders->where ("status", $status);
        }
        $orders = $orders->orderBy ("updated_at","desc");
        $orders =  $orders->get ();
        return view ('admin.orders', compact ("orders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit (order $order) {
        return view ("admin.orders.edit", compact ("order"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (Request $request, order $order) {
        $order->status = $request->status;
        $order->save ();
        flash ("order Updated");
        return redirect ()->back ();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}
