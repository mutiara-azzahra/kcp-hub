@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Master Part</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('master-part.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
            @endif

        <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{ route('master-part.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Part No</strong>
                                    <input type="text" name="part_no" class="form-control" placeholder="contoh: 12-ABCD-XD">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Nama Part</strong>
                                    <input type="text" name="part_nama" class="form-control" placeholder="contoh: AIR AKI">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>HET</strong>
                                    <input type="text" name="het" class="form-control" placeholder="contoh: 30.000">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Satuan Dus</strong>
                                    <input type="text" name="satuan_dus" class="form-control" placeholder="contoh: 50">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                        <strong>Kode Grup</strong><br>
                                        <select name="id_grup" class="form-control my-select" >
                                            <option value="">---Pilih Group Part--</option>
                                            <option value="1">Ichidai</option>
                                            <option value="2">Brio</option>
                                            <option value="3">Group Air Aki</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                        <strong>Kode Rak</strong><br>
                                        <select name="id_rak" class="form-control my-select" >
                                            <option value="">---Pilih Kode Rak--</option>
                                            @foreach($kode_rak as $a)
                                                <option value="{{ $a->id }}">{{ $a->kode_rak_lokasi }}</option>
                                            @endforeach
                                        </select>
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