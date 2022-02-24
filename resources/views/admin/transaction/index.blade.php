@extends('layouts.app', ['title' => 'Transaction - Admin'])

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
        <div class="container mx-auto px-6 py-8">

            <div class="mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                            <tr class="bg-yellow-400 w-full">
                                {{-- <th class="px-16 py-2" style="width: 40%">
                                    <span class="text-white">Kode Invoice</span>
                                </th> --}}
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
                                <th class="px-16 py-2">
                                    <span class="text-white">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @forelse($listPending as $data)
                                <tr class="border bg-white">
                                    {{-- <td class="px-5 py-2">
                                        {{ $data->kode_payment }}
                                    </td> --}}
                                    <td class="px-16 py-2">
                                        {{ $data->name }}
                                    </td>
                                    <td class="px-16 py-2">
                                        {{ $data->bank }}
                                    </td>
                                    <td class="px-16 py-2">
                                        {{ moneyFormat($data->total_transfer + $data->kode_unik) }}
                                    </td>
                                    <td class="px-16 py-2">
                                        {{ $data->status }}
                                    </td>
                                    <td class="px-10 py-2 text-center">
                                        <a href="{{ route('transactionDetail', $data->id) }}">
                                            <button type="button" class="btn btn btn-danger btn-xs">Details</button>
                                        </a>
                                        /
                                        <a href="{{ route('transactionConfirm', $data->id) }}">
                                            <button type="button" class="btn btn btn-success btn-xs">Proses</button>
                                        </a>

                                    </td>
                                </tr>
                            @empty
                                <div class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md">
                                    Data Belum Tersedia!
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- @if ($listPending->hasPages())
                        <div class="bg-white p-3">
                            {{ $listPending->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif --}}
                </div>
            </div>
            <div class="mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                            <tr class="bg-green-600 w-full">
                                {{-- <th class="px-16 py-2" style="width: 40%">
                                    <span class="text-white">Kode Invoice</span>
                                </th> --}}
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
                                <th class="px-16 py-2">
                                    <span class="text-white">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @forelse($listDone as $data)
                                <tr class="border bg-white">

                                    {{-- <td class="px-5 py-2">
                                        {{ $data->kode_payment }}
                                    </td> --}}
                                    <td class="px-16 py-2">
                                        {{ $data->name }}
                                    </td>
                                    <td class="px-16 py-2">
                                        {{ $data->bank }}
                                    </td>
                                    <td class="px-16 py-2">
                                        {{ moneyFormat($data->total_transfer + $data->kode_unik) }}
                                    </td>
                                    <td class="px-16 py-2">
                                        {{ $data->status }}
                                    </td>
                                    <td class="px-10 py-2 text-center">
                                        @if ($data->status == 'DIKIRIM')
                                            <a href="{{ route('transactionDetail', $data->id) }}">
                                                <button type="button" class="btn btn btn-danger btn-xs">Details</button>
                                            </a>
                                            <a href="{{ route('transactionSelesai', $data->id) }}">
                                                <button type="button" class="btn btn-block btn-primary btn-xs">Selesai
                                                </button>
                                            </a>
                                        @elseif($data->status == "PROSES")
                                            <a href="{{ route('transactionDetail', $data->id) }}">
                                                <button type="button" class="btn btn btn-danger btn-xs">Details</button>
                                            </a>
                                            <a href="{{ route('transactionKirim', $data->id) }}">
                                                <button type="button" class="btn btn-block btn-success btn-xs">Kirim
                                                </button>
                                            </a>
                                        @elseif($data->status == "SELESAI" || $data->status == "BATAL")
                                            <a href="{{ route('transactionDetail', $data->id) }}">
                                                <button type="button" class="btn btn btn-danger btn-xs">Details</button>
                                            </a>
                                            <a href="#">
                                                <button type="button" class="btn btn-block btn-info btn-xs">Detail
                                                </button>
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <div class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md">
                                    Data Belum Tersedia!
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- @if ($listPending->hasPages())
                        <div class="bg-white p-3">
                            {{ $listPending->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </main>

@endsection
