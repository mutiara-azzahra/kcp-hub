@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Koli Packingsheet</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('packingsheet.details', $header_ps->nops) }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <div class="col-lg-6">
                        <table class="table table-borderless">
                            <tr>
                                <th class="text-left">No. Packingsheet</th>
                                <td>:</td>
                                <td class="text-left"><b>{{ $header_ps->nops }}</b></td>
                            </tr>
                        </table>
                    </div>

                    @if($check === null)
                    <div col-lg-12>
                        <form action="{{ route('packingsheet.store-dus')}}" method="POST">
                        @csrf
                            <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                                <thead>
                                    <tr style="background-color: #6082B6; color:white">
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Koli</th>
                                        <th class="text-center">Tambah</th>
                                    </tr>
                                </thead>
                                <tbody class="input-fields">
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-group col-12">
                                                <select name="inputs[0][kd_kategori]" class="form-control mr-2">
                                                    <option value="">-- Pilih --</option>
                                                    @foreach($kategori as $a)  
                                                        <option value="{{ $a->kd_kategori }}">{{ $a->kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group col-12">
                                                <input type="hidden" name="inputs[0][nops]" value="{{ $header_ps->nops }}" class="form-control" placeholder="0">
                                                <input type="number" name="inputs[0][koli]" class="form-control" placeholder="0">
                                            </div>
                                        </td>
                                        
                                        <td class="text-center">
                                            <div class="form-group col-12">
                                                <a type="button" class="btn btn-primary m-1" id="add"><i class="fas fa-plus"></i></a>                                                                                  
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
                        </form>  
                    </div>

                    @else

                    <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. Dus</th>
                            <th class="text-center">Kode Kategori</th>
                            <th class="text-center">Kategori</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($details_dus as $v)
                        <tr>
                            <td class="text-left">{{ $v->no_dus }}</td>
                            <td class="text-center">{{ $v->kd_kategori }}</td>
                            @if($v->kd_kategori == 'A')
                            <td class="text-left">AIR AKI</td>
                            @elseif($v->kd_kategori == 'SP')
                            <td class="text-left">SPAREPART</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    <script>
        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(`<tr>
                    <td class="text-center">
                        <div class="form-group col-12">
                            <select name="inputs[${i}][kd_kategori]" class="form-control mr-2">
                                <option value="">-- Pilih --</option>
                                @foreach($kategori as $a)  
                                    <option value="{{ $a->kd_kategori }}">{{ $a->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-group col-12">
                            <input type="hidden" name="inputs[${i}][nops]" value="{{ $header_ps->nops }}" class="form-control" placeholder="0">
                            <input type="number" name="inputs[${i}][koli]" class="form-control" placeholder="0">
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-danger remove-table-row"><i class="fas fa-minus"></i></button>
                        </div>
                    </td>
                </tr>
            `);
        });

    $(document).on('click','.remove-table-row', function(){
        $(this).parents('tr').remove();
    })

    </script>

@endsection

