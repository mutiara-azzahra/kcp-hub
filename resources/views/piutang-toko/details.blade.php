@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Pemotongan Piutang Toko</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-warning m-1" href="{{ route('piutang-toko.cetak', $data->no_piutang ) }}" target="_blank"><i class="fas fa-print"></i> Cetak Bukti Penerimaan Piutang</a>
                <a class="btn btn-success m-1" href="{{ route('piutang-toko.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-warning" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-8 p-1">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-left">No. Piutang</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $data->no_piutang }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Kode / Nama Toko</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $data->kd_outlet }} / {{ $data->nm_outlet }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Nominal</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ number_format($data->nominal_total, 0, '.', ',') }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Potongan</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ number_format($data->nominal_potong, 0, '.', ',') }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Pembayaran Via</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $data->pembayaran_via }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">No. BG</th>
                        <td>:</td>
                        <td class="text-left"></td>
                    </tr>
                    <tr>
                        <th class="text-left">Bank</th>
                        <td>:</td>
                        <td class="text-left"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @if($check !== null)

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No.</th>
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($data->details as $p)
                        <tr>
                            <td class="text-left">{{ $no++ }}</td>
                            <td class="text-left">{{ $p->noinv }}</td>
                            <td class="text-right">{{ number_format($p->nominal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @else
        <div class="card" style="padding: 10px;">
        <div class="card-body">

        @foreach($invoice as $i)
                        
        <form action="{{ route('piutang-toko.store-details', ['invoice' => $i->noinv ]) }}" method="POST">
        <input type="hidden" name="no_piutang" value="{{ $data->no_piutang }}">
        @csrf

        @endforeach

            <table class="table table-hover table-bordered table-sm bg-light table-striped">
                <thead>
                        <tr style="background-color: #6082B6; color:white">
                        <th class="text-center"></th>
                        <th class="text-center">No. Invoice</th>
                        <th class="text-center">Toko</th>
                        <th class="text-center">Nominal Total</th>
                        <th class="text-center">Tanggal Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice_toko as $s)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_items[]" value="{{ $s->noinv }}">
                                </div>
                            </td>
                            <td class="text-left">{{ $s->noinv }}</td>
                            <td class="text-left">{{ $s->kd_outlet }}/{{ $s->nm_outlet }}</td>
                            <td class="text-left">Rp. {{ number_format($s->details_invoice->sum('nominal_total'), 0, ',', '.') }}</td>
                            <td class="text-left">{{ $s->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <div class="float-left">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                            
            </div>
        </div>
        </form>
    </div>

    @endif

</div>
@endsection

@section('script')

@endsection