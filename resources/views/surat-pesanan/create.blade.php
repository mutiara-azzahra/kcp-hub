@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
            @if(Auth::user()->id_role == 24)
            <h4>Buat Surat Pesanan/SP by Office</h4>
            @else
            <h4>Buat Surat Pesanan/SP by Sales</h4>
            @endif
                
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
                    @if(Auth::user()->id_role == 24)
                        <form action="{{ route('surat-pesanan.store') }}" method="POST">
                        @csrf
                            <div class="col">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <strong>Pilih Sales</strong><br>
                                        <select name="sales" class="form-control mb-2 my-select" onchange="updateData()">     
                                            <option value="">-- Pilih Sales --</option>
                                            @foreach($all_sales as $s)
                                                <option value="{{ $s->sales }}" data-id="{{ $s->sales }}">{{ $s->sales }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                @if(Auth::user()->id_role == 24)
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <strong>Toko</strong><br>
                                            <select name="kd_outlet" class="form-control mb-2 my-select" id="toko-selection">     
                                                <option value="">-- Pilih Toko --</option>
                                                @foreach($all_toko as $s)
                                                    <option value="{{ $s->kd_outlet }}">{{ $s->kd_outlet }} / {{ $s->nm_outlet }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-lg-6">
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
                    <form action="{{ route('surat-pesanan.store') }}" method="POST">
                        @csrf
                        <div class="col">                        
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Toko</strong><br>
                                    <select name="kd_outlet" class="form-control mb-2 my-select">     
                                        <option value="">-- Pilih Toko --</option>
                                        @foreach($toko as $i)
                                            @foreach($i->outlet as $s)
                                                <option value="{{ $s->kd_outlet }}">{{ $s->kd_outlet }} / {{ $s->nm_outlet }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
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
                    @endif

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

<script>
    function updateData() {
        var selectedOption = document.querySelector('select[name="sales"]');
        var dataId         = selectedOption.options[selectedOption.selectedIndex].getAttribute('data-id');

        var kdOutletDropdown = document.getElementById('toko-selection');
        var options = kdOutletDropdown.options;

        while (options.length > 0) {
            options.remove(0);
        }

        if (dataId == 'rezky') {
            @foreach($toko_kanvas as $s)
                var option      = document.createElement('option');
                option.value    = "{{ $s->kd_outlet }}";
                option.text     = "{{ $s->kd_outlet }} / {{ $s->nm_outlet }}";
                kdOutletDropdown.add(option);
            @endforeach
        } else {
            @foreach($all_toko as $s)
                var option      = document.createElement('option');
                option.value    = "{{ $s->kd_outlet }}";
                option.text     = "{{ $s->kd_outlet }} / {{ $s->nm_outlet }}";
                kdOutletDropdown.add(option);
            @endforeach
        }
    }
</script>

@endsection