@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Buat Sales Order/SO</b></h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('sales-order.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{ route('sales-order.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <strong>Pilih Sales</strong>
                                    <select name="customer_to" class="form-control mr-2">
                                        <option value="">-- Pilih Sales --</option>
                                        <option value="KCP01001">KCP01001</option>
                                        <option value="KCP02001">KCP02001</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <strong>Toko</strong>
                                    <select name="customer_to" class="form-control mr-2">
                                        <option value="">-- Pilih Toko --</option>
                                        <option value="KCP01001">KCP01001</option>
                                        <option value="KCP02001">KCP02001</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <strong>Keterangan</strong>
                                    <input type="text" name="supplier" class="form-control" placeholder="Isi Keterangan">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                            
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
        </div>

</div>
@endsection

@section('script')

@endsection