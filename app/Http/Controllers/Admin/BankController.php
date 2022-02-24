<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::latest()->when(request()->q, function ($banks) {
            $banks = $banks->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.bank.index', compact('banks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.create');
    }



    public function edit(Bank $bank)
    {
        return view('admin.bank.edit', compact('bank'));
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
            'image'             => 'required|image|mimes:png,jpg,jpeg',
            'name'              => 'required',
            'nomor_rekening' => 'required',
            'card_name' => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/bank', $image->hashName());
        $bank = Bank::create([
            'name'           => $request->name,
            'nomor_rekening'           => $request->nomor_rekening,
            'card_name'           => $request->card_name,
            'image'          => $image->hashName()
        ]);

        // dd($slide);
        if ($bank) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.bank.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.bank.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function update(Request $request, Bank $bank)
    {
        $this->validate($request, [
            'name'              => 'required',
            'nomor_rekening' => 'required',
            'card_name' => 'required'
        ]);

        //check jika image kosong
        if ($request->file('image') == "") {

            //update data tanpa image
            $bank = Bank::findOrFail($bank->id);
            $bank->update([
                'name'           => $request->name,
                'nomor_rekening'           => $request->nomor_rekening,
                'card_name'           => $request->card_name,
            ]);
        } else {

            //hapus image lama
            Storage::disk('local')->delete('public/bank/' . basename($bank->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/bank', $image->hashName());

            //update dengan image baru
            $bank = Bank::findOrFail($bank->id);
            $bank->update([
                'name'           => $request->name,
                'nomor_rekening' => $request->nomor_rekening,
                'card_name'      => $request->card_name,
                'image'          => $image->hashName()
            ]);
        }

        if ($bank) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.bank.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.bank.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $bank = Bank::findOrFail($id);
        Storage::disk('local')->delete('public/bank/' . basename($bank->image));
        $bank->delete();

        if ($bank) {
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
