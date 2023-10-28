@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <a class="btn btn-success" href="{{ route('intransit.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" id="myAlert">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card" style="padding: 10px;">
            <div class="card-header">
                Memasukkan Intransit ke Gudang
            </div>
                <div class="card-body">
                    <div class="row">
                            <div class="col-lg-12 p-3">
                                @foreach($intransit_details as $i)
                                
                                <form action="{{ route('intransit.store_stok_gudang', ['part_no' => $i->part_no]) }}" method="POST">
                                @csrf
                                @endforeach

                                    <table class="table table-hover table-sm bg-light table-bordered table-striped" id="table">
                                        <thead>

                                            <tr style="background-color: #6082B6; color:white">
                                                <th></th>
                                                <th class="text-center">No. SP</th>
                                                <th class="text-center">No. Packingsheet</th>
                                                <th class="text-center">No. Doos</th>
                                                <th class="text-center">Part No</th>
                                                <th class="text-center">Qty</th>
                                            </tr>
                                        </thead>
                                            <tbody class="input-fields">
                                                @foreach($intransit_details as $i)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="selected_items[]" value="{{ $i->part_no }}">
                                                            <input type="hidden" name="no_surat_pesanan[]" value="{{ $i->no_surat_pesanan }}">
                                                            <input type="hidden" name="no_packingsheet[]" value="{{ $i->no_packingsheet }}">
                                                            <input type="hidden" name="no_doos[]" value="{{ $i->no_doos }}">
                                                        </div>
                                                    </td>
                                                    <td class="text-left">{{ $i->no_surat_pesanan }}</td>
                                                    <td class="text-left">{{ $i->no_packingsheet }}</td>
                                                    <td class="text-left">{{ $i->no_doos }}</td>
                                                    <td class="text-left">{{ $i->part_no }}</td>
                                                    <td class="text-center">{{ $i->qty }}</td>
                                                </tr>

                                                @endforeach
                                            </tbody>
                                    </table>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <div class="float-left">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                            
                                        </div>
                                    </div>
                                </form>                       
                    </div>
                </div>
        </div>

</div>
@endsection

@section('script')


@endsection