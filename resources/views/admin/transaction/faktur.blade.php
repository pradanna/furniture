<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Invoice-Faktur-{{ Str::slug($transaction->name, '-') }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid rgb(214, 214, 214);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 12px;
            line-height: 16px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }


        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

    </style>
</head>

<body>
    <div class="invoice-box">
        <table style="border-collapse:collapse;border:none;">
            <tbody>
                <tr>

                    <td style="width: auto;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            <strong><span style="font-size:27px;">INVOICE PEMBELIAN</span></strong>
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            Nomor Faktur : {{ $transaction->kode_trx }}</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            Di Buat Tanggal : {{ $transaction->created_at }}</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            &nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td style="width: auto;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            <strong><span style="font-size:16px;">Pengirim</span></strong>
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Ry furniture</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Jln.Raya Ngambon</p>
                    </td>
                    <td style="width: auto;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            <strong><span style="font-size:16px;">Penerima</span></strong>
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            {{ $transaction->name }}</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            {{ $transaction->detai_lokasi }}</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            {{ $transaction->phone }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri","sans-serif";'>
            &nbsp;</p>
        <table style="border-collapse:collapse;border:none;">
            <tbody>
                <tr>
                    <td style="width: auto;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Metode Pembayaran</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            @if ($transaction->bank == 'COD')
                                Cash on Delivery (COD)
                            @else
                                Transfer {{ $transaction->bank }}
                            @endif
                        </p>
                    </td>
                    <td
                        style="width: auto;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            Nominal</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:right;'>
                            {{ moneyFormat($transaction->total_transfer + $transaction->kode_unik) }}
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri","sans-serif";'>
            &nbsp;</p>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri","sans-serif";'>
            Detail Pemesanan Produk</p>
        <table style="border-collapse:collapse;border:none;">
            <tbody>
                <tr>
                    <td style="width: auto;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            No</p>
                    </td>
                    <td
                        style="width: auto;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Kode Produk</p>
                    </td>
                    <td
                        style="width: auto;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Nama Produk</p>
                    </td>
                    <td
                        style="width: auto;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Qty</p>
                    </td>
                    <td
                        style="width: auto;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Harga</p>
                    </td>
                    <td
                        style="width: auto;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Total</p>
                    </td>
                </tr>
                {{ $i = 1 }}
                @foreach ($transaction->details as $data)
                    <tr>
                        <td
                            style="width: auto;border-color: currentcolor windowtext windowtext;border-style: none solid solid;border-width: medium 1pt 1pt;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                                {{ $i++ }}</p>
                        </td>
                        <td
                            style="width: auto;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                                {{ $data->product->kodebrg }}</p>
                        </td>
                        <td
                            style="width: auto;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                                {{ $data->product->name }}</p>
                        </td>
                        <td
                            style="width: auto;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                                {{ $data->total_item }}</p>
                        </td>
                        <td
                            style="width: auto;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                                @if ($data->product->is_promo == 'ya')
                                    @if ($data->total_item < 3)
                                        {{ moneyFormat($data->product->d_price) }}
                                    @elseif ($data->total_item >= 3 && $data->total_item <=5)
                                        {{ moneyFormat($data->product->d_hgros1) }} @elseif ($data->total_item >=
                                            6)
                                            {{ moneyFormat($data->product->d_hgros2) }}
                                    @endif
                                @else
                                    @if ($data->total_item < 3)
                                        {{ moneyFormat($data->product->price) }}
                                    @elseif ($data->total_item >= 3 && $data->total_item <=5)
                                        {{ moneyFormat($data->product->hgros1) }} @elseif ($data->total_item >=
                                            6)
                                            {{ moneyFormat($data->product->hgros2) }}
                                    @endif
                                @endif
                            </p>
                        </td>
                        <td
                            style="width: auto;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                                {{ moneyFormat($data->total_harga) }}</p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri","sans-serif";'>
            &nbsp;</p>
        <table style="border-collapse:collapse;border:none;">
            <tbody>
                <tr>
                    <td style="width: auto;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Sub Total</p>
                    </td>
                    <td
                        style="width: auto;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            {{ moneyFormat($transaction->total_harga) }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width: auto;border-color: currentcolor windowtext windowtext;border-style: none solid solid;border-width: medium 1pt 1pt;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Biaya Ongkir</p>
                    </td>
                    <td
                        style="width: auto;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            {{ moneyFormat($transaction->ongkir) }}</p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width: auto;border-color: currentcolor windowtext windowtext;border-style: none solid solid;border-width: medium 1pt 1pt;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Kode Unik</p>
                    </td>
                    <td
                        style="width: auto;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            {{ moneyFormat($transaction->kode_unik) }}</p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width: auto;border-color: currentcolor windowtext windowtext;border-style: none solid solid;border-width: medium 1pt 1pt;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            <strong><span style="font-size:24px;">Total Pembayaran</span></strong>
                        </p>
                    </td>
                    <td
                        style="width: auto;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            <strong><span
                                    style="font-size:24px;">{{ moneyFormat($transaction->total_transfer + $transaction->kode_unik) }}</span></strong>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri","sans-serif";'>
            &nbsp;</p>
        <table style="border-collapse:collapse;border:none;">
            <tbody>
                <tr>
                    <td style="width: auto;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            <strong>Catatan</strong>
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Barang telah di terima dengan baik dan cukup.</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Pembayaran dengan cek-giro dianggap Lunas setelah dapat di cairkan.</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Faktur asli merupakan bukti sah penagihan pelunasan.</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri","sans-serif";'>
            &nbsp;</p>
        <table style="border-collapse:collapse;border:none;">
            <tbody>
                <tr>
                    <td style="width: auto;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Cap dan &nbsp;Tanda Tangan</p>
                    </td>
                    <td
                        style="width: 155.85pt;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &nbsp;</p>
                    </td>
                    <td
                        style="width: 155.85pt;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width: auto;border-color: currentcolor windowtext windowtext;border-style: none solid solid;border-width: medium 1pt 1pt;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &nbsp;</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &nbsp;</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Toko/Pembeli</p>
                    </td>
                    <td
                        style="width: 155.85pt;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &nbsp;</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &nbsp;</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Otorisasi</p>
                    </td>
                    <td
                        style="width: 155.85pt;border-color: currentcolor windowtext windowtext currentcolor;border-style: none solid solid none;border-width: medium 1pt 1pt medium;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &nbsp;</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &nbsp;</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Pengiriman</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri","sans-serif";'>
            &nbsp;</p>
        <table style="border-collapse:collapse;border:none;">
            <tbody>
                <tr>
                    <td style="width: 467.5pt;padding: 0cm 5.4pt;vertical-align: top;">
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";text-align:center;'>
                            -------------------------------&ldquo;Ayo belanja di Ry furniture
                            &rdquo;-------------------------------</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri","sans-serif";'>
            &nbsp;</p>
        <table style="border-collapse:collapse;border:none;">
            <tbody>
                <tr>
                    <td style="width: auto;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">

                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            <strong><span style="font-size:16px;">Pengirim</span></strong>
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            <strong><span style="font-size:19px;">Ry furnitur</span></strong>
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            Jln. Raya Ngambon Purwosari Depan Kantor Kecamatan Ngambon</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            0895320432343</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            62167</p>
                    </td>
                    <td
                        style="width: auto;border-color: windowtext windowtext windowtext currentcolor;border-style: solid solid solid none;border-width: 1pt 1pt 1pt medium;border-image: none 100% / 1 / 0 stretch;padding: 0cm 5.4pt;vertical-align: top;">

                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            <strong><span style="font-size:16px;">Penerima</span></strong>
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            <strong><span style="font-size:19px;">{{ $transaction->name }}</span></strong>
                        </p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            {{ $transaction->detail_lokasi }}</p>
                        <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            {{ $transaction->users->phone }}</p>
                        {{-- <p
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;line-height:  normal;font-size:15px;font-family:"Calibri","sans-serif";'>
                            {{ $transaction->users->phone }}</p> --}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
