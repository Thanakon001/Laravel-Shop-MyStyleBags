<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreRatingRequest $request)
    {
        try {
            Rating::create(
                [
                    'id' => auth()->id(),
                    'pro_bacode' => $request->pro_bacode,
                    'rating_point' => $request->rating_point,
                    'comment' => $request->comment,
                ]
            );
            Alert::success('ขอบคุณ', 'คุณได้ทำการให้คะแนนและแสดงความคิดเห็นเรียบร้อยแล้ว');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($request->all());
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
