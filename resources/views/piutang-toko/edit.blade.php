@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Piutang dan Kas Masuk</h4>
            </div>
            <div class="float-right">
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
                        <th class="text-left">Amount Potong</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $data->kd_outlet }} / {{ $data->nm_outlet }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Potongan</th>
                        <td>:</td>
                        <td class="text-left"><b>Rp. {{ number_format($data->nominal_potong, 0, ',', '.') }}</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">

        @foreach($kas_masuk as $i)
                        
        <form action="{{ route('piutang-toko.store-kas', ['kas' => $i->no_kas_masuk ]) }}" method="POST">
        <input type="hidden" name="no_piutang" value="{{ $data->no_piutang }}">
        @csrf

        @endforeach

            <table class="table table-hover table-bordered table-sm bg-light table-striped">
                <thead>
                        <tr style="background-color: #6082B6; color:white">
                        <th class="text-center"></th>
                        <th class="text-center">No. Kas Masuk</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kas_masuk as $s)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_items[]" value="{{ $s->noinv }}">
                                </div>
                            </td>
                            <td class="text-left">{{ $s->no_kas_masuk }}</td>
                            <td class="text-left">{{ $s->kd_outlet }} / {{ $s->outlet->nm_outlet }}</td>
                            <td class="text-right">{{ number_format($s->nominal, 0, ',', '.') }}</td>
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

</div>
@endsection

@section('script')

@endsection