<?php

    namespace App\Http\Controllers\Client;

    use App\Http\Controllers\Controller;
    use App\Models\Cart;
    use App\Models\order;
    use App\Models\order_item;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class OrderController extends Controller {
        /**
         * Display a listing of the resource.
         */
        public function index () {
            $orders = order::get ();
            return view ('admin.orders',compact ("orders"));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create () {
            //
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store (Request $request) {
            // Validate the request
            $request->validate ([
                'name'    => 'required|string',
                'address' => 'required|string',
                'phone'   => 'required|string',
                'upazila' => 'required|string',
                'city'    => 'required|string',
                'message' => 'nullable|string',
            ]);

            $total = 0;
            // Get the cart items
            $carts = Cart::where ("user_id",Auth::id ())->get ();
            if (count ($carts) > 0) {
                // Calculate the total
                foreach ($carts as $cart) {
                    $total += $cart->price * $cart->qunt;
                }
            }
            // Create the order
            $order = order::create ([
                'name'    => $request->name,
                'address' => $request->address,
                'phone'   => $request->phone,
                'upazila' => $request->upazila,
                'city'    => $request->city,
                'message' => $request->message,
                'total'   => $total,
                'user_id' => Auth::user ()->id,
            ]);
            if ($order) {
                // Create the order items
                foreach ($carts as $cart) {
                    order_item::create ([
                        'order_id'   => $order->id,
                        'product_id' => $cart->product_id,
                        'quantity'   => $cart->qunt,
                        'price'      => $cart->price,
                        'sub_total'  => $cart->price * $cart->qunt,
                    ]);
                }
                // Delete the cart items
                Cart::where ("user_id",Auth::id ())->delete ();
            }
            return redirect ()->route ('index')->with ('success', 'Order placed successfully');
        }

        /**
         * Display the specified resource.
         */
        public function show (string $id) {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit (string $id) {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update (Request $request, string $id) {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy (string $id) {
            //
        }
    }
