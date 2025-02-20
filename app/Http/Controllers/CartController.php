<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        Session::get('cart', []);
        return view('pages.shop.shopcart', compact(['cart']));
    }

    public function addItem(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        $product = Product::findOrFail($id);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        } else {
            $cart[$id] = [
                "pro_bacode" => $product->pro_bacode,
                "pro_name" => $product->pro_name,
                "pro_price" => $product->pro_price,
                "list_quentity" => $request->list_quentity,
            ];
        }

        Session::put('cart', $cart);
        Alert::success('ตะกร้าสินค้า', 'เพิ่ม ' . $product->pro_name . ' ลงตะกร้าเสร็จเรียบร้อย');
        return to_route('shop.details', $id);
    }

    public function removeItem($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
            Alert::success('ตะกร้าสินค้า', 'ลบสินค้าออกจากตะกร้าเสร็จเรียบร้อย');
        } else {
            Alert::error('ตะกร้าสินค้า', 'ไม่พบสินค้าที่ต้องการลบ');
        }
        return back();
    }

    public function updateItem(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['list_quentity'] = $request->list_quentity;
            Session::put('cart', $cart);
            Alert::success('ตะกร้าสินค้า', 'อัปเดตจำนวนสินค้าเรียบร้อยแล้ว');
        } else {
            Alert::error('ตะกร้าสินค้า', 'ไม่พบสินค้าที่ต้องการอัปเดต');
        }

        return back();
    }

}
