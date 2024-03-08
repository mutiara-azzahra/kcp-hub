@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Transfer Masuk</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('transfer-masuk.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('warning'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{ route('transfer-masuk.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Tanggal Transfer Masuk</strong>
                            <input type="date" name="tanggal_bank" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Bank</strong>
                            <select name="bank" class="form-control my-select" >
                                <option value="">--Pilih Bank--</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                                <option value="MANDIRI">MANDIRI</option>
                                <option value="BCA">BCA</option>
                                <option value="DANAMON">DANAMON</option>
                                <option value="DANAMON_REGULER">DANAMON REGULER</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Dari Toko</strong>
                            <select name="dari_toko" class="form-control my-select" onchange="updateData()">
                                <option value="">--Pilih--</option>
                                <option value="1" data-id="1">YA</option>
                                <option value="2" data-id="2">TIDAK</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12" id="toko-selection" style="display: none;">
                        <div class="form-group">
                            <strong>Pilih Toko</strong><br>
                            <select name="kd_outlet" class="form-control mb-2 my-select">     
                                <option value="">-- Pilih Toko --</option>
                                @foreach($all_toko as $s)
                                    <option value="{{ $s->kd_outlet }}">{{ $s->kd_outlet }} / {{ $s->nm_outlet }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Keterangan</strong>
                            <input type="hidden" name="status_transfer" value="1">
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
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    function updateData() {
        var dariToko = document.getElementsByName('dari_toko')[0];
        var tokoSelection = document.getElementById('toko-selection');

        if (dariToko.value == '1') {
            tokoSelection.style.display = 'block'; // Show the dropdown
        } else {
            tokoSelection.style.display = 'none'; // Hide the dropdown
        }
    }
</script>

@endsection