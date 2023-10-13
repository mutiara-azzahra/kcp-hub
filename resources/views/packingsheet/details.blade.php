@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card" style="padding: 10px;">
                <div class="card-header">
                    <div class="col-lg-12 pb-3">
                        <div class="float-right m-1">
                            <a class="btn btn-warning" href="{{ route('packingsheet.cetak', $header_ps->nops) }}" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                        </div>
                        <div class="float-right m-1">
                            <a class="btn btn-success" href="{{ route('packingsheet.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 p-1">
                            <table class="table table-hover bg-light table-striped">
                                <tr>
                                    <th class="text-left">No. Packingsheet</th>
                                    <td>:</td>
                                    <td class="text-left">{{ $header_ps->nops }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Koli</th>
                                    <td>:</td>
                                    <td class="text-left">
                                        <a class="btn btn-info btn-sm" href="{{ route('packingsheet.koli', $header_ps->nops) }}"><i class="fas fa-eye"></i> Isi Koli</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            <div class="col-lg-12 p-3">
                                <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No</th>
                                            <th class="text-center">Nama Part</th>
                                            <th class="text-center">Qty SO</th>
                                            <th class="text-center">Dus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp

                                        @foreach($header_ps_details as $v)
                                            @foreach($v->details_ps as $d)
                                            <tr>
                                                <td class="text-left">{{ $d->part_no }}</td>
                                                <td class="text-left">{{ $d->master_part->part_nama }}</td>
                                                <td class="text-center">{{ $d->qty }}</td>
                                                <td class="text-center"></td>
                                            </tr>
                                            @endforeach

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