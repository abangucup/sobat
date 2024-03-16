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
</head>

<body style="font-size: 12px">
    <table width="100%">
        <tr>
            <td align="left">
                <img width="90px" src="assets/images/png/logo_kota.png" height="100px">
            </td>
            <td style="text-align: center">
                <p style="font-size: 2em"><b>
                        PEMERINTAH KOTA GORONTALO <br>
                        RSUD OTANAHA
                </p>
                <p>
                    Jl. Rambutan No.412, Buladu, Kec. Kota Bar., Kabupaten Gorontalo, Gorontalo 96136<br>
                    Mail : otanahahospital@yahoo.com,
                    Laman <u> https://rsudotanaha.gorontalokota.go.id/</u>
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
                <td>: Laporan Pemakaian Obat</td>
            </tr>
        </table>

        <br>
        <table border=1" cellspacing="0" cellpadding="5" width=100%>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>REAGEN/BHP/OBAT</th>
                    <th>NO. BATCH</th>
                    <th>EXP. DATE</th>
                    <th>SATUAN</th>
                    <th>PENGGUNAAN</th>
                    <th>TANGGAL PAKAI</th>
                    <th>SISA STOK</th>
                    <th>LOKASI</th>
                    <th>CATATAN</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($pemakaians as $pemakaian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pemakaian->stokObat->obat->nama_obat }}</td>
                    <td>{{ $pemakaian->stokObat->obat->no_batch }}</td>
                    <td>{{ $pemakaian->stokObat->obat->tanggal_kedaluwarsa }}</td>
                    <td>{{ $pemakaian->stokObat->obat->satuan. ' @ '.$pemakaian->stokObat->obat->kapasitas.' '.
                        $pemakaian->stokObat->obat->satuan_kapasitas }}</td>
                    <td>{{ $pemakaian->banyak }}</td>
                    <td>{{ Carbon\Carbon::parse($pemakaian->tanggal_pemakaian)->isoFormat('LL') }}</td>
                    <td>{{ $pemakaian->stokObat->stok }}</td>
                    <td>{{ Str::upper($pemakaian->stokObat->lokasi) }}</td>
                    <td>{{ $pemakaian->catatan ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <br>

        <p style="margin-left: 50px">Demikian laporan pemakaian data obat ini dengan dapat digunakan dengan sebaik
            baiknya</p>
        <br><br><br>
        <table width="100%">
            <tr>
                <td style="text-align: center" width="40%">
                    <p>Mengetahui,</p>
                    <p>Direktur RSUD Otanaha</p>
                    <img src="assets/images/ttd_direktur.jpeg" alt="ttd direktur" width="100px">
                    <p><u>dr. Grace Tumewu</u></p>
                    <p>NIP. 19731004201012001</p>
                </td>
                <td width="20%"></td>
                <td style="text-align: center" width="40%">
                    <div id="tanggal">
                        Gorontalo, {{ \Carbon\Carbon::parse(now())->isoFormat('LL') }}
                    </div>
                    <p>PPK</p>
                    <img src="assets/images/ttd_ppk.jpeg" alt="ttd ppk" width="100px">
                    <p><u>Zikriana Adiwarsa Mahmud, S. Farm., Apt</u></p>
                    <p>NIP. 19940810 202012 2 003</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>