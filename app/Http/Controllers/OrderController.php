<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Bread;
use App\Models\PromoCode;
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
            'promo_code' => 'nullable|string',
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

        //Check and apply promo code
        $promoCode = null;
        $discountAmount = 0;

        if ($request->promo_code) {
            $promoCode = PromoCode::where('code', strtoupper($request->promo_code))->first();

            if (!$promoCode) {
                return redirect()->back()->with('error', 'Mã giảm giá không tồn tại!');
            }

            if (!$promoCode->isValid()) {
                return redirect()->back()->with('error', 'Mã giảm giá không còn hợp lệ hoặc đã hết lượt sử dụng!');
            }

            $discountAmount = $promoCode->calculateDiscount($total);
            $total = max(0, $total - $discountAmount); // Final amount after discount
        }

        //create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_amount' => $total,
            'discount_amount' => $discountAmount,
            'promo_code_id' => $promoCode?->id,
            'status' => 'pending',
            'note' => $request->note,
        ]);

        //Update promo code usage
        if ($promoCode) {
            $promoCode->increment('used_count');
        }

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

    // API: Kiểm tra mã giảm giá
    public function validatePromoCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'total' => 'required|numeric|min:0',
        ]);

        $promoCode = PromoCode::where('code', strtoupper($request->code))->first();

        if (!$promoCode) {
            return response()->json([
                'valid' => false,
                'message' => 'Mã giảm giá không tồn tại!',
            ], 404);
        }

        if (!$promoCode->isValid()) {
            return response()->json([
                'valid' => false,
                'message' => 'Mã giảm giá không còn hợp lệ hoặc đã hết lượt sử dụng!',
            ], 400);
        }

        $discountAmount = $promoCode->calculateDiscount($request->total);
        $finalTotal = max(0, $request->total - $discountAmount);

        return response()->json([
            'valid' => true,
            'message' => 'Áp dụng thành công!',
            'discount_amount' => round($discountAmount, 2),
            'discount_type' => $promoCode->discount_type,
            'discount_value' => $promoCode->discount_value,
            'final_total' => round($finalTotal, 2),
            'description' => $promoCode->description,
        ]);
    }
}
