<?php

namespace App\Http\Controllers;

use App\Mail\sendOrderMail;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderList;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(StoreOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $cart = Session::get('cart', []);
            foreach ($cart as $order_detail => $item) {
                $product = Product::findOrFail($item['pro_bacode']);
                if (!$product) {
                    Alert::error('เกิดข้อผิดพลาด', 'ไม่พบสินค้ารหัส ' . $item['pro_bacode']);
                    return redirect()->back();
                }

                if ($product->pro_stock < $item['list_quentity']) {
                    Alert::error('เกิดข้อผิดพลาด', 'จำนวนสินค้าไม่เพียงพอ ' . $product->pro_name.' จำนวนคงเหลือ '.$product->pro_stock);
                    return redirect()->back();
                }
            }

            $order = Order::create([
                "id" => auth()->user()->id,
                'order_name' => $request->order_name,
                'order_address' => $request->order_address,
                'order_phone' => $request->order_phone,
                'order_payment' => $request->order_payment,
                'order_status' => "Pending",
            ]);

            $totalAmount = 0;
            foreach ($cart as $order_detail => $item) {
                $price = $item['pro_price'] * $item['list_quentity'];
                OrderList::create([
                    "pro_bacode" => $item['pro_bacode'],
                    "list_quentity" => $item['list_quentity'],
                    "pro_price" => $item['pro_price'],
                    "list_total" => $price,
                    "order_id" => $order->order_id
                ]);

                $totalAmount += $price;
                $product = Product::findOrFail($item['pro_bacode']);
                $product->decrement('pro_stock', $item['list_quentity']);
            }

            $order->update(['order_total' => $totalAmount]);
            DB::commit();

            Mail::to(auth()->user()->email)->queue(new SendOrderMail($order));
            Alert::success('ยืนยันการชำระ', 'คำสั่งซื้อของท่านสำเร็จ');
            Session::forget('cart');
            return to_route('shop.cart');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function index_perpare($id)
    {
        try {
            $order = Order::with(['orderList'])->where('order_id', $id)->first();
            // dd($order);
            return view('pages.orderperpare', compact('order'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function store_perpare(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $request->validate(
                [
                    "order_status" => "required",
                    "order_details" => "required",
                ]
            );
            if ($request->order_status === "Success") {
                $request->validate(
                    [
                        "order_tracking" => "required",
                    ]
                );
            }

            $order = Order::findOrFail($id);
            $order->order_status = $request->order_status;
            $order->order_details = $request->order_details;
            $request->order_status === "Success" ? $order->order_tracking = $request->order_tracking : $order->order_tracking = "ไม่มี";
            $order->save();
            DB::commit();

            Alert::success('ทำรายการสำเร็จ', $id);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $request->validate(
                [
                    "order_status" => "required",
                    "order_id" => "required",
                ]
            );

            $order = Order::findOrFail($request->order_id);
            $order->order_status = $request->order_status;
            $order->save();

            Alert::success('ทำรายการสำเร็จ', $request->order_id . 'คำสั่งซื้อแก้ไขเรียบร้อย');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
