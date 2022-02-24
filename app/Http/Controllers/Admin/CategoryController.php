<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Imports\CategoryImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->when(request()->q, function ($categories) {
            $categories = $categories->where('namaklmpk', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.category.index', compact('categories'));
    }


    public function import_category()
    {
        return view('admin.category.import');
    }
    public function import_file_category(Request $request)
    {
        Excel::import(new CategoryImport, $request->file('excel'));
        return redirect()->back();
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'kodeklmpk'  => 'required',
            'kodedept'  => 'required',
        ]);

        //check jika image kosong
        if ($request->file('image') == "") {

            //update data tanpa image
            $category = Category::findOrFail($category->id);
            $category->update([
                'kodeklmpk' => $request->kodeklmpk,
                'kodedept' => $request->kodedept,
                'namaklmpk' => $request->namaklmpk,
            ]);
        } else {

            //hapus image lama
            Storage::disk('local')->delete('public/category/' . basename($category->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/category', $image->hashName());

            //update dengan image baru
            $category = category::findOrFail($category->id);
            $category->update([
                'kodeklmpk' => $request->kodeklmpk,
                'kodedept' => $request->kodedept,
                'namaklmpk' => $request->namaklmpk,
                'image'             => $image->hashName()
            ]);
        }

        if ($category) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'kodeklmpk'  => 'required',
            'kodedept'  => 'required',
            'name'  => 'required',
            'image'   => 'required|image|mimes:png,jpg,jpeg',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/category', $image->hashName());
        $category = Category::create([
            'kodeklmpk'           => $request->kodeklmpk,
            'kodedept'           => $request->kodedept,
            'namaklmpk'           => $request->name,
            'image'          => $image->hashName()
        ]);

        if ($category) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $category = Category::findOrFail($id);
        Storage::disk('local')->delete('public/category/' . basename($category->image));
        $category->delete();

        if ($category) {
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
