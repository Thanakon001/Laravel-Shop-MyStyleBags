<?php
namespace App\Http\Services;

use App\Models\User;
use GuzzleHttp\Client;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuth
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $avatarUrl = $googleUser->avatar;

            $client = new Client();
            $response = $client->get($avatarUrl);
            $imageContent = $response->getBody()->getContents();

            $user = User::firstOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(16)),
                'google_id' => $googleUser->getId(),
                'profile_image' => $imageContent,
            ]);

            auth()->login($user);

            return to_route('home');
        } catch (\Throwable $th) {
            return to_route('login')->with('error', 'เกิดข้อผิดพลาดในการเข้าสู่ระบบ');
        }
    }
}