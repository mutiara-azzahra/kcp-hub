@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Packingsheet / PS</h4>
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
            <div class="col-lg-12">
                <div class="float-left">
                    List SO yang Telah Divalidasi
                </div>       
            </div>
            <div class="float-right">
                <a class="btn btn-warning" href="{{ route('packingsheet.reset') }}"><i class="fas fa-refresh"></i> Reset Packingsheet</a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-lg-12">

                @foreach($so_validated as $v)
                        
                <form action="{{ route('packingsheet.store_packingsheet', ['noso' => $v->noso]) }}" method="POST">
                @csrf
                
                @endforeach
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center"></th>
                            <th class="text-center">No Sales Order</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($so_validated as $v)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_items[]" value="{{ $v->noso }}">
                                </div>
                            </td>
                            <td class="text-left">KCP/NON/{{ $v->area_so }}/{{ $v->noso }}</td>
                            <td class="text-center">{{ $v->kd_outlet }}</td>
                            <td class="text-left">{{ $v->nm_outlet }}</td>
                            <td class="text-center">{{ $v->flag_vald_date}}</td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <div class="float-left">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                            
                    </div>
                </div>
                
            </form>

            </div>
    </div>

            <div class="card" style="padding: 10px;">
                <div class="card-header">
                    <div class="col-lg-12">
                        <div class="float-left">
                            List Packingsheet
                        </div>       
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">  
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">No. Packingsheet</th>
                                    <th class="text-center">Kode Outlet</th>
                                    <th class="text-center">Nama Outlet</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp

                                @foreach($list_packingsheet as $v)
                                <tr>
                                    <td class="text-left">KCP/NON/{{ $v->area_ps }}/{{ $v->nops }}</td>
                                    <td class="text-center">{{ $v->kd_outlet }}</td>
                                    <td class="text-left">{{ $v->nm_outlet }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="{{ route('packingsheet.details',$v->nops) }}">
                                            <i class="fas fa-list"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm" href="{{ route('packingsheet.cetak',$v->nops) }}" target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
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

@endsection