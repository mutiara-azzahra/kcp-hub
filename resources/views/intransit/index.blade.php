@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Intransit</h4>
            </div>
            <!-- yg salah -->
            <div class="float-right p-1">
                <a class="btn btn-success" href="{{ route('intransit.create') }}"><i class="fas fa-plus"></i> Entry Intransit</a>
            </div>

            <div class="float-right p-1">
                <a class="btn btn-info" href="{{ route('intransit.create') }}"><i class="fas fa-plus"></i> Entry Intransit</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" id="myAlert">
                    <p>{{ $message }}</p>
                </div>
            @elseif ($message = Session::get('danger'))
                <div class="alert alert-warning" id="myAlert">
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
                                    <th class="text-center">No. SP</th>
                                    <th class="text-center">Tanggal Packingsheet</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Validasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp

                                @foreach($intransit_header as $p)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-clear">{{ $p->no_surat_pesanan }}</td>
                                    <td class="text-center">{{ $p->tanggal_packingsheet }}</td>

                                    @if($p->status == 'I')
                                    <td style="background-color: yellow" class="text-center">Diproses</td>

                                    @elseif($p->status == 'T')
                                    <td style="background-color: lime" class="text-center">Diterima</td>

                                    @endif

                                    <td class="text-center">
                                        @if(count($p->details) > 0)
                                            @if(isset($p->details[0]->details))
                                
                                            @else
                                                <a class="btn btn-info btn-sm" href="{{ route('intransit.tambah-gudang', $p->id) }}">
                                                    <i class="fa fa-list"></i>
                                                </a>
                                            @endif

                                        @else
                                            <a class="btn btn-success btn-sm" href="{{ route('intransit.details', $p->id) }}">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        @endif
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