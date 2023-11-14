@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Target SPV</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('master-target-spv.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <form action="{{ route('master-target-spv.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <strong>Pilih SPV</strong>
                            <select name="spv" class="form-control my-select" >
                                <option value="">---Pilih SPV--</option>
                                <option value="yana">Yana</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <strong>Bulan</strong>
                            <input type="number" name="bulan" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <strong>Tahun</strong>
                            <input type="number" name="tahun" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <strong>Nominal Target</strong>
                            <input type="number" name="nominal" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="float-right pt-3">
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