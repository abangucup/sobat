<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ route('dashboard') }}">
                    <i class="fa fa-solid fa-house"></i> Dashboard
                </a>
            </li>
            <li><a href="{{ route('distributor.index') }}">
                    <i class="fa-solid fa-boxes-packing"></i> Distributor
                </a>
            </li>
            <li><a href="{{ route('obat.index') }}">
                    <i class="fa-solid fa-pills"></i> Obat
                </a>
            </li>
            <li><a href="{{ route('expired.index') }}">
                    <i class="fa-solid fa-pills"></i> Obat Expired
                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="fa-solid fa-truck-medical"></i> Pemesanan Obat
                </a>
                <ul aria-expanded="false" class="mm-collapse">
                    <li><a href="{{ route('pemesanan-obat.create') }}">Buat Pesanan</a></li>
                    <li><a href="file-manager.html">Daftar Pemesanan</a></li>
                    <li><a href="file-manager.html">Pesanan Diproses</a></li>
                    <li><a href="file-manager.html">Pesanan Selesai</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="fa-solid fa-book-medical"></i> Permintaan Obat
                </a>
                <ul aria-expanded="false" class="mm-collapse">
                    <li><a href="file-manager.html">Menunggu Persetujuan</a></li>
                    <li><a href="file-manager.html">Disetujui</a></li>
                </ul>
            </li>
            <li><a href="#">
                    <i class="fa-solid fa-file-invoice-dollar"></i> Rekapan Keuangan
                </a>
            </li>
            <li><a href="{{ route('user.index') }}">
                    <i class="fa-solid fa-users"></i> Data User
                </a>
            </li>
        </ul>
    </div>
</div>