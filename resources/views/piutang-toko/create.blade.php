@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Entry Potongan Titipan</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('piutang-toko.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <form action="{{ route('piutang-toko.store') }}" method="POST">

                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Tanggal</strong>
                            <input type="date" name="tanggal_piutang" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Pilih Toko</strong>
                            <select name="kd_outlet" class="form-control my-select">
                                <option value="">---Pilih Toko--</option>
                                @foreach($outlet as $k)
                                    <option value=" {{ $k->kd_outlet }}"> {{ $k->kd_outlet }} / {{ $k->nm_outlet }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Nominal</strong>
                            <input type="text" name="nominal" class="form-control" placeholder="Isi keterangan">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="float-right">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                            
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


@endsection