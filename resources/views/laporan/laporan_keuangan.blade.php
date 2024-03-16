@extends('layouts.app')

@section('title', 'Laporan Pemakaian')

@section('header', 'Laporan Pemakain Obat')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Laporan obat terpakai</h3>
        <a href="{{ route('cetak.laporanPemakaian') }}" target="_blank" class="btn btn-sm btn-danger text-end"><i
                class="fa-solid fa-print me-2"></i>Cetak Laporan</a>
    </div>

    <div class="card-body shadow-sm pb-0">
        <div class="default-tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home"><i class="la la-home me-2"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#profile"><i class="la la-user me-2"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#contact"><i class="la la-phone me-2"></i> Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Message</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <div class="pt-4">
                        <h4>This is home title</h4>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                        </p>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile">
                    <div class="pt-4">
                        <h4>This is profile title</h4>
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                        </p>
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact">
                    <div class="pt-4">
                        <h4>This is contact title</h4>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                        </p>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="message">
                    <div class="pt-4">
                        <h4>This is message title</h4>
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                        </p>
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection