@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Monitoring Sales</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('monitoring.pesanan') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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

    <!-- ICHIDAI -->
    <div class="card" style="padding: 10px;">
        <div class="card-header">
            GROUP ICHIDAI
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
            <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Part No</th>
                            <th class="text-center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($getPesananIchidai->groupBy('part_no') as $i)
                        <tr>
                            <td class="text-center">{{ $i->first()->part_no }}</td>
                            <td class="text-center">{{ $i->sum('qty') }}</td>
                            
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ICHIDAI -->
    <div class="card" style="padding: 10px;">
        <div class="card-header">
            GROUP BRIO
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
            <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example3">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Part No</th>
                            <th class="text-center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($getPesananBrio->groupBy('part_no') as $i)
                        <tr>
                            <td class="text-center">{{ $i->first()->part_no }}</td>
                            <td class="text-center">{{ $i->sum('qty') }}</td>
                            
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- BRIO -->
    <div class="card" style="padding: 10px;">
        <div class="card-header">
            GROUP AIR AKI
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example4">
                        <thead>
                            <tr style="background-color: #6082B6; color:white">
                                <th class="text-center">Part No</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            
                            @foreach($getPesananAccu->groupBy('part_no') as $i)
                            <tr>
                                <td class="text-center">{{ $i->first()->part_no }}</td>
                                <td class="text-center">{{ $i->sum('qty') }}</td>
                                
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