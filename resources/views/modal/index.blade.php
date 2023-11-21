@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Modal DBP</h4>
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

    <div class="card" style="padding: 20px;">
        <div class="card-body p-2">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light" id="example1">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No.</th>
                            <th class="text-center">Part No</th>
                            <th class="text-center">Qty Pembelian</th>
                            <th class="text-center">Modal</th>
                            <th class="text-center">HET</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($getModal as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}.</td>
                            <td class="text-left">{{ $p->part_no }}</td>
                            <td class="text-right">{{ $p->qty }}</td>
                            <td class="text-right">{{ $p->total_amount/$p->qty }}</td>
                            <td class="text-right">{{ $p->harga }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection