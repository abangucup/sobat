<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <style type="text/css">
        body {
            line-height: 1.5;
        }

        p {
            margin: 5px 0 0 0;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
            display: block;
        }

        .bold {
            font-weight: bold;
        }

        #footer {
            clear: both;
            position: relative;
            height: 40px;
            margin-top: -40px;
        }
    </style>
    <title>Laporan Rekap Keuangan</title>
</head>

<body style="font-size: 12px">
    <table width="100%">
        <tr>
            <td align="left">
                <img width="90px" src="assets/images/png/logo_kota.png" height="100px">
            </td>
            <td style="text-align: center" width="100%">
                <p style="font-size: 2em"><b>
                        {{ $user->distributor->nama_perusahaan }}
                </p>
                <p>
                    {{ $user->distributor->lokasi_perusahaan ?? '-' }}<br>
                    Telp : {{ $user->distributor->telepon_perusahaan ?? '-' }}
                </p>
            </td>
            <td align="right" width="100px">
                <p></p>
            </td>
        </tr>
    </table>

    <hr>

    <div style="font-size: 1em">
        <table>
            <tr>
                <td>Perihal </td>
                <td>: Laporan Rekapan Keuangan</td>
            </tr>
        </table>

        <br>
        <table border=1" cellspacing="0" cellpadding="5" width=100% style="text-align: center">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>PEMESAN</th>
                    <th>REAGEN/BHP/OBAT</th>
                    <th>NO. BATCH</th>
                    <th>SATUAN</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                    <th>PAJAK</th>
                    <th>JUMLAH</th>
                    <th>TANGGAL PESANAN</th>
                </tr>
            </thead>
            <tbody>

                @php
                $jumlah = 0;
                @endphp
                @foreach ($dataPesanans as $dataPesanan)
                @php
                $pajak = $dataPesanan->harga_pesanan * 0.11;
                $total = $pajak + $dataPesanan->harga_pesanan;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dataPesanan->pemesanan->user->biodata->nama_lengkap }}</td>
                    <td>{{ $dataPesanan->obat->nama_obat }}</td>
                    <td>{{ $dataPesanan->obat->no_batch }}</td>
                    <td>{{ $dataPesanan->obat->satuan. ' @ '.$dataPesanan->obat->kapasitas.' '.
                        $dataPesanan->obat->satuan_kapasitas }}</td>
                    <td>{{ $dataPesanan->jumlah }}</td>
                    <td>{{ 'Rp. '. number_format($dataPesanan->harga_pesanan, 0, ',', '.') }}</td>
                    <td>{{ 'Rp. '. number_format($pajak, 0, ',', '.') }}</td>
                    <td>{{ 'Rp. '. number_format($total, 0, ',', '.') }}</td>
                    <td>{{ Carbon\Carbon::parse($dataPesanan->created_at)->isoFormat('LL') }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <br>

        <p style="margin-left: 50px">Demikian laporan keuangan ini dicetak dan dapat digunakan dengan sebaik baiknya.
        </p>
        <br><br><br>
        <table width="100%">
            <tr>
                <td width="60%"></td>
                <td style="text-align: center" width="40%">
                    <div id="tanggal">
                        Gorontalo, {{ \Carbon\Carbon::parse(now())->isoFormat('LL') }}
                    </div>
                    <p>PETUGAS {{ $user->distributor->nama_perusahaan }}</p>
                    <br><br><br>
                    <p><u>{{ $user->biodata->nama_lengkap }}</u></p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>