<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ route('dashboard') }}">
                    <i class="fa fa-solid fa-house"></i> Dashboard
                </a>
            </li>

            {{-- MENU UNTUK GUDANG --}}
            @if (auth()->user()->role == 'gudang')
            {{--
            =================================================================================================================================================================
            --}}
            <li><a href="{{ route('distributor.index') }}">
                    <i class="fa-solid fa-boxes-packing"></i> Distributor
                </a>
            </li>
            <li><a href="{{ route('obat.index') }}">
                    <i class="fa-solid fa-pills"></i> Obat
                </a>
            </li>
            <li><a href="{{ route('expired.index') }}"
                    class="{{ Request::is('expired/*') ? 'bgl-primary rounded' : '' }}">
                    <i class="fa-solid fa-pills"></i> Obat Expired
                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="fa-solid fa-truck-medical"></i> Pemesanan Obat
                </a>
                <ul aria-expanded="false" class="mm-collapse">
                    <li><a href="{{ route('pemesanan.create') }}"
                            class="{{ Request::is('pemesanan/create') ? 'bgl-primary rounded' : '' }}">Buat
                            Pesanan</a>
                    </li>
                    <li class="mm-{{ Request::is('pemesanan/*') ? 'active' : '' }}">
                        <a href="{{ route('pemesanan.index') }}"
                            class="{{ Request::is('pemesanan') || Request::is('pemesanan/detail-pesanan/*')  ? 'bgl-primary rounded' : '' }}">Daftar
                            Pemesanan</a>
                    </li>
                    <li><a href="{{ route('pemesanan.proses') }}"
                            class="{{ Request::is('pemesanan/status-proses') || Request::is('pemesanan/status-proses/*') ? 'bgl-primary rounded' : '' }}">Pesanan
                            Diproses</a></li>
                    <li><a href="{{ route('pemesanan.selesai') }}"
                            class="{{ Request::is('pemesanan/status-selesai') || Request::is('pemesanan/status-selesai/*') ? 'bgl-primary rounded' : '' }}">Pesanan
                            Selesai</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="fa-solid fa-book-medical"></i> Permintaan Obat
                </a>
                <ul aria-expanded="false" class="mm-collapse">
                    <li><a href="{{ route('permintaan.tunda') }}"
                            class="{{ Request::is('permintaan/status/tunda') ? 'bgl-primary rounded' : '' }}">Menunggu
                            Persetujuan</a></li>
                    <li><a href="{{ route('permintaan.setuju') }}"
                            class="{{ Request::is('permintaan/status/setuju') ? 'bgl-primary rounded' : '' }}">Disetujui</a>
                    </li>
                </ul>
            </li>
            <li><a href="{{ route('laporan.pemakaian') }}">
                    <i class="fa-solid fa-file-contract"></i> Laporan Pakai Obat
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="fa-solid fa-users"></i> Data User
                </a>
            </li>
            {{--
            =================================================================================================================================================================
            --}}

            {{-- MENU UNTUK DISTRIBUTOR --}}
            @elseif (auth()->user()->role == 'distributor')
            {{--
            =================================================================================================================================================================
            --}}
            <li><a href="{{ route('obat.index') }}">
                    <i class="fa-solid fa-pills"></i> Obat
                </a>
            </li>
            <li><a href="{{ route('pemesanan.daftar-pesanan') }}">
                    <i class="fa-solid fa-truck-medical"></i> Daftar Pesanan
                </a>
            </li>
            <li><a href="{{ route('expired.index') }}"
                    class="{{ Request::is('expired/*') ? 'bgl-primary rounded' : '' }}">
                    <i class="fa-solid fa-pills"></i> Data Pengembalian
                </a>
            </li>
            <li><a href="{{ route('keuangan.distributor') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i> Rekapan Keuangan
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="fa-solid fa-users"></i> Data User
                </a>
            </li>
            {{--
            =================================================================================================================================================================
            --}}


            {{-- MENU UNTUK PPK --}}
            @elseif (auth()->user()->role == 'ppk')
            {{--
            =================================================================================================================================================================
            --}}
            <li><a href="{{ route('pemesanan.proses') }}"
                    class="{{ Request::is('pemesanan/*') ? 'bgl-primary rounded' : '' }}">
                    <i class=" fa-solid fa-pills"></i> Verifikasi Pesanan
                </a>
            </li>
            <li><a href="{{ route('laporan.keuangan') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i> Rekapan Keuangan
                </a>
            </li>
            {{--
            =================================================================================================================================================================
            --}}

            {{-- MENU UNTUK DIREKTUR --}}
            @elseif (auth()->user()->role == 'direktur')
            {{--
            =================================================================================================================================================================
            --}}
            <li><a href="{{ route('pemesanan.proses') }}"
                    class="{{ Request::is('pemesanan/*') ? 'bgl-primary rounded' : '' }}">
                    <i class="fa-solid fa-pills"></i> Verifikasi Pesanan
                </a>
            </li>
            <li><a href="{{ route('laporan.pemakaian') }}">
                    <i class="fa-solid fa-file-contract"></i> Laporan Kelola Obat
                </a>
            </li>
            {{--
            =================================================================================================================================================================
            --}}

            {{-- MENU UNTUK DEPO --}}
            @elseif (auth()->user()->role == 'depo')
            {{--
            =================================================================================================================================================================
            --}}
            <li><a href="{{ route('obat.index') }}">
                    <i class="fa-solid fa-pills"></i> Obat
                </a>
            </li>
            <li><a href="{{ route('permintaan.index') }}">
                    <i class="fa-solid fa-arrow-right-arrow-left"></i> Permintaan
                </a>
            </li>
            <li><a href="{{ route('pemakaian.index') }}">
                    <i class="fa-solid fa-file-pen"></i> Pemakian
                </a>
            </li>
            <li><a href="{{ route('laporan.pemakaian') }}">
                    <i class="fa-solid fa-file-contract"></i> Laporan Obat Terpakai
                </a>
            </li>
            {{--
            =================================================================================================================================================================
            --}}

            {{-- MENU UNTUK PELAYANAN --}}
            @elseif (auth()->user()->role == 'pelayanan')
            {{--
            =================================================================================================================================================================
            --}}
            <li><a href="{{ route('obat.index') }}">
                    <i class="fa-solid fa-pills"></i> Obat
                </a>
            </li>
            <li><a href="{{ route('permintaan.index') }}">
                    <i class="fa-solid fa-arrow-right-arrow-left"></i> Permintaan
                </a>
            </li>
            <li><a href="{{ route('tebus-obat.index') }}">
                    <i class="fa-solid fa-hand-holding-dollar"></i> Tebus Obat
                </a>
            </li>
            <li><a href="{{ route('laporan.obatKeluar') }}">
                    <i class="fa-solid fa-file-contract"></i> Laporan Obat Keluar
                </a>
            </li>
            {{--
            =================================================================================================================================================================
            --}}

            {{-- MENU UNTUK POLI --}}
            @elseif (auth()->user()->role == 'poli')
            {{--
            =================================================================================================================================================================
            --}}
            <li><a href="{{ route('pasien.index') }}">
                    <i class="fa-solid fa-arrow-right-arrow-left"></i> Pasien
                </a>
            </li>
            <li><a href="{{ route('pemeriksaan.index') }}"
                    class="{{ Request::is('pemeriksaan/*') ? 'bgl-primary rounded' : '' }}">
                    <i class="fa-solid fa-file-pen"></i> Pemeriksaan
                </a>
            </li>
            <li><a href="{{ route('laporan.pemeriksaan') }}">
                    <i class="fa-solid fa-file-pen"></i> Laporan Rekam Medis
                </a>
            </li>
            {{--
            =================================================================================================================================================================
            --}}

            @endif
        </ul>
    </div>
</div>