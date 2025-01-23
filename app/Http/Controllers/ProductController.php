<?php

namespace App\Http\Controllers;
use Faker\Factory as Faker;
use App\Models\Band;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (Cache::has('product')) {
                return Cache::get('product');
            }

            $products = Product::with('bands')->orderBy("pro_bacode", "desc")->paginate(30);
            Cache::put("product", $products);
            return response()->json([
                "data" => $products
            ]);
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "message" => "error",
                    "log" => $th->getMessage()
                ]
            );
        }
    }

    public function create()
    {
        try {
            $bands = Band::orderBy('band_id')->get();
            return view('pages.productadd', compact('bands'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $faker = Faker::create();

            $proBacode = $request->pro_bacode;

            if (empty($proBacode)) {
                do {
                    $proBacode = 'PRO' . $faker->unique()->numerify('#####');
                } while (Product::where('pro_bacode', $proBacode)->exists());
            }

            if ($request->hasFile('pro_image')) {
                $binary = file_get_contents($request->file('pro_image')->getRealPath());
                Product::create([
                    "pro_bacode" => $proBacode,
                    "pro_name" => $request->pro_name,
                    "band_id" => $request->band_id,
                    "pro_details" => $request->pro_details,
                    "pro_price" => $request->pro_price,
                    "pro_stock" => $request->pro_stock,
                    "pro_image" => $binary
                ]);
            } else {
                Product::create([
                    "pro_bacode" => $proBacode,
                    "pro_name" => $request->pro_name,
                    "band_id" => $request->band_id,
                    "pro_details" => $request->pro_details,
                    "pro_price" => $request->pro_price,
                    "pro_stock" => $request->pro_stock,
                    "pro_image" => file_get_contents(storage_path('app/public/png.png'))
                ]);
            }
            Alert::success('เพิ่มข้อมูล', 'ทำรายการสำเร็จ');
            return redirect()->route('product');
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            return response()->json(["data" => Product::find($id)->toArray()]);
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "message" => "error",
                    "log" => $th->getMessage()
                ]
            );
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            $bands = Band::orderBy('band_id')->get();
            return view('pages.productedit', compact('product', 'bands'));
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($request->hasFile('pro_image')) {
                $binary = file_get_contents($request->file('pro_image')->getRealPath());
                $product->update([
                    "pro_name" => $request->pro_name,
                    "band_id" => $request->band_id,
                    "pro_details" => $request->pro_details,
                    "pro_price" => $request->pro_price,
                    "pro_stock" => $request->pro_stock,
                    "pro_image" => $binary
                ]);
            } else {
                $product->update([
                    "pro_name" => $request->pro_name,
                    "band_id" => $request->band_id,
                    "pro_details" => $request->pro_details,
                    "pro_price" => $request->pro_price,
                    "pro_stock" => $request->pro_stock,
                ]);
            }
            Alert::success('อัพเดต', 'ทำรายการสำเร็จ');
            return redirect()->route('product');
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
            $product = Product::findOrFail($id);
            $product->delete();
            Alert::success('ลบรายการสำเร็จ', 'ลบรายการ รหัสสินค้า : ' . $id);
            return to_route('product');
        } catch (\Throwable $th) {
            Alert::error('เกิดข้อผิดพลาด', $th->getMessage());
            return redirect()->back();
        }
    }
}
