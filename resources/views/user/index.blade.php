@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb pb-3">
             <div class="float-left">
                <h4>Master User</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('user.create') }}"><i class="fas fa-plus"></i> Tambah User</a>
            </div>
        </div>
    </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Maaf!</strong> Ada yang salah
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            @if($message = Session::get('success'))
                <div class="alert alert-success" id="myAlert">
                    <p>{{ $message }}</p>
                </div>  
            @endif

        <div class="card" style="padding:10px;">
            <div class="card-body">
                <div class="col">
                    <div class="col-lg-12">
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Reset Password</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                $no=1;
                                @endphp     
                                
                                @foreach($user as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->nama_user }}</td>
                                    <td>{{ $p->username }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning btn-sm" href="{{ route('user.reset', $p->id) }}">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                
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