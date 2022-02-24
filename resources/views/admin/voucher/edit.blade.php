@extends('layouts.app', ['title' => 'Update Voucher - Admin'])

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
        <div class="container mx-auto px-6 py-8">

            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-lg text-gray-700 font-semibold capitalize">Update Voucher</h2>
                <hr class="mt-4">
                <form action="{{ route('admin.voucher.update', $voucher->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6 mt-4">

                        <div>
                            <label class="text-gray-700" for="image">Gambar Iklaan</label>
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
                            <label class="text-gray-700" for="type">jenis iklan</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="type" value="{{ old('type', $voucher->type) }}">
                            @error('type')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700" for="min_order">kontrak</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="min_order" value="{{ old('min_order', $voucher->min_order) }}">
                            @error('min_order')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>


                        <div>
                            <label class="text-gray-700" for="expired">Expired</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="date"
                                name="expired" value="{{ old('expired', $voucher->expired) }}">
                            @error('expired')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror

                        </div>

                        <div>
                            <label class="text-gray-700" for="descriptions">Deskripsi</label>
                            <textarea name="descriptions"
                                rows="5">{{ old('descriptions', $voucher->descriptions) }}</textarea>
                            @error('descriptions')
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
                            class="px-4 py-2 bg-gray-600 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">SIMPAN</button>
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
