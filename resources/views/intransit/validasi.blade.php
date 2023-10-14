@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">

            @if(Auth::user()->id_role == 10)
                @if($intransit_header->status == 'I')
                <div class="float-right">
                    <a class="btn btn-warning" href="{{ route('intransit.validasi_barang', $intransit_header->id) }}"><i class="fas fa-check"></i>  Validasi</a>
                </div>

                @endif
            @endif
            <div class="float-left">
                <a class="btn btn-success" href="{{ route('intransit.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card" style="padding: 10px;">
            <div class="card-header">
                <b>Validasi Intransit</b>
            </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 p-3">
                            <table class="table table-hover bg-light table-striped table-bordered">
                                <thead>
                                    <tr style="background-color: #6082B6; color:white">
                                        <th class="text-center">No. SP</th>
                                        <th class="text-center">Tgl. Packingsheet</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $intransit_header->no_surat_pesanan }}</td>
                                        <td class="text-center">{{ $intransit_header->tanggal_packingsheet }}</td>

                                        @if($intransit_header->status == 'I')
                                        <td style="background-color: yellow" class="text-center">Menunggu Diterima</td>

                                        @elseif($intransit_header->status == 'T')
                                        <td style="background-color: lime" class="text-center">Diterima</td>

                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <div class="col-lg-12 p-3">

                                <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                        
                                            <th class="text-center">No. Packingsheet</th>
                                            <th class="text-center">No. Doos</th>
                                            <th class="text-center">Part No</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Harga/Pcs</th>
                                        </tr>
                                    </thead>
                                        <tbody class="input-fields">
                                            @foreach($intransit_header->details as $i)
                                            <tr>
                                                <td class="text-left">{{ $i->no_packingsheet }}</td>
                                                <td class="text-left">{{ $i->no_doos }}</td>
                                                <td class="text-left">{{ $i->part_no }}</td>
                                                <td class="text-center">{{ $i->qty }}</td>
                                                <td class="text-left">Rp. {{ number_format($i->harga_pcs, 0, ',', '.') }}</td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </form>
                    </div>
                </div>
        </div>

</div>
@endsection

@section('script')

@endsection