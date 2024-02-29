@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Master Perkiraan</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('master-perkiraan.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <form action="{{ route('master-perkiraan.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Perkiraan</strong>
                            <input type="text" name="perkiraan" class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Sub Pekiraan</strong>
                            <input type="text" name="sub_perkiraan" class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Nama Perkiraan</strong>
                            <input type="text" name="nm_perkiraan" class="form-control" placeholder="Isi Nama Perkiraan">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Nama Sub Perkiraan</strong>
                            <input type="text" name="nm_sub_perkiraan" class="form-control" placeholder="Isi Nama Sub Perkiraan">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Pilih Head Kategori</strong><br>
                            <select name="flag_head" class="form-control my-select" >
                                <option value="">--Pilih--</option>
                                <option value="Y">Ya</option>
                                <option value="N">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Head Kategori</strong>
                            <input type="text" name="head_kategori" class="form-control" placeholder="Isi Nama Head Kategori">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Kategori</strong>
                            <input type="text" name="kategori" class="form-control" placeholder="Isi Nama Sub Perkiraan">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Kelompok Perkiraan</strong><br>
                            <select name="sts_perkiraan" class="form-control my-select" >
                                <option value="">--Pilih--</option>
                                <option value="D">Debit</option>
                                <option value="K">Kredit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Status</strong><br>
                            <select name="status" class="form-control my-select" >
                                <option value="">--Pilih--</option>
                                <option value="AKTIF">Aktif</option>
                                <option value="NON_AKTIF">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="float-right">
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