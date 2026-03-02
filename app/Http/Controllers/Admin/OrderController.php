<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //List all orders
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    //Show order details
    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.bread'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    //Update order status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,shipping,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    //Show printable invoice
    public function invoice($id)
    {
        $order = Order::with(['user', 'orderItems.bread'])->findOrFail($id);
        return view('admin.orders.invoice', compact('order'));
    }
}
