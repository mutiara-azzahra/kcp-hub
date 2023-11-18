@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Monitoring Sales</h4>
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

    <div class="card" style="padding: 2px;">
        <div class="card-body">
            <div class="col-lg-4">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-left">Nama Sales</th>
                        <td>:</td>
                        <td class="text-left">{{ $sales }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Bulan</th>
                        <td>:</td>
                        <td class="text-left">{{ $monthName }} 2023</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Target</th>
                            <th class="text-center">Actual</th>
                            <th class="text-center">Ach.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        <tr>
                            <td class="text-center">Rp. {{ number_format($getTarget, 0, ',', '.') }}</td>
                            <td class="text-center">Rp. {{ number_format($target, 0, ',', '.') }}, <p style="color:red;">({{ number_format($selisih, 0, ',', '.') }})</p></td>
                            <td class="text-center">{{ number_format($pencapaian_persen, 3, ',', '.') }} %</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="card" style="padding: 2px;">
        <div class="card-body table-responsive p-2">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1" style="font-size: 12px;">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center"></th>
                            <th class="text-center">Jan</th>
                            <th class="text-center">Feb</th>
                            <th class="text-center">Mar</th>
                            <th class="text-center">Apr</th>
                            <th class="text-center">Mei</th>
                            <th class="text-center">Jun</th>
                            <th class="text-center">Jul</th>
                            <th class="text-center">Agt</th>
                            <th class="text-center">Sep</th>
                            <th class="text-center">Okt</th>
                            <th class="text-center">Nov</th>
                            <th class="text-center">Des</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td class="text-right" style="background-color: yellow; color:black">TARGET</td>
                            <td class="text-right">{{ $target_jan }}</td>
                            <td class="text-right">{{ $target_feb }}</td>
                            <td class="text-right">{{ $target_mar }}</td>
                            <td class="text-right">{{ $target_apr }}</td>
                            <td class="text-right">{{ $target_may }}</td>
                            <td class="text-right">{{ $target_jun }}</td>
                            <td class="text-right">{{ $target_jul }}</td>
                            <td class="text-right">{{ $target_agu }}</td>
                            <td class="text-right">{{ $target_sep }}</td>
                            <td class="text-right">{{ $target_oct }}</td>
                            <td class="text-right">{{ $target_nov }}</td>
                            <td class="text-right">{{ $target_dec }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" style="background-color: red; color:white">ACTUAL</td>
                            <td class="text-right">{{ $jan }}</td>
                            <td class="text-right">{{ $feb }}</td>
                            <td class="text-right">{{ $mar }}</td>
                            <td class="text-right">{{ $apr }}</td>
                            <td class="text-right">{{ $may }}</td>
                            <td class="text-right">{{ $jun }}</td>
                            <td class="text-right">{{ $jul }}</td>
                            <td class="text-right">{{ $agu }}</td>
                            <td class="text-right">{{ $sep }}</td>
                            <td class="text-right">{{ $oct }}</td>
                            <td class="text-right">{{ $nov }}</td>
                            <td class="text-right">{{ $dec }}</td>
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