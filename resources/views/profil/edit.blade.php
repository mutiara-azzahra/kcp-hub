@extends('welcome')

@section('content')
    <div class="container" style="padding: 20px;">
        <div class="row mt-2">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h4>Sunting Profil</h4>
                </div>
                <div class="float-right">
                    <a class="btn btn-secondary" href="{{ route('profil.show', $user->id_user) }}"> Kembali</a>
                </div>
            </div>
        </div>
    
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Maaf!</strong> Ada yang salah.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('user.edit',$user->id) }}" method="POST">
            @csrf
            @method('PUT')
     
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Kata Sandi Baru</strong>
                        <input type="password" name="password" class="form-control" placeholder="" value="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary"> Ubah</button>
                </div>
            </div>
        </form>
    </div>
@endsection