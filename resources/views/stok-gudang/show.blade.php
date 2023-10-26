@extends('welcome')
 
@section('content')
<div class="container" style="padding: 20px; padding-bottom: 30px;">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row mt-2">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Details Stok Gudang</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('stok-gudang.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>        
    </div>


    <div class="card" style="padding: 30px;">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Part No</strong><br>
                    {{ $stok_id->part_no }}<br>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Stok</strong><br>
                    {{ number_format($stok_id->stok, 0, ',', '.') }}<br>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kode Rak</strong><br>
                    @if($stok_id->master_part->rak != null)

                    {{ $stok_id->master_part->rak->kode_rak_lokasi }}<br>

                    @else

                    Belum Ada Kode Rak<br>
                    
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    
</div>
@endsection