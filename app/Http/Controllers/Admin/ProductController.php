<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\ProductUpdate;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->when(request()->q, function ($products) {
            $products = $products->where('name', 'like', '%' . request()->q . '%');
        })->paginate(20);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.product.create', compact('categories'));
    }
    public function downloadTemplate()
    {
        $filename = "produkTemplate.xlsx";
        $path = storage_path('app/public/excell/' . $filename);

        // Download file with custom headers
        return response()->download($path, $filename, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    public function import()
    {
        return view('admin.product.import');
    }
    public function import_update()
    {
        return view('admin.product.import_update');
    }
    public function import_file(Request $request)
    {
        set_time_limit(0);
        Excel::import(new ProductImport, $request->file('excel'));
        return redirect('admin/product');
    }
    public function imported(Request $request)
    {
        set_time_limit(0);
        Excel::import(new ProductImport, $request->file('excel'));
        return redirect('admin.product.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        // die();

        $this->validate($request, [
            'kodebrg' => 'required',
            'barcode'  => 'required',
            'kodeklmpk'  => 'required',
            'name'  => 'required',
            // 'slug'  => 'required',
            'price' => 'required|numeric',
            'stock'  => 'required',
            'weight'  => 'required',
            'description'  => 'required',
            'image'             => 'required|image|mimes:png,jpg,jpeg',
            'hgros1'  => 'required',
            'hgros2'  => 'required',
            'quantity1'  => 'required',
            'quantity2' => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        // $image->storeAs('public/product', $image->hashName());
        $image->move('/home/u7082880/public_html/awang/img/produk', $image->hashName() + "."+ $image->extension());

        $product = Product::create([
            'kodebrg' => $request->kodebrg,
            'barcode' => $request->barcode,
            'kodeklmpk' => $request->kodeklmpk,
            'name' => $request->name,
            'slug' => Str::slug($request->name, "-"),
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'description' => $request->description,
            // 'image',
            'hgros1' => $request->hgros1,
            'hgros2' => $request->hgros2,
            'quantity1' => $request->quantity1,
            'quantity2' => $request->quantity2,
            'image'             => $image->hashName(),
            // Tambahan
            'is_promo' => $request->is_promo,
            'discount' => $request->discount,
            'potongan_harga' => $request->potongan_harga,
            'd_price' => $request->d_price,
            'd_hgros1' => $request->d_hgros1,
            'd_hgros2' => $request->d_hgros2,
            'expired' => $request->expired
        ]);

        // dd($product);
        if ($product) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.product.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.product.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('admin.product.edit', compact('product', 'categories'));
        // return view('admin.campaign.edit', compact('campaign', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'kodebrg' => 'required',
            'barcode'  => 'required',
            'kodeklmpk'  => 'required',
            'name'  => 'required',
            // 'slug'  => 'required',
            'price' => 'required|numeric',
            'stock'  => 'required',
            'weight'  => 'required',
            'description'  => 'required',
            // 'image' ,
            'hgros1'  => 'required',
            'hgros2'  => 'required',
            'quantity1'  => 'required',
            'quantity2' => 'required'

        ]);

        //check jika image kosong
        if ($request->file('image') == "") {

            //update data tanpa image
            $product = Product::findOrFail($product->id);
            $product->update([
                'kodebrg' => $request->kodebrg,
                'barcode' => $request->barcode,
                'kodeklmpk' => $request->kodeklmpk,
                'kodedept' => $request->kodedept,
                'name' => $request->name,
                'slug' => Str::slug($request->name, "-"),
                'price' => $request->price,
                'weight' => $request->weight,
                'stock' => $request->stock,
                'description' => $request->description,
                'category' => $request->category,
                // 'image',
                'hgros1' => $request->hgros1,
                'hgros2' => $request->hgros2,
                'quantity1' => $request->quantity1,
                'quantity2' => $request->quantity2,
                // Tambahan
                'is_promo' => Str::lower($request->is_promo),
                'discount' => $request->discount,
                'potongan_harga' => $request->potongan_harga,
                'd_price' => $request->d_price,
                'd_hgros1' => $request->d_hgros1,
                'd_hgros2' => $request->d_hgros2,
                'expired' => $request->expired
            ]);
        } else {

            //hapus image lama
            Storage::disk('local')->delete('public/product/' . basename($product->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/product', $image->hashName());

            //update dengan image baru
            $product = Product::findOrFail($product->id);
            $product->update([
                'kodebrg' => $request->kodebrg,
                'barcode' => $request->barcode,
                'kodeklmpk' => $request->kodeklmpk,
                'kodedept' => $request->kodedept,
                'name' => $request->name,
                'slug' => Str::slug($request->name, "-"),
                'price' => $request->price,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'description' => $request->description,
                'category' => $request->category,
                // 'image',
                'hgros1' => $request->hgros1,
                'hgros2' => $request->hgros2,
                'quantity1' => $request->quantity1,
                'quantity2' => $request->quantity2,
                'image'             => $image->hashName(),
                // Tambahan
                'is_promo' => $request->is_promo,
                'discount' => $request->discount,
                'potongan_harga' => $request->potongan_harga,
                'd_price' => $request->d_price,
                'd_hgros1' => $request->d_hgros1,
                'd_hgros2' => $request->d_hgros2,
                'expired' => $request->expired

            ]);
        }

        if ($product) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.product.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.product.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::disk('local')->delete('public/product/' . basename($product->image));
        $product->delete();

        if ($product) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
