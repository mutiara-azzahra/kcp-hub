@extends('welcome')

@section('content')
<div class="container" style="padding: 20px; padding-bottom: 30px;">
    <div class="row mt-2">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="float-left">
                <h4>Lihat/Edit Profil</h4>
            </div>
            
            <div class="float-right p-1">
                <a class="btn btn-success" href="{{route('dashboard')}}"><i class="fas fa-arrow-left"></i>  Kembali</a>
            </div>
            <div class="float-right p-1">
                <a class="btn btn-warning" href="{{route('user.edit', $user->id)}}"><i class="fas fa-refresh"></i>  Ubah Password</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success" id="myAlert">
                <p>{{ $message }}</p>
            </div>
            @elseif ($message = Session::get('danger'))
            <div class="alert alert-warning" id="myAlert">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="card" style="padding: 30px;">
                <div class="row">
                    <div class="col-3">
                      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Profil Saya</a>
                        <!-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Ubah Password</a> -->
                      </div>
                    </div>
                    <div class="col-9">
                      <div class="tab-content" style="padding-left: 10px;" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nama</strong><br>
                                        {{ $user->nama_user }}<br>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email</strong><br>
                                        {{ $user->email }}<br>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Username</strong><br>
                                        {{ $user->username }}<br>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        
                      </div>
                    </div>
                  </div>
            </div>        
        </div>        
    </div>
</div>
@endsection