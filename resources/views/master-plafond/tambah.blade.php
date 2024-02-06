@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Tambah Master Part</b></h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('master-part.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <form action="{{ route('master-part.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <strong>Part No</strong>
                            <input type="text" name="part_no" class="form-control" placeholder="contoh: 12-ABCD-XD">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <strong>Nama Part</strong>
                            <input type="text" name="part_nama" class="form-control" placeholder="contoh: AIR AKI">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <strong>Kategori Part</strong>
                            <select name="id_kategori_part" class="form-control" >
                                <option value="">---Pilih Kategori Part--</option>
                                @foreach($kategori as $k)
                                    <option value=" {{ $k->id }}"> {{ $k->kategori_part }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <strong>Group Part</strong>
                            <select name="id_group_part" class="form-control" >
                                <option value="">---Pilih Group Part--</option>
                                @foreach($group as $k)
                                    <option value=" {{ $k->id }}"> {{ $k->group_part }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <strong>Produk Part</strong>
                            <select name="id_produk_part" class="form-control" >
                                <option value="">---Pilih Produk Part--</option>
                                @foreach($produk as $k)
                                    <option value=" {{ $k->id }}"> {{ $k->produk_part }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <strong>Kelompok Part</strong>
                            <select name="id_kelompok_part" class="form-control" >
                                <option value="">---Pilih Kelompok Part--</option>
                                @foreach($kelompok as $k)
                                    <option value=" {{ $k->id }}"> {{ $k->kelompok_part }} </option>
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