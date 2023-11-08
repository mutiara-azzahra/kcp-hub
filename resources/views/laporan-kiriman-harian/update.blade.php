@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Edit Kiriman Harian</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('laporan-kiriman-harian.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Maaf!</strong> Ada yang salah<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="padding: 20px;">
        <form action="{{ route('laporan-kiriman-harian.store-details', ['no_lkh' => $details->no_lkh ]) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>No. LKH</strong> : 
                        {{ $details->no_lkh }}<br>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Driver</strong> *wajib diisi
                        <select name="driver" class="form-control mr-2">
                            <option value="">-- Pilih Driver --</option>
                            @foreach($driver as $s)
                                <option value="{{ $s->username }}">{{ $s->nama_user }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Helper</strong>
                        <select name="helper" class="form-control mr-2">
                            <option value="">-- Pilih Helper --</option>
                            @foreach($helper as $s)
                                <option value="{{ $s->username }}">{{ $s->nama_user }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Plat Mobil</strong>
                        <input type="text" name="plat_mobil" class="form-control" value="{{ $details->plat_mobil }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Jam Berangkat</strong> *wajib diisi
                        <input type="text" name="jam_berangkat" class="form-control"  value="{{ $details->jam_berangkat }}" placeholder="HH:mm">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Jam Kembali</strong> *wajib diisi
                        <input type="text" name="jam_kembali" class="form-control" value="{{ $details->jam_kembali }}" placeholder="HH:mm">
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>KM. Berangkat</strong>
                        <input type="text" name="km_berangkat_mobil" class="form-control" value="{{ $details->km_berangkat_mobil }}" placeholder="Contoh: 30.000">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>KM. Kembali</strong>
                        <input type="text" name="km_kembali_mobil" class="form-control" value="{{ $details->km_kembali_bmobil }}" placeholder="Contoh: 30.000">
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
@endsection

@section('script')


@endsection