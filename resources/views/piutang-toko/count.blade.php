@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Pembayaran Piutang Toko</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('piutang-toko.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('warning'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('piutang-toko.store-tanda-terima')}}" method="POST">
    @csrf
        <div class="card" style="padding: 10px;">
            <div class="card-header">
                Saran Pemotongan :
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Nominal Diterima Kasir</strong>
                                <input type="text" name="nominal_kasir" class="form-control" value="{{ number_format($nominal_diterima->nominal, 0, ',', ',') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Nominal</strong>
                                <input type="text" name="nominal" id="nominal" class="form-control" placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: 10px;">
            <div class="card-body">
                <div class="col-lg-12">
                    <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                        <thead>
                            <tr style="background-color: #6082B6; color:white">
                                <th></th>
                                <th class="text-center">No. Invoice</th>
                                <th class="text-center">Kode Toko</th>
                                <th class="text-center">Nama Toko</th>
                                <th class="text-center">Nominal Invoice</th>
                                <th class="text-center">Tanggal Invoice</th>
                                <th class="text-center">Tanggal Jatuh Tempo</th>
                            </tr>
                        </thead>
                        <tbody class="input-fields">
                            @php
                            $no=1;
                            @endphp
                            @foreach($invoice_toko as $s)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="selected_items[]" value="{{ $s->noinv }}">
                                        <input type="hidden" name="no_kas_masuk" value="{{ $no_kas_masuk }}">
                                    </div>
                                </td>
                                <td class="text-left">{{ $s->noinv }}</td>
                                <td class="text-center">{{ $s->kd_outlet }}</td>
                                <td class="text-left">{{ $s->nm_outlet }}</td>
                                <td class="text-right">{{ number_format($s->details_invoice->sum('nominal_total'), 0, ',', ',') }}</td>
                                <td class="text-center">{{ Carbon\Carbon::parse($s->created_at)->format('d-m-Y') }}</td>
                                <td class="text-center" style="background-color: yellow; color:black">{{ Carbon\Carbon::parse($s->tgl_jatuh_tempo)->format('d-m-Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="float-left">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Pilih</button>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('script')


<script>

    document.querySelectorAll('input[name="selected_items[]"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            updateNominalValue();
        })
    })

    function updateNominalValue() {
    var total = 0;

    document.querySelectorAll('input[name="selected_items[]"]').forEach(function(checkbox) {
        if (checkbox.checked) {
            var row = checkbox.closest('tr');
            var value = parseFloat(row.querySelector('.text-right').textContent.replace(/[^0-9.-]+/g, ''));
            total += value;
        }
    })

    var formattedTotal = total.toLocaleString('en-US');

    document.getElementById('nominal').value = formattedTotal
}


//INPUT SEPARATOR JS
    function formatNumberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    document.getElementById('nominal').addEventListener('input', function() {
     
        let valueWithoutCommas = this.value.replace(/,/g, '');
        let formattedValue = formatNumberWithCommas(valueWithoutCommas);
        
        this.value = formattedValue;
    });

</script>

@endsection