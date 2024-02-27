@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Transfer dan Kas Masuk</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success m-1" href="{{ route('transfer-masuk.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
            <div class="col-lg-8 p-1">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-left">No. Transfer</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $transfer->id_transfer }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Transfer Via</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $transfer->bank }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Keterangan</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $transfer->keterangan }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Nominal</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ number_format($transfer->details->where('akuntansi_to', 'D')->sum('total'), 0, ',', ',') }}</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    

</div>
@endsection

@section('script')

@endsection