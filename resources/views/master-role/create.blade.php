@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Tambah Master Role</b></h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('master-role.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <form action="{{ route('master-role.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Role</strong>
                                    <input type="text" name="role" class="form-control" placeholder="Tambahkan Role">
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