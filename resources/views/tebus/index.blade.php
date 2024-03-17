@extends('layouts.app')

@section('title', 'Tebus Obat')

@section('header', 'Tebus Obat')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Tebus Obat Pasien</h4>
    </div>

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>No. Register</th>
                        <th>Nama Pasien</th>
                        <th>Tanggl Pemeriksaan</th>
                        <th>Diagnosis</th>
                        <th>Obat</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                    $total = 0
                    @endphp
                    @foreach ($tebusObats as $tebusObat)
                    @php
                    foreach ($tebusObat->pemeriksaan->reseps as $resep) {
                    $total += $resep->stokObat->harga_jual;
                    }
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tebusObat->pemeriksaan->pasien->no_register }}</td>
                        <td>{{ $tebusObat->pemeriksaan->pasien->biodata->nama_lengkap }}</td>
                        <td>{{ Carbon\Carbon::parse($tebusObat->pemeriksaan->created_at)->isoFormat('LLLL') }}</td>
                        <td>{{ $tebusObat->pemeriksaan->diagnosis }}</td>
                        <td>
                            @foreach ($tebusObat->pemeriksaan->reseps as $resep)
                            <span class="badge badge-primary mt-1">
                                {{ $resep->stokObat->obat->nama_obat }} | Qty: {{ $resep->jumlah }} | Harga: {{
                                $resep->stokObat->harga_jual }}
                            </span><br>
                            @endforeach
                        </td>
                        <td>{{ 'Rp. '. number_format($total) }}</td>
                        <td>
                            @if ($tebusObat->status_bayar == 'pending')
                            <form action="{{ route('tebus-obat.update', $tebusObat->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning shadow btn-xs" value="lunas"
                                    name="status_bayar">
                                    <i class="fa-solid fa-cash-register me-2"></i>Tebus</button>
                            </form>
                            @else
                            <span class="badge badge-success">Lunas</span>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection