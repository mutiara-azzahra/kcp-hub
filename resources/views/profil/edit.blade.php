@extends('welcome')

@section('content')
    <div class="container" style="padding: 20px;">
        <div class="row mt-2">
            <div class="col-lg-12 margin-tb mb-3">
                <div class="float-left">
                    <h4>Sunting Profil</h4>
                </div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('user.show', $user->id) }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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

        <div class="card" style="padding: 30px;">
            <form action="{{ route('user.update',$user->id) }}" method="POST">
                @csrf
        
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password Baru</strong>
                            <input type="password" id="password" name="password" class="form-control mb-2" placeholder="Isi password baru">
                            <input type="checkbox" onclick="myPassword()"> Tampilkan Password
                        </div>
                    </div> 

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="float-right">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Ubah Data</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    
        
    </div>
@endsection