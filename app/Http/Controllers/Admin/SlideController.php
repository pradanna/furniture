<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::latest()->when(request()->q, function ($slide) {
            $slide = $slide->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.slide.index', compact('slide'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
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
            'image'             => 'required|image|mimes:png,jpg,jpeg',
            'name'              => 'required'
        ]);

        // //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/slide', $image->hashName());
        // // $newCode = 'BMW-' .  rand(100, 999);

        $fileName = '';
            if($request->image->getClientOriginalName()){
                $file = str_replace(' ', '', $request->image->getClientOriginalName());
                $fileName = date('mYdHs').rand(1,100).'_'.$file;
                $request->image->move('/home/u7082880/public_html/awang/img/slide', $fileName);
            }

        $slide = Slide::create([
            'name'           => $request->name,
            'image'          => $fileName
        ]);

        // dd($slide);
        if ($slide) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.slide.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.slide.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }



    public function edit(Slide $slide)
    {
        return view('admin.slide.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $this->validate($request, [
            'name'  => 'required'
        ]);

        //check jika image kosong
        if ($request->file('image') == "") {
            //update data tanpa image
            $slide = Slide::findOrFail($slide->id);
            $slide->update([
                'name' => $request->name
            ]);
        } else {

            //hapus image lama
            Storage::disk('local')->delete('public/slide/' . basename($slide->image));

            //upload image baru
            // $image = $request->file('image');
            // $image->storeAs('public/slide', $image->hashName());

            
            $fileName = '';
            if($request->image->getClientOriginalName()){
                $file = str_replace(' ', '', $request->image->getClientOriginalName());
                $fileName = date('mYdHs').rand(1,100).'_'.$file;
                $request->image->move('/home/u7082880/public_html/awang/img/produk', $fileName);
            }

            //update dengan image baru
            $slide = Slide::findOrFail($slide->id);
            $slide->update([
                'name'              => $request->name,
                'image'             => $fileName
            ]);
        }

        if ($slide) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.slide.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.slide.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $slide = Slide::findOrFail($id);
        Storage::disk('local')->delete('public/slide/' . basename($slide->image));
        $slide->delete();

        if ($slide) {
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
