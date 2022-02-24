@extends('layouts.app', ['title' => 'Edit Kategori - Admin'])

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
        <div class="container mx-auto px-6 py-8">

            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-lg text-gray-700 font-semibold capitalize">Edit Kategori</h2>
                <hr class="mt-4">
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6 mt-4">
                        <div>
                            {{-- Image --}}
                            <label class="text-gray-700" for="image">Icon</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white p-3" type="file"
                                name="image">
                            @error('image')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            {{-- NamaProduk --}}
                            <label class="text-gray-700" for="namaklmpk">Nama Kategori</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="namaklmpk" value="{{ old('namaklmpk', $category->namaklmpk) }}">
                            @error('namaklmpk')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            {{-- Kode Kelompok Produk --}}
                            <label class="text-gray-700" for="kodeklmpk">Kode Kelompok Produk</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="kodeklmpk" value="{{ old('kodeklmpk', $category->kodeklmpk) }}">
                            @error('kodeklmpk')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div>
                            {{-- Kode Dept Produk --}}
                            <label class="text-gray-700" for="kodedept">Kode Dept Produk</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="kodedept" value="{{ old('kodedept', $category->kodedept) }}">
                            @error('kodedept')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>





                    </div>

                    <div class="flex justify-start mt-4">
                        <button type="submit"
                            class="px-4 py-2 bg-gray-600 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.0/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>
@endsection
