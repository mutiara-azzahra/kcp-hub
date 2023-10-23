@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Edit Detail Sales Order</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('validasi-so.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-12 p-1">
                                <table class="table table-hover table-bordered table-sm bg-light table-striped" >
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Diskon (%)</th>
                                            <th class="text-center">Simpan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="text" name="part_no" class="form-control" value="{{ $details->part_no }}" readonly>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="number" name="qty" class="form-control" value="{{ $details->qty }}">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="number" name="disc" class="form-control" value="{{ $details->disc }}">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <a type="button" class="btn btn-success m-1" id="add"><i class="fas fa-check"></i></a>                                                                                  
                                                        </div>
                                                    </td>
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