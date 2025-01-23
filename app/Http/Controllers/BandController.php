<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Http\Requests\StoreBandRequest;
use App\Http\Requests\UpdateBandRequest;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (Cache::has('band')) {
                return Cache::get('band');
            }

            $band = Band::orderBy('band_id', 'desc')->get();
            return response()->json(
                [
                    "message" => "success",
                    "data" => $band
                ]
            );
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('pages.bandadd');
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBandRequest $request)
    {
        try {
            Band::create($request->all());
            Alert::success('เพิ่มข้อมูล', 'ทำรายการสำเร็จ');
            return redirect()->route('band');
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Band $band)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $band = Band::findOrFail($id);
            return view('pages.bandedit', compact('band'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBandRequest $request, $id)
    {
        try {
            $band = Band::findOrFail($id);
            $band->update($request->all());
            Alert::success('อัพเดต', 'ทำรายการสำเร็จ');
            return to_route('band');
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $band = Band::withCount('products')->findOrFail($id);
            if ($band->products_count <= 0) {
                $band->delete();
            } else {
                Alert::error('มีสินค้าที่ใช้งานอยู่', 'ไม่สามารถลบรายการได้ เนื่องจากมีสินค้าใช้งานอยู่ : ' . $band->products_count);
                return redirect()->back();
            }
            Alert::success('ลบรายการสำเร็จ', 'ลบรายการ รหัสสินค้า : ' . $id);
            return to_route('band');
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }
}
