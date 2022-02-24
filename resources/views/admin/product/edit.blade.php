@extends('layouts.app', ['title' => 'Edit Produk - Admin'])

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
        <div class="container mx-auto px-6 py-8">

            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-lg text-gray-700 font-semibold capitalize">Edit Produk</h2>
                <hr class="mt-4">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6 mt-4">
                        <div>
                            {{-- Image --}}
                            <label class="text-gray-700" for="image">Foto Produk</label>
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
                            <label class="text-gray-700" for="name">Nama</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="name" value="{{ old('name', $product->name) }}">
                            @error('name')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div>
                            {{-- Kode Produk --}}
                            <label class="text-gray-700" for="kodebrg">Kode Produk</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="kodebrg" value="{{ old('kodebrg', $product->kodebrg) }}">
                            @error('kodebrg')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div>
                            {{-- Barcode Produk --}}
                            <label class="text-gray-700" for="barcode">Barcode Produk</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="barcode" value="{{ old('barcode', $product->barcode) }}">
                            @error('barcode')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="text-gray-700" for="name">Kategori Produk</label>
                            <select class="w-full border bg-gray-200 focus:bg-white rounded px-3 py-2 outline-none"
                                name="kodeklmpk">
                                @foreach ($categories as $category)
                                    <option class="py-1" value="{{ $category->kodeklmpk }}" @if ($product->kodeklmpk == $category->kodeklmpk) selected @endif>{{ $category->namaklmpk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kodeklmpk')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            {{-- Price Produk --}}
                            <label class="text-gray-700" for="price">Harga Produk</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="price" id="price" value="{{ old('price', $product->price) }}">
                            @error('price')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div>
                            {{-- Price Produk --}}
                            <label class="text-gray-700" for="weight">Berat Produk</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="weight" id="weight" value="{{ old('weight', $product->weight) }}">
                            @error('weight')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div>
                            {{-- Stock Produk --}}
                            <label class="text-gray-700" for="stock">Stok Produk</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="stock" value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        {{-- <div>
                            Deskripsi Produk
                            <label class="text-gray-700" for="description">Deskripsi Produk</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="description" value="{{ old('description', $product->description) }}">
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div> --}}

                        <div>
                            <label class="text-gray-700" for="description">Deskripsi</label>
                            <textarea name="description"
                                rows="5">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            {{-- Harga Grosir 1 Produk --}}
                            <label class="text-gray-700" for="hgros1">Harga Grosir 1</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="hgros1" id="hgros1" value="{{ old('hgros1', $product->hgros1) }}">
                            @error('hgros1')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div>
                            {{-- Harga Grosir 2 Produk --}}
                            <label class="text-gray-700" for="hgros2">Harga Grosir 2</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="hgros2" id="hgros2" value="{{ old('hgros2', $product->hgros2) }}">
                            @error('hgros2')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div>
                            {{-- Quantity Produk --}}
                            <label class="text-gray-700" for="quantity1">Quantity</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="quantity1" id="quantity1" value="{{ old('quantity1', $product->quantity1) }}">
                            @error('quantity1')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div>
                            {{-- Quantity Produk --}}
                            <label class="text-gray-700" for="quantity2">Quantity</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="quantity2" id="quantity2" value="{{ old('quantity2', $product->quantity2) }}">
                            @error('quantity2')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="text-gray-700" for="is_promo">Promo Tidak? (YA/TIDAK)</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="is_promo" id="is_promo" value="{{ old('is_promo', $product->is_promo) }}">
                            @error('is_promo')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="text-gray-700" for="discount">Diskon</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="discount" id="discount" value="{{ old('discount', $product->discount) }}">
                            @error('discount')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="text-gray-700" for="potongan_harga">Potongan Harga</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="potongan_harga" id="potongan_harga"
                                value="{{ old('potongan_harga', $product->potongan_harga) }}">
                            @error('potongan_harga')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="text-gray-700" for="d_price">Promo Harga</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="d_price" id="d_price" value="{{ old('d_price', $product->d_price) }}">
                            @error('d_price')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="text-gray-700" for="d_hgros1">Promo Harga Grosir 1</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="d_hgros1" id="d_hgros1" value="{{ old('d_hgros1', $product->d_hgros1) }}">
                            @error('d_hgros1')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="text-gray-700" for="d_hgros2">Promo Harga Grosir 2</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                                name="d_hgros2" id="d_hgros2" value="{{ old('d_hgros2', $product->d_hgros2) }}">
                            @error('d_hgros2')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>


                        <div>
                            <label class="text-gray-700" for="expired">Expired Promo</label>
                            <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="date"
                                name="expired" value="{{ old('expired', $product->expired) }}">
                            @error('expired')
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
    <script type="text/javascript">
        $(document).on('change keyup mouseup', '#discount', function() {
            hitung_qard();
        })
        // $(document).on('keyup mouseup', '#potongan_harga', function() {
        //     hitung_promo();
        // })

        function hitung_qard() {
            var harga = $('#price').val();
            var diskon = $('#discount').val();
            var harga_promo = $('#d_price').val();
            var grosir_satu = $('#hgros1').val();
            var grosir_dua = $('#hgros2').val();
            if (diskon == 0) {
                $('#potongan_harga').val(0)
                $('#d_price').val(0)
                $('#d_hgros1').val(0)
                $('#d_hgros2').val(0)
            } else {
                // var diskond = (harga_promo / harga) * 100
                var hargad = (diskon / 100) * harga;
                console.log(hargad)
                var harga_promo = harga - hargad;
                console.log(harga_promo)
                var pot_promo = harga - harga_promo;
                console.log(pot_promo)
                var hggross = (diskon / 100) * grosir_satu;
                var harga_promo_grosirs = grosir_satu - hggross;
                var hggrossd = (diskon / 100) * grosir_dua;
                var harga_promo_grosird = grosir_dua - hggrossd;
                // $('#diskon').val(diskond)
                $('#potongan_harga').val(pot_promo)
                $('#d_price').val(harga_promo)
                $('#d_hgros1').val(harga_promo_grosirs)
                $('#d_hgros2').val(harga_promo_grosird)
            }

        }

        function hitung_promo() {
            var harga = $('#price').val();
            var pot_harga = $('#potongan_harga').val();
            var grosir_satu = $('#hgros1').val();
            var grosir_dua = $('#hgros2').val();
            if (pot_harga == 0) {
                $('#discount').val(0)
                $('#d_price').val(0)
                $('#d_hgros1').val(0)
                $('#d_hgros2').val(0)
            } else {
                var diskond = Math.floor((pot_harga / harga) * 100);
                $('#discount').val(diskond)
                var hargad = (diskond / 100) * harga;
                var harga_promo = harga - hargad;
                var hggross = (diskond / 100) * grosir_satu;
                var harga_promo_grosirs = grosir_satu - hggross;
                var hggrossd = (diskond / 100) * grosir_dua;
                var harga_promo_grosird = grosir_dua - hggrossd;
                // $('#harga_promo').val(harga_promo)
                $('#d_price').val(harga_promo)
                $('#d_hgros1').val(harga_promo_grosirs)
                $('#d_hgros2').val(harga_promo_grosird)
            }

        }
    </script>
@endsection
