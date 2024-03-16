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

    <p style="font-size: 1.2em; text-align:center">
        @php
        $surat = $pemesanan->surats()->where('distributor_id', $distributor->id)->first() ?? '';
        @endphp
        <u>NOMOR : {{ $surat->nomor_surat }}
        </u>
    </p>

    <br>
    <div style="font-size: 1em">
        <table>
            <tr>
                <td>Perihal </td>
                <td>: Pemesanan Obat</td>
            </tr>
        </table>

        <p style="margin-left: 3px">Kepada Yth.</p>
        <span style="margin-left: 3px">{{ $distributor->nama_perusahaan }}</span>
        <p style="margin-left: 50px">Di~</p>
        <p style="margin-left: 80px">Tempat</p>
        <p style="margin-left: 50px">
            {{ $pemesanan->keterangan ?? 'Mohon dikirimkan permintaan dengan rincian sebagai berikut' }}
        </p>

        <br>
        <table border=1" cellspacing="0" cellpadding="5" width=100%>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA REAGEN/BHP/OBAT</th>
                    <th>JUMLAH</th>
                    <th>SATUAN</th>
                    <th>HARGA</th>
                    <th>JUMLAH</th>
                </tr>
            </thead>
            <tbody style="font-weight: bold">
                @php
                $total = 0;
                @endphp
                @foreach ($dataObat as $obat)
                @php
                $detailPesanan = $obat->detailPesanans->where('pemesanan_id', $pemesanan->id)->first();
                $total += $detailPesanan->harga_pesanan;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $obat->nama_obat }}</td>
                    <td style="text-align: center">{{ $detailPesanan->jumlah }}</td>
                    <td style="text-align: center">{{ $obat->satuan . ' @ ' . $obat->kapasitas . ' ' .
                        $obat->satuan_kapasitas}}</td>
                    <td>{{ 'Rp ' . number_format($obat->stokObats->where('lokasi',
                        'distributor')->first()->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ 'Rp ' . number_format($detailPesanan->harga_pesanan, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5" style="text-align: center">TOTAL</td>
                    <td>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: center">PPN 11%</td>
                    <td>{{ 'Rp ' . number_format($total * 0.11, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: center">TOTAL + PPN 11%</td>
                    <td>{{ 'Rp '. number_format(($total * 0.11) + $total, 0, ',', '.') }}</td>
                </tr>
            </tbody>

        </table>

        <br>

        <p style="margin-left: 50px">Demikian surat ini diajukan.</p>
        <br><br><br>
        <table width="100%">
            <tr>
                <td style="text-align: center" width="40%">
                    <p>Mengetahui,</p>
                    <p>Direktur RSUD Otanaha</p>
                    @if ($pemesanan->status_verif_direktur == 'diverifikasi')
                    <img src="assets/images/ttd_direktur.jpeg" alt="ttd direktur" width="100px">
                    @else
                    <br><br><br>
                    @endif
                    <p><u>dr. Grace Tumewu</u></p>
                    <p>NIP. 19731004201012001</p>
                </td>
                <td width="20%"></td>
                <td style="text-align: center" width="40%">
                    <div id="tanggal">
                        Gorontalo, {{ \Carbon\Carbon::parse($surat->created_at)->isoFormat('LL') }}
                    </div>
                    <p>PPK</p>
                    @if ($pemesanan->status_verif_ppk == 'diverifikasi')
                    <img src="assets/images/ttd_ppk.jpeg" alt="ttd ppk" width="100px">
                    @else
                    <br><br><br>
                    @endif
                    <p><u>Zikriana Adiwarsa Mahmud, S. Farm., Apt</u></p>
                    <p>NIP. 19940810 202012 2 003</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>