@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Reset Validasi Sales Order</b></h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('invoice.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
            @endif

            <div class="card" style="padding: 10px;">
                <div class="card-header">
                    <div class="col-lg-12">
                        <b>Validasi Sales Order/SO</b>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">  
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Area SO</th>
                                    <th class="text-center">No Sales Order</th>
                                    <th class="text-center">Kode Toko</th>
                                    <th class="text-center">Nama Toko</th>
                                    <th class="text-center">Tgl. SO</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    {{-- <td class="text-left" style="background-color: yellow;">Rp. {{ number_format(, 0, ',', '.')  }}</td> --}}
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="{{ route('validasi-so.reset-print') }}"><i class="fas fa-print"></i></a>
                                        <a class="btn btn-success btn-sm" href="{{ route('validasi-so.reset-validasi') }}"><i class="fas fa-refresh"></i></a>
                                    </td>
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