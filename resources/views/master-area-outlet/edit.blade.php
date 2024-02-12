@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Ubah Master Area Outlet</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('master-area-outlet.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" id="myAlert">
            <strong>Maaf!</strong> Ada yang belum terisi<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{ route('master-area-outlet.update', $area_outlet->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group mb-2 col-md-12 col-lg-12">
                        <div class="form-group">
                            <strong>Kode Provinsi</strong>
                            <input type="text" name="kode_prp" class="form-control" value= "{{ $area_outlet->kode_prp }}" readonly>
                        </div>
                    </div>
                    <div class="form-group mb-2 col-md-12 col-lg-12">
                        <div class="form-group">
                            <strong>Kode Kabupaten/Kota</strong>
                            <input type="text" name="kode_kab" class="form-control" value= "{{ $area_outlet->kode_kab }}" readonly>
                        </div>
                    </div>
                    <div class="form-group mb-2 col-md-12 col-lg-12">
                        <div class="form-group">
                            <strong>Kabupaten/Kota</strong>
                            <input type="text" name="nm_area" class="form-control" value= "{{ $area_outlet->nm_area }}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="float-right pt-3">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan Data</button>                            
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