@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Monitoring SPV</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('monitoring.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <table class="table table-hover table-bordered table-sm bg-light table-striped">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Target</th>
                            <th class="text-center">Insentif Actual</th>
                            <th class="text-center">Pencapaian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        <tr>
                            <td class="text-center">Rp. {{ number_format($getTarget, 0, ',', '.') }}</td>
                            <td class="text-center">Rp. {{ number_format($target, 0, ',', '.') }}, Rp. {{ number_format($selisih, 0, ',', '.') }}</td>
                            <td class="text-center">{{ number_format($pencapaian_persen, 10, ',', '.') }} %</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection