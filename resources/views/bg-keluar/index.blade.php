@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-2">
             <div class="float-left">
                <h4>BG Keluar</h4>
            </div>
        </div>
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('bg-keluar.create') }}"><i class="fas fa-plus"></i> Tambah BG Keluar</a>
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
        <div class="card-header">
            BG Keluar
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. BG</th>
                            <th class="text-center">Nominal BG</th>
                            <th class="text-center">Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $no=1;
                    @endphp

                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="card" style="padding: 10px;">
        <div class="card-header">
            Details BG Keluar
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 p-1">
                    <form action=""  method="GET">
                        <!-- @csrf -->
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" id="" class="form-control" placeholder="">
                            </div>

                            <div class="form-group col-6">
                                <label for="">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" id="" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <div class="float-right pt-3">
                                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Cari</button>                            
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12 p-1">  
                    <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example3">
                        <thead>
                            <tr style="background-color: #6082B6; color:white">
                                <th class="text-center">ID. BG</th>
                                <th class="text-center">Tgl. Buat</th>
                                <th class="text-center">Tgl. Balik</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Nominal</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $no=1;
                        @endphp

                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
function printAndRefresh(url){
    window.open(url, '_blank');
    
    window.location.reload();
}

</script>

@endsection