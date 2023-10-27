@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Area Sales</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('master-sales.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" id="myAlert">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card" style="padding: 10px;">
                <div class="card-header">
                    Nama Sales : <b>{{ $sales->sales }}</b>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{ route('master-sales.store-details') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <table id="table">
                                        <tbody class="input-fields">
                                            <tr>
                                                <td>
                                                    <div class="form-group col-md-12">
                                                        <select name="inputs[0][kode_kabupaten]" class="form-control my-select">
                                                            <option value="">---Pilih Area--</option>
                                                            @foreach($master_area as $a)
                                                                <option value="{{ $a->kode_kab }}">{{ $a->nm_area }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group col-12">
                                                        <input type="hidden" name="inputs[0][id_sales]" value="{{ $sales->id }}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group col-md-12">
                                                        <a type="button" class="btn btn-primary m-1" id="add"><i class="fas fa-plus"></i></a>                                                                                  
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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

        <div class="card" style="padding: 10px;">
            <div class="card-header">
                List Area Sales
            </div>

            <div class="card-body">
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kode Area</th>
                                    <th class="text-center">Nama Area Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp

                                @foreach($area as $p)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-left">{{ $p->kode_kabupaten }}</td>
                                    <td class="text-left">{{ $p->area_outlet->nm_area }}</td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
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
                                                <td>
                                                    <div class="form-group col-md-12">
                                                        <select name="inputs[${i}][kode_kabupaten]" class="form-control my-select">
                                                            <option value="">---Pilih Area--</option>
                                                            @foreach($master_area as $a)
                                                                <option value="{{ $a->kode_kab }}">{{ $a->nm_area }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group col-12">
                                                        <input type="hidden" name="inputs[${i}][id_sales]" value="{{ $sales->id }}">
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