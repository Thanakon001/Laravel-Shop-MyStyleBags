<?php

namespace App\Http\Controllers;

use App\Http\Services\GoogleAuth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    protected $googleService;
    public function __construct(GoogleAuth $googleService)
    {
        $this->googleService = $googleService;
    }
    public function redirectToGoogle()
    {
        return $this->googleService->redirect();
    }

    public function handleGoogleCallback()
    {
        return $this->googleService->googleCallback();
    }
}
