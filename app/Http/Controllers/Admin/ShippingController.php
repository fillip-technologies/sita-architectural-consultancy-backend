<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ShippingMail;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShippingController extends Controller
{
    public function index()
    {
        $order = Order::all();
        return view('admin.shipping.create_shipping', compact('order'));
    }

  public function shipping_store(Request $request)
{
    $request->validate([
        'order_id' => 'required',
        'courier_name' => 'required',
        'tracking_number' => 'required',
        'shipped_at' => 'required|date',
        'delivered_at' => 'required|date',
        'status' => 'required'
    ]);

    $shipping = Shipping::create([
        'order_id' => $request->order_id,
        'courier_name' => $request->courier_name,
        'tracking_number' => $request->tracking_number,
        'shipped_at' => $request->shipped_at,
        'delivered_at' => $request->delivered_at,
        'status' => $request->status
    ]);

    if ($shipping) {
        $order = $shipping->order;
        $user  = $order->user;

        if ($user) {
            // Pass shipping directly to the mail
            Mail::to($user->email)->send(new ShippingMail($order, $user, $shipping));
        }

        return back()->with('success', 'Shipping Added Successfully :)');
    }

    return back()->with('error', 'Something went wrong !');
}


    public function Shipping_list()
    {
        $shipping_list = Shipping::with('order')->paginate(10);
        return view('admin.shipping.shipping_list', compact('shipping_list'));
    }

    public function shiping_edit($id)
    {
        $shippings = Shipping::with('order')->find($id);
        if (!$shippings) {
            return redirect()->back()->with('error', 'Shipping record not found!');
        }
        $editShip = Shipping::with('order')->get();
        return view('admin.shipping.edit_shipping', compact('shippings', 'editShip'));
    }

    public function update_shipping(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required',
            'courier_name' => 'required',
            'tracking_number' => 'required',
            'shipped_at' => 'required|date',
            'delivered_at' => 'required|date',
            'status' => 'required'
        ]);

        $shipping = Shipping::find($id);

        if (!$shipping) {
            return back()->with('error', 'Shipping record not found!');
        }

        $shipping->order_id       = $request->order_id;
        $shipping->courier_name   = $request->courier_name;
        $shipping->tracking_number = $request->tracking_number;
        $shipping->shipped_at     = $request->shipped_at;
        $shipping->delivered_at   = $request->delivered_at;
        $shipping->status         = $request->status;

        if ($shipping->save()) {
            return back()->with('success', 'Shipping updated successfully!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function shipping_delete($id)
    {
        Shipping::with('order')->findOrFail($id)->delete();
        return back()->with('delete', 'Shipping Deleted Successfully');
    }
}
