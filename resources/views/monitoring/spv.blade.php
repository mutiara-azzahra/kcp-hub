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
                            <td class="text-center">Rp. {{ number_format($target, 0, ',', '.') }}, <p style="color:red;">({{ number_format($selisih, 0, ',', '.') }})</p></td>
                            <td class="text-center">{{ number_format($pencapaian_persen, 5, ',', '.') }} %</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="card" style="padding: 2px;">
        <div class="card-body table-responsive p-2">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center"></th>
                            <th class="text-center">Januari</th>
                            <th class="text-center">Februari</th>
                            <th class="text-center">Maret</th>
                            <th class="text-center">April</th>
                            <th class="text-center">Mei</th>
                            <th class="text-center">Juni</th>
                            <th class="text-center">Juli</th>
                            <th class="text-center">Agustus</th>
                            <th class="text-center">September</th>
                            <th class="text-center">Oktober</th>
                            <th class="text-center">November</th>
                            <th class="text-center">Desember</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td class="text-right" style="background-color: yellow; color:black">ACTUAL</td>
                            <td class="text-right">-</td>
                            <td class="text-right">-</td>
                            <td class="text-right">-</td>
                            <td class="text-right">-</td>
                            <td class="text-right">-</td>
                            <td class="text-right">-</td>
                            <td class="text-right">-</td>
                            <td class="text-right">-</td>
                            <td class="text-right">-</td>
                            <td class="text-right">-</td>
                            <td class="text-right">{{ number_format($getTargetBulanan->sum('nominal_total'), 0, ',', '.') }}</td>
                            <td class="text-right">-</td>
                        </tr>
                        <tr>
                            <td class="text-right" style="background-color: red; color:white">TARGET</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 1)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 2)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 3)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 4)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 5)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 6)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 7)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 8)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 9)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 10)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 11)->value('nominal'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($getTargetActual->where('bulan', 12)->value('nominal'), 0, ',', '.') }}</td>
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