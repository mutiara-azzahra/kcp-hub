@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Details Kas Keluar</h4>
            </div>
            @if ($balancing == 0)
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('kas-keluar.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            @endif
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('warning'))
        <div class="alert alert-danger" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($balancing != 0)
        <div class="alert alert-danger text-center">
            <p style="color:white; text-transform: uppercase;"><b>Kas Keluar Tidak Balance, Periksa Kembali Data Anda!</b></p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-8 p-1">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-left">Tgl. Transaksi</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ Carbon\Carbon::parse($kas_keluar->tanggal_transaksi)->format('d-m-Y') }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">No. Kas Keluar</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_keluar->no_keluar }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Pembayaran</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_keluar->pembayaran }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Keterangan</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_keluar->keterangan }}</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12 p-1" id="main" data-loading="true">
                <form action="{{ route('kas-keluar.store-details')}}" method="POST">
                    @csrf
                    <div class="table-container">
                        <table class="table table-hover table-sm bg-light table-striped table-bordered">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Perkiraan</th>
                                    <th class="text-center">Akuntansi To</th>
                                    <th class="text-center">Nominal</th>
                                </tr>
                            </thead>
                            <tbody class="input-fields">
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <select name="akuntansi_to" class="form-control mr-2" id="package" onchange="updateData()">
                                                <option value="">-- Pilih --</option>
                                                <option value="D" data-id="D">DEBET</option>
                                                <option value="K" data-id="K">KREDIT</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <select name="perkiraan" class="form-control mr-2 my-select" id="perkiraan-selection">     
                                                <option value="">-- Pilih Perkiraan --</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="hidden" name="no_keluar" value="{{ $kas_keluar->no_keluar }}">
                                            <input type="text" name="total" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <div class="float-right">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                           
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12 p-1" id="main" data-loading="true">
                    <div class="table-container">
                        <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Perkiraan</th>
                                    <th class="text-center">Akuntansi To</th>
                                    <th class="text-center">DEBET</th>
                                    <th class="text-center">KREDIT</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="input-fields">
                                @foreach($kas_keluar->details_keluar as $i)
                                <tr>
                                    <td class="text-left">
                                        {{ $i->details_perkiraan->id_perkiraan }} - {{ $i->details_perkiraan->nm_sub_perkiraan }}
                                    </td>
                                    <td class="text-center">
                                        @if($i->akuntansi_to == 'D')

                                        DEBET
                                        @else

                                        KREDIT
                                        @endif
                                    </td>
                                    @if($i->akuntansi_to == 'D')
                                    <td class="text-right">
                                        {{ number_format($i->total, 0, ',', '.') }}
                                    </td>
                                    <td></td>
                                    
                                    @else
                                    <td></td>
                                    <td class="text-right">
                                        {{ number_format($i->total, 0, ',', '.') }}
                                    </td>
                                    @endif
                                    <td class="text-center">
                                        <form action="{{ route('kas-keluar.delete-details', $i->id) }}" method="POST" id="form_delete_{{ $i->id }}" data-id="{{ $i->id }}">

                                            @csrf
                                            @method('DELETE')
                                            
                                            <a class="btn btn-danger btn-sm" onclick="Hapus('{{$i->id}}')"><i class="fas fa-times"></i></a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>

    //AKUN DEBET DAN KREDIT

    function updateData() {
        var selectedOption = document.querySelector('select[name="akuntansi_to"]');
        var dataId         = selectedOption.options[selectedOption.selectedIndex].getAttribute('data-id');

        var kdOutletDropdown = document.getElementById('perkiraan-selection');
        var options = kdOutletDropdown.options;

        while (options.length > 0) {
            options.remove(0);
        }

        if (dataId == 'D') {
            @foreach($debet as $s)
                var option      = document.createElement('option');
                option.value    = "{{ $s->id }}";
                option.text     = "{{ $s->perkiraan }}.{{ $s->sub_perkiraan }} - {{ $s->nm_perkiraan }}";
                kdOutletDropdown.add(option);
            @endforeach
        } else {
            @foreach($kredit as $s)
                var option      = document.createElement('option');
                option.value    = "{{ $s->id }}";
                option.text     = "{{ $s->perkiraan }}.{{ $s->sub_perkiraan }} - {{ $s->nm_perkiraan }}";
                kdOutletDropdown.add(option);
            @endforeach
        }
    }

    //HAPUS

    Hapus = (id)=>{
        Swal.fire({
            title: 'Apa anda yakin menghapus data detail kas masuk ini?',
            text:  "Data tidak dapat kembali" ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6' ,
            cancelButtonColor: 'red' ,
            confirmButtonText: 'hapus data' ,
            cancelButtonText: 'batal' ,
            reverseButtons: false
            }).then((result) => {
                if (result.value) {
                    document.getElementById('form_delete_' + id).submit();
                }
        })
    }


</script>    

@endsection