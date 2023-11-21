@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Report LSS</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('report-lss.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h5>{{ \Carbon\Carbon::create()->month($bulan)->format('F') }} {{ $tahun }}</h5>
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
        <div class="card-body p-2">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Sub. Kel. Part</th>
                            <th class="text-center">Produk Part</th>
                            <th class="text-center">Awal Amount</th>
                            <th class="text-center">Beli</th>
                            <th class="text-center">Jual RBP</th>
                            <th class="text-center">Jual DBP</th>
                            <th class="text-center">Akhir Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left">I01</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliI01, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppI01, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">I02</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliI02, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppI02, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">I03</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliI03, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppI03, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">I04</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliI04, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppI04, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">I05</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliI05, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppI05, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">I06</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliI06, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppI06, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">I07</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliI07, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppI07, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">I08</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliI08, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppI08, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">I09</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliI09, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppI09, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IL1</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIL1, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIL1, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IL2</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIL2, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIL2, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IL3</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIL3, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIL3, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IL4</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIL4, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIL4, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IL5</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIL5, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIL5, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IL6</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIL6, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIL6, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IL7</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIL7, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIL7, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IL8</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIL8, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIL8, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IL9</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIL9, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIL9, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IM1</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIM1, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIM1, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IM2</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIM2, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIM2, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IM3</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIM3, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIM3, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IM4</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIM4, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIM4, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IM5</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIM5, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIM5, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IM6</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIM6, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIM6, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IM7</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIM7, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIM7, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IM8</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIM8, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIM8, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">IM9</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliIM9, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppIM9, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr style="background-color: orange; color:black">
                            <td class="text-center"><b>TOTAL</b></td>
                            <td class="text-center"><b>IC2</b></td>
                            <td class="text-right"></td>
                            <td class="text-right"><b>{{ number_format(($getBeliIC2), 0, ',', '.') }}</b></td>
                            <td class="text-right"><b>{{ number_format(($getRbpIC2), 0, ',', '.') }}</b></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">B01</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliB01, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppB01, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">B02</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliB02, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppB02, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">B03</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliB03, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppB03, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr style="background-color: orange; color:black">
                            <td class="text-center"><b>TOTAL</b></td>
                            <td class="text-center"><b>BP2</b></td>
                            <td class="text-right"></td>
                            <td class="text-right"><b>{{ number_format(($beliB01 + $beliB02 + $beliB03), 0, ',', '.') }}</b></td>
                            <td class="text-right"><b>{{ number_format(($hppB01 + $hppB02 + $hppB03), 0, ',', '.') }}</b></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">L01</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliL01, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppL01, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">L02</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliL02, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppL02, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">L03</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{ number_format($beliL03, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($hppL03, 0, ',', '.') }}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr style="background-color: orange; color:black">
                            <td class="text-center"><b>TOTAL</b></td>
                            <td class="text-center"><b>LO2</b></td>
                            <td class="text-right"></td>
                            <td class="text-right"><b>{{ number_format(($beliL01 + $beliL02 + $beliL03), 0, ',', '.') }}</b></td>
                            <td class="text-right"><b>{{ number_format(($hppL01 + $hppL02 + $hppL03), 0, ',', '.') }}</b></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
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