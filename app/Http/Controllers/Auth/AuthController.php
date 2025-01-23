<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SingInRequest;
use App\Http\Requests\SingUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }

    public function ban_user(Request $request, $id)
    {
        try {
            $user = User::where('email', $id)->first();
            $user->role = $request->role;
            $user->save();
            Alert::success('อัพเดต', 'ทำรายการสำเร็จ');
            return to_route('cutomer');
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }
}
