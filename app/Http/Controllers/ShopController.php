<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
class ShopController extends Controller
{
    public function index()
    {
        $topProduct = Product::inRandomOrder()->take(3)->get();
        $newProduct = Product::orderBy('created_at', 'desc')->take(6)->get();
        return view('pages.shop.shopping', compact(['topProduct', 'newProduct']));
    }

    public function product()
    {
        $products = Product::with('bands')->orderBy('created_at', 'desc')->paginate(20);
        return view('pages.shop.shopproduct', compact('products'));
    }

    public function productsearch(Request $request)
    {
        $products = Product::with('bands')->
            where('pro_bacode', 'like', '%' . $request->textkeyword . '%')->
            orWhere('pro_name', 'like', '%' . $request->textkeyword . '%')->
            orWhere('band_id', 'like', '%' . $request->textkeyword . '%')->
            orderBy('created_at', 'desc')->paginate(20);
        return view('pages.shop.shopproduct', compact('products'));
    }

    public function details($id)
    {
        $product = Product::findOrFail($id);
        $ratings = $product->ratings()->orderBy('created_at', 'desc')->get();
        return view('pages.shop.shopdetails', compact(['product', 'ratings']));
    }

    public function about()
    {
        return view('pages.shop.shopabout');
    }

    public function contact()
    {
        return view('pages.shop.shopcontact');
    }

    public function cart()
    {
        // Session::forget('cart');
        $cart = Session::get('cart', []);
        return view('pages.shop.shopcart', compact(['cart']));
    }

    public function history()
    {
        $orders = Order::with(['orderList.product'])->where('id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('pages.shop.shophistory', compact('orders'));
    }

    public function payments()
    {
        $cart = Session::get('cart', []);
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['pro_price'] * $item['list_quentity'];
        }, $cart));
        return view('pages.shop.shoppayment', compact(['cart', 'totalPrice']));
    }

    public function orderstatus($id)
    {
        try {
            $order = Order::with('orderList.product')->where('id', Auth::user()->id)->where('order_id', $id)->first();
            return view('pages.shop.shoporder', compact('order'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('pages.shop.shopprofile', compact('user'));
    }
}
