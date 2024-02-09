@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Penerimaan Piutang Toko</h4>
            </div>
            <div class="float-right">
                <!-- <a class="btn btn-danger" href=""><i class="fas fa-plus"></i> Potong Titipan</a> -->
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
        <div class="card-header">
            Penerimaan Piutang Toko
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. Pembayaran</th>
                            <th class="text-center">Tgl. Pemotongan</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Pembayaran Via</th>
                            <th class="text-center">Bank</th>
                            <th class="text-center">No. BG</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center">Tgl. Cetak</th>
                            <th class="text-center">Reff.</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        <tr>
                            <td class="text-left"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                            <td class="text-center"></td>
                            <td class="text-right"></td>
                            <td class="text-left"></td>
                            <td class="text-center"></td>
                            <td class="text-right"></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection