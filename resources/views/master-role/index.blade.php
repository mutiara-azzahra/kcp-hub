@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Master Role</b></h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('master-role.create') }}"><i class="fas fa-plus"></i> Tambah Role</a>
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
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp

                                @foreach($master_role as $p)
                                <tr>
                                    <td class="text-center">{{ $no++ }}.</td>
                                    <td class="text-left">{{ $p->role }}</td>
                                    <td class="text-center">                                        
                                        <a class="btn btn-info btn-sm" href="{{ route('master-role.edit',$p->id) }}"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-warning btn-sm" href="{{ route('master-role.delete',$p->id) }}"><i class="fas fa-times-circle"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</div>
@endsection

@section('script')

@endsection