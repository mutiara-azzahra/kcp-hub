@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Plafond Toko</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('master-plafond.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{ route('master-plafond.store_tambah') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <strong>Kode Toko</strong>
                            <input type="text" name="kd_outlet" class="form-control" value="{{ $plafond->kd_outlet }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <strong>Nama Toko</strong>
                            <input type="text" name="nm_outlet" class="form-control" value="{{ $plafond->nm_outlet }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <strong>Limit Plafond</strong>
                            <input type="text" name="nominal_plafond" class="form-control" value="{{ $plafond->nominal_plafond }}" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Sisa Plafond</strong><br>
                            Rp. {{ $sisa_plafond }}<br>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <strong>Tambah Limit Plafond</strong>
                            <input type="text" name="limit_plafond" class="form-control" value="" placeholder="0">
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