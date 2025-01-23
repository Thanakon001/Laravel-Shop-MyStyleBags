<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $orders = OrderList::with(['order', 'product'])->orderBy('created_at', 'desc')->paginate(25);
            $userTotal = User::count();
            $productTotal = Product::count();
            $orderToDay = OrderList::whereDate('created_at', Carbon::today())->count();
            return view('pages.home', compact([
                'orders',
                'userTotal',
                'productTotal',
                'orderToDay',
            ]));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function order()
    {
        try {
            $orders = Order::with(['orderList.product'])->where('order_status', 'Pending')->orderBy('created_at', 'desc')->get();
            return view('pages.order', compact('orders'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function ordersuccess()
    {
        try {
            $orders = Order::with(['orderList.product'])->where('order_status', 'Success')->orderBy('created_at', 'desc')->get();
            return view('pages.ordersuccess', compact('orders'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function ordercancel()
    {
        try {
            $orders = Order::with(['orderList.product'])->where('order_status', 'Cancel')->orderBy('created_at', 'desc')->get();
            return view('pages.ordercancel', compact('orders'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function product()
    {
        try {
            $products = Product::with('bands')->orderBy('created_at', "desc")->get();
            return view('pages.product', compact('products'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function cutomer()
    {
        try {
            $users = User::where('role', '!=', 'admin')->orderBy('id')->get();
            return view('pages.cutomer', compact('users'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function band()
    {
        try {
            $bands = Band::withCount('products')->orderBy('created_at', "desc")->get();
            return view('pages.band', compact('bands'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function profile()
    {
        try {
            $user = Auth::user();
            return view('pages.profile', compact('user'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function updateprofile(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);
            $user = User::find(Auth::user()->id);
            if ($request->hasFile('profile_image')) {
                $user->profile_image = file_get_contents($request->file('profile_image'));
            }

            if ($request->role) {
                $user->role = $request->role;
            }
            
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            Alert::success('แก้ไขข้อมูลสำเร็จ');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function cutomer_profile(Request $request, $id)
    {
        try {
            $user = User::where('email', $id)->first();
            return view('pages.cutomerprofile', compact('user'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    public function shopping()
    {
        try {
            return view('pages.shop.shopping');
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }
}
