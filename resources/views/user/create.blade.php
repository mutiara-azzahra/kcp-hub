@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 margin-tb pb-3">
             <div class="float-left">
                <h4><b>Tambah User Baru</b></h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('user.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>

        </div>
    </div>
        @if ($errors->any())
            <div class="alert alert-danger" id="myAlert">
                <strong>Maaf!</strong> Ada yang salah
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card" style="padding: 30px;">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
            
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nama</strong>
                            <input type="text" name="nama_user" class="form-control" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role</strong>
                            <select name="id_role" class="form-control mr-2">
                                <option value="">-- Pilih Role --</option>
                                @foreach($role as $s)
                                    <option value="{{ $s->id }}">{{ $s->role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Username</strong>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email</strong>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password</strong>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                            <input type="checkbox" onclick="myPassword()"> Tampilkan Password
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
@endsection

@section('script')


@endsection