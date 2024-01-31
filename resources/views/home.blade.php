@extends('layouts.app')

<?php
$page = 'Home';
?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius:15px">
                <div class="card-header" style="color: white;background-color: #5D73D5;font-weight:bold;font-size:20px;border-radius:10px">{{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (Auth::user()->role_id === 1)

                </div>
                <div class="card col" style="width: 100px; height: 100px; align-items:center; justify-content:center; margin:5px; background-color: #95B3ED">
                    <a href="{{ route('transaksi_bank') }}" style="color: white;text-decoration:none;font-size:18px">Transaksi</a>
                </div>
            </div>
            @endif
            @if (Auth::user()->role_id === 3)
            <div class="row">
                <div class="card col" style="width: 100px; height: 150px; align-items:center; justify-content:center; margin:5px; background-color: #282e4d">
                <h4 style="color: white;text-decoration:none;font-size:18px">SALDO : <b>{{ number_format($saldo->saldo, 0, ',', '.') }}</b></h4>
                    <a href="{{ route('topup') }}" style="color: white;text-decoration:none;font-size:18px">Top Up</a> 
                    <a href="{{ route('tariktunai') }}" style="color: white;text-decoration:none;font-size:18px">Tarik Tunai</a>
                    <a href="{{ route('canten') }}" style="color: white;text-decoration:none;font-size:18px">c</a>    
                </div>
            </div>
            @endif
            @if (Auth::user()->role_id === 1)
            <table class="table table-bordered border-dark table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Nominal</th>
                        <th>Tambah Saldo</th>
                        <th>Tarik Tunai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans as $key => $pengajuan)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $pengajuan->user->name }}</td>
                        <td>{{ $pengajuan->jumlah }}</td>
                        <td>
                            <a href="{{ route('topup.setuju', ['transaksi_id' => $pengajuan->id]) }}" class="btn btn-primary">
                                Accept
                            </a>
                            <a href="{{ route('topup.tolak', ['transaksi_id' => $pengajuan->id]) }}" class="btn btn-danger">
                                Decline
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('tariktunai.setuju', ['transaksi_id' => $pengajuan->id]) }}" class="btn btn-primary">
                                Accept
                            </a>
                            <a href="{{ route('tariktunai.tolak', ['transaksi_id' => $pengajuan->id]) }}" class="btn btn-danger">
                                Decline
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            @if (Auth::user()->role_id === 2)
            <table class="table table-bordered border-dark table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        {{-- <th>Nominal</th> --}}
                        <th>Invoice ID</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jajan_by_invoices as $key => $jajan_by_invoice)
                    @if ($jajan_by_invoice->status == 2 || $jajan_by_invoice->status == 3)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $jajan_by_invoice->user->name }}</td>
                        <td>{{ $jajan_by_invoice->invoice_id }}</td>
                        {{-- <td>{{ $jajan_by_invoice->jumlah }}</td> --}}
                        <td>{{ $jajan_by_invoice->status == 2 ? 'Pending' : 'Completed' }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail-{{ $jajan_by_invoice->invoice_id }}">
                                Detail
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="detail-{{ $jajan_by_invoice->invoice_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Order #{{ $jajan_by_invoice->invoice_id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered border-dark table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Menu</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $counter = 1;
                                                    $total_harga = 0;
                                                    ?>
                                                    @foreach ($pengajuan_jajans as $pengajuan_jajan)
                                                    @if ($pengajuan_jajan->invoice_id == $jajan_by_invoice->invoice_id)
                                                    <?php $total_harga += $pengajuan_jajan->jumlah * $pengajuan_jajan->barang->price; ?>
                                                    <tr>
                                                        <td>{{ $counter++ }}</td>
                                                        <td>{{ $pengajuan_jajan->barang->name }}
                                                        </td>
                                                        <td>{{ $pengajuan_jajan->jumlah }}
                                                        </td>
                                                        <td>{{ $pengajuan_jajan->barang->price }}
                                                        </td>
                                                        <td>{{ $pengajuan_jajan->jumlah * $pengajuan_jajan->barang->price }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            Total = {{ $total_harga }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if ($jajan_by_invoice->status == 3)
                            <a href="{{ route('jajan.setuju', ['invoice_id' => $jajan_by_invoice->invoice_id]) }}" class="btn btn-primary">
                                Accept
                            </a>
                            <a href="{{ route('jajan.tolak', ['invoice_id' => $jajan_by_invoice->invoice_id]) }}" class="btn btn-danger">
                                Decline
                            </a>
                            @else
                            Menunggu Pembayaran
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
</div>
</div>
@endsection


<!-- <title>Gen-z Store</title>
            <style>
    .sambutan h1 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .grid {
        display: grid;
    }

    .grid-cols-1 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }

    .lg\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .gap-4 {
        gap: 1rem;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .card {
        background-image: linear-gradient(to right, #2b2b2b, #000);
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .card-body {
        padding-bottom: 2rem;
        position: relative;
    }

    .title {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-weight: bold;
    }

    .balance {
        font-size: 2.5rem;
        margin-top: 1rem;
    }

    .top-up-btn {
        display: inline-block;
        background-color: #000080;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        margin-right: 0.5rem; /* Add some right margin for spacing */
    }

</style>

    
</head>
<body>

<div class="sambutan">
    <h1>Selamat Datang Di Gen-z Store</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
    <div class="card h-fit">
        <div class="card-body">
            <div class="title">
                <p>Saldo Anda:</p>
            </div>
            <h1 class="balance">Rp.{{ number_format($saldo->saldo, 0, ',', '.') }}</h1>
            <a href="{{ route('topup') }}" class="top-up-btn">Top Up</a>
            <a href="{{ route('topup') }}" class="top-up-btn">Tarik Tunai</a>
            
            
        </div>
    </div>
</div> -->