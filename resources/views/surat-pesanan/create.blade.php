@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Buat Surat Pesanan/SP</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('surat-pesanan.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" id="myAlert">
                    <p>{{ $message }}</p>
                </div>
            @elseif ($message = Session::get('danger'))
                <div class="alert alert-danger" id="myAlert">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <div class="col-lg-12">

                        @if($toko != null)
                        <form action="{{ route('surat-pesanan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <strong>Toko</strong>
                                        <select name="kd_outlet" class="form-control mr-2">
                                            <option value="">-- Pilih Toko --</option>
                                            @foreach($toko->outlet as $s)
                                                <option value="{{ $s->kd_outlet }}">{{ $s->kd_outlet }} / {{ $s->nm_outlet }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <strong>Keterangan</strong>
                                        <input type="text" name="keterangan" class="form-control" placeholder="Isi Keterangan">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                            
                                    </div>
                                </div>
                            </div>
                        </form>

                        @else

                            <div class="card-header">
                                <b>Pemberitahuan</b>
                            </div>
                            <div class="card-body">
                                <p>Maaf, anda belum memiliki Toko.</li>
                            </div>
                        @endif
                    </div>
                </div>
        </div>

</div>
@endsection

@section('script')

@endsection