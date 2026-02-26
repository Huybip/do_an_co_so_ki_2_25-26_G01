<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Bread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //show from checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Empty cart, cannot proceed to checkout.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    //process order (COD - Cash on Delivery)
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Empty cart, cannot place order.');
        }

        //cart total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        //create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_amount' => $total,
            'status' => 'pending',
            'note' => $request->note,
        ]);

        //create details order items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'bread_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            //update stock
            $bread = Bread::find($id);
            if ($bread) {
                $bread->stock -= $item['quantity'];
                $bread->save();
            }
        }

        //clear cart
        session()->forget('cart');

        return redirect()->route('order.success', $order->id)->with('success', 'Đặt hàng thành công!');
    }

    //show order success page
    public function success($id)
    {
        $order = Order::findOrFail($id);
        return view('order-success', compact('order'));
    }

    //History orders
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

        return view('order-history', compact('orders'));
    }

    //show details order
    public function detail($id)
    {
        $order = Order::with('orderItems.bread')->findOrFail($id);

        //Check viewing permission
        if (Auth::id() != $order->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        return view('order-detail', compact('order'));
    }
}
