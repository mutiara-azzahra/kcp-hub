@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Tambah Inventaris</b></h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('inventaris.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" id="myAlert">
                    <p>{{ $message }}</p>
                </div>

            @endif

            <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Role</strong><br>
                                    {{ $master_role_id->role }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>
@endsection

@section('script')

@endsection