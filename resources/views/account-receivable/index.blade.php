@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Account Receiveable</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('account-receivable.create') }}"><i class="fas fa-plus"></i> Potong Titipan</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">

                @foreach($invoice as $i)
                        
                <form action="{{ route('account-receivable.store', ['invoice' => $i->noinv ]) }}" method="POST">

                @csrf
                @endforeach

                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <!-- <th></th> -->
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">Kode | Nama Toko</th>
                            <th class="text-center">Nominal Invoice</th>
                            <th class="text-center">Tanggal Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($invoice as $s)
                        <tr>
                            <!-- <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_items[]" value="{{ $s->noinv }}">
                                </div>
                            </td> -->
                            <td class="text-left">{{ $s->noinv }}</td>
                            <td class="text-left">{{ $s->kd_outlet }}/{{ $s->nm_outlet }}</td>
                            <td class="text-left">Rp. {{ number_format($s->details_invoice->sum('nominal_total'), 0, ',', '.') }}</td>
                            <td class="text-left">{{ $s->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center"></th>
                            <th class="text-center">No</th>
                            <th class="text-center">No Invoice</th>
                            <th class="text-center">Kode/Nama Toko</th>
                            <th class="text-center">Tgl. Buat</th>
                            <th class="text-center">Tgl. Jatuh Tempo</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($piutang_header as $p)
                        <tr>
                            <td class="text-center">{{ $p }}</td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('account-receivable.detail', $p->no_piutang ) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection