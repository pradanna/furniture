<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::latest()->when(request()->q, function ($vouchers) {
            $vouchers = $vouchers->where('min_order', 'like', '%' . request()->q . '%');
        })->paginate(20);
        return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'              => 'required|image|mimes:png,jpg,jpeg',
            'type'               => 'required',
            'min_order'          => 'required|numeric',
            'descriptions'       => 'required',
            'expired'            => 'required'

        ]);

        // //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/voucher', $image->hashName());

        $fileName = '';
        if($request->image->getClientOriginalName()){
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName = date('mYdHs').rand(1,100).'_'.$file;
            $request->image->move('/home/u7082880/public_html/awang/img/produk', $fileName);
        }

        $voucher = Voucher::create([

            'type'              => $request->type,
            'descriptions'      => $request->descriptions,
            'min_order'         => $request->min_order,
            'contact_centre'    => "62895346374614",
            'expired'           => $request->expired,
            'image'             => $fileName

        ]);

        // dd($product);
        if ($voucher) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.voucher.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.voucher.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        return view('admin.voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        $this->validate($request, [
            'type'              => 'required',
            'min_order'          => 'required|numeric',
            'descriptions'       => 'required',
            'expired'            => 'required'

        ]);

        //check jika image kosong
        if ($request->file('image') == "") {
            //update dengan image baru
            $voucher = Voucher::findOrFail($voucher->id);
            $voucher->update([
                'type'       => $request->type,
                'descriptions'    => $request->descriptions,
                'min_order'         => $request->min_order,
                'contact_centre'         => "62895346374614",
                'expired'          => $request->expired
            ]);
        } else {

            //hapus image lama
            Storage::disk('local')->delete('public/voucher/' . basename($voucher->image));

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/voucher', $image->hashName());

            $voucher = Voucher::findOrFail($voucher->id);
            $voucher->update([
                'type'       => $request->type,
                'descriptions'    => $request->descriptions,
                'min_order'         => $request->min_order,
                'image' => $image->hashName(),
                'contact_centre'         => "62895346374614",
                'expired'          => $request->expired
            ]);
        }




        // dd($product);
        if ($voucher) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.voucher.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.voucher.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        if ($voucher) {
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
