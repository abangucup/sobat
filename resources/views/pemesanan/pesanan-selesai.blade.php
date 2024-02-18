@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Pesanan Selesai')

@section('content')

<div class="card">
    <div class="card-body shadow-sm pb-0">
        <form action="{{ route('pemesanan-obat.store') }}" method="post">
            @csrf
            <div class="col-6">
                
            </div>
        </form>
    </div>
</div>
@endsection