@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>List Back Order</h4>
             </div>
             <div class="float-right">
             <a class="btn btn-success" href="{{ route('back-order.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
             </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>  
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-warning" id="myAlert">
            <p>{{ $message }}</p>
        </div>  
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead style="background-color: #6082B6; color:white">
                        <tr>
                            <th class="text-center">No Back Order/BO</th>
                            <th class="text-center">No Sales Order/SO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($back_order as $i)
                        <tr>
                            <td class="text-left">{{ $i->nobo }}</td>
                            <td class="text-left">{{ $i->noso_out }}</td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-sm" href="{{ route('back-order.show', $i->nobo) }}"><i class="fas fa-list"></i></a>
                            </td>
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