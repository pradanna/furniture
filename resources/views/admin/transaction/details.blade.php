@extends('layouts.app', ['title' => 'Transaction - Admin'])

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
        <div class="container mx-auto px-6 py-8">

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-yellow-400 rounded-b-none rounded-t-lg p-3 px-5">
                    <p class="font-bold text-white text-xl">Informasi Pemesanan</p>
                </div>
                <div class="bg-yellow-400 rounded-b-none rounded-t-lg p-3 px-5">
                    <p class="font-bold text-white text-xl">Detail Pemesanan</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white rounded-t-none rounded-b-lg p-3 px-4">

                    <p>Kode Transaksi : <br> {{ $transaction->kode_trx }}</p>
                    <p>Nama : <br> {{ $transaction->name }}</p>
                    <p>Nomor HP : <br> {{ $transaction->phone }}</p>
                    <p>Alamat : <br> {{ $transaction->detail_lokasi }}</p>
                    <p>Total Pesanan : <br> {{ $transaction->total_item }} Item</p>
                </div>
                <div class="bg-white rounded-t-none rounded-b-lg p-3">
                    <div class="grid grid-cols-4 gap-4 p-2 px-3">

                        <div>
                            <p>Nama</p>
                        </div>
                        <div>
                            <p>Gambar</p>
                        </div>
                        <div>
                            <p>Harga</p>
                        </div>
                        <div>
                            <p>Total</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-4 p-2 px-3">
                        @foreach ($transaction->details as $data)

                            <div>
                                <p>{{ $data->product->name }}</p>
                            </div>
                            <div>
                                <img class="rounded-lg" src="{{ $data->product->image }}" width="100px">
                            </div>
                            <div>
                                <p>{{ moneyFormat($data->product->price) }}</p>
                            </div>
                            <div>
                                <p>{{ $data->total_item }}</p>
                            </div>

                        @endforeach
                        <div></div>
                        <div></div>
                        <div>
                            <p>Kode Unik</p>
                        </div>
                        <div>
                            <p>{{ moneyFormat($transaction->kode_unik) }}</p>
                        </div>
                        <div>
                            <p>Biaya ongkir</p>
                        </div>
                        <div>
                            <p>{{ moneyFormat($transaction->ongkir) }}</p>
                        </div>
                        <div>
                            <p>Total Belanja</p>
                        </div>
                        <div>
                            <p>{{ moneyFormat($transaction->total_harga + $transaction->kode_unik + $transaction->ongkir) }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 gap-4 mt-5">
                <div class="bg-green-700 rounded-b-none rounded-t-lg p-3 px-5">
                    <p class="font-bold text-white text-xl">Informasi Pembayaran</p>
                </div>
            </div>


            <div class="mx-4 sm:-mx-8 px-4 sm:px-8 overflow-x-auto">
                <div class="inline-block min-w-full shadow-sm rounded-t-none rounded-b-none overflow-hidden">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                            <tr class="bg-green-600 w-full">
                                <th class="px-16 py-2" style="width: 40%">
                                    <span class="text-white">Kode Payment</span>
                                </th>
                                <th class="px-16 py-2 text-left">
                                    <span class="text-white">Nama</span>
                                </th>
                                <th class="px-16 py-2 text-left">
                                    <span class="text-white">Bank</span>
                                </th>
                                <th class="px-16 py-2 text-left">
                                    <span class="text-white">Total Transfer</span>
                                </th>
                                <th class="px-16 py-2 text-left">
                                    <span class="text-white">Status</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">

                            <tr class="border bg-white">

                                <td class="px-5 py-2">
                                    {{ $transaction->kode_payment }}
                                </td>
                                <td class="px-16 py-2">
                                    {{ $transaction->name }}
                                </td>
                                <td class="px-16 py-2">
                                    {{ $transaction->bank }}
                                </td>
                                <td class="px-16 py-2">
                                    {{ moneyFormat($transaction->total_harga + $transaction->kode_unik + $transaction->ongkir) }}
                                </td>
                                <td class="px-16 py-2">
                                    {{ $transaction->status }}
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                @if ($transaction->status == 'Menunggu Pembayaran')
                    <a href="{{ route('transactionConfirm', $transaction->id) }}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Konfirmasi Pembayaran
                        </button>
                    </a>
                @endif
                @if ($transaction->status != 'BATAL')
                    <a href="{{ route('cetak_faktur', $transaction->id) }}">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Cetak Faktur
                        </button>
                    </a>
                @else

                @endif
            </div>

        </div>
    </main>

@endsection
