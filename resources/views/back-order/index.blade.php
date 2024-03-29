@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Back Order / BO</h4>
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
                            <th class="text-center">No. BO</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">No. SO Out</th>
                            <th class="text-center">No. SO In</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($back_order as $i)
                        <tr>
                            <td class="text-center">{{ $i->nobo }}</td>
                            <td class="text-center">{{ $i->kd_outlet }}</td>
                            <td class="text-left">{{ $i->nm_outlet }}</td>
                            <td class="text-left">{{ $i->noso_out }}</td>
                            <td class="text-left">{{ $i->noso_in }}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('back-order.show', $i->nobo) }}"><i class="fas fa-eye"></i></a>
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