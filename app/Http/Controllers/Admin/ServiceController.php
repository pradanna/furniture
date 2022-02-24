<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::latest()->when(request()->q, function ($services) {
            $services = $services->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.service.index', compact('services'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            'name'      => 'required',
            'nomor_wa'  => 'required'
        ]);

        $service = Service::create([
            'name'           => $request->name,
            'nomor_wa'       => $request->nomor_wa
        ]);

        // dd($slide);
        if ($service) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.service.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.service.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }



    public function edit(Service $service)
    {
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $this->validate($request, [
            'name'  => 'required',
            'nomor_wa'  => 'required'
        ]);

        //update dengan image baru
        $service = Service::findOrFail($service->id);
        $service->update([
            'name'              => $request->name,
            'nomor_wa'              => $request->nomor_wa,
        ]);

        if ($service) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.service.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.service.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $service = Service::findOrFail($id);
        $service->delete();

        if ($service) {
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
