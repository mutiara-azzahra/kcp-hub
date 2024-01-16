@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Balancing Nota dan Pembayaran</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('pembayaran-non-aop.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if($nota === null)
    <div class="card" style="padding: 10px;">
        <div class="card-header">
            No. Invoice : <b>{{ $header->invoice_non }}</b>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{ route('pembayaran-non-aop.pembayaran-store-balance', $header->invoice_non )}}" method="POST">
                    @csrf
                    <table class="table table-hover table-bordered table-sm bg-light" id="table">
                        <thead>
                            <tr style="background-color: #6082B6; color:white">
                                <th class="text-center">Part No</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Disc (%)</th>
                                <th class="text-center">Total Amt.</th>
                                <th class="text-center" style="width: 100px;">+/-</th>
                                <th class="text-center">Amt. Nota</th>
                                <th class="text-center">Final</th>
                            </tr>
                        </thead>
                        <tbody class="input-fields">

                        @php
                        $i = 0;
                        @endphp

                        @foreach($nota_details as $t)
                        <tr>
                            <td>
                                <div class="form-group col-12">
                                    <input type="hidden" name="invoice_non[]" value="{{ $header->invoice_non }}">
                                    <input type="text" name="part_no[]" class="form-control" value="{{ $t->part_no }}" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group col-12">
                                    <input type="number" name="qty[]" class="form-control" value="{{ number_format($t->qty, 0, ',', '.') }}" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group col-12">
                                    <input type="number" name="diskon_nominal[]" class="form-control" value="{{ $t->diskon_nominal }}" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group col-12">
                                    <input type="text" name="total_amount[]" class="form-control"id="amount-{{ $i }}" value="{{ $t->total_amount }}" data-amount="{{ $t->total_amount }}" onkeyup="updateNominal('{{ $i }}')" readonly>
                                </div>
                            </td>
                            
                            <td>
                                <div class="form-group col-12">
                                    <input type="text" name="sign[]" onkeyup="updateNominal('{{ $i }}')" class="form-control" placeholder="+/-" id="sign-{{ $i }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group col-12">
                                    <input type="text" name="balance[]" onkeyup="updateNominal('{{ $i }}')" class="form-control" placeholder="0" id="balance-{{ $i }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group col-12">
                                    <input type="text" name="amount_nota[]" id="nominal-{{ $i }}" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        @php
                        $i++;
                        @endphp

                        @endforeach
                        <!-- <tr>
                            <td colspan="6" class="text-center"><b>TOTAL</b></td>
                            <td>
                                <div class="form-group col-12">
                                    <input type="text" id="totalNominal" class="form-control" readonly>
                                </div>
                            </td>
                        </tr> -->
                        </tbody>
                    </table>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="float-right">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan Data</button>                           
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @else

    <div class="card" style="padding: 10px;">
        <div class="card-header">
            No. Invoice : <b>{{ $header->invoice_non }}</b>
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Part No</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Disc (%)</th>
                            <th class="text-center">Amt. Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($header->details_nota as $s)
                        <tr>
                            <td class="text-left">{{ $s->part_no }}</td>
                            <td class="text-right">{{ $s->qty }}</td>
                            <td class="text-right">{{ $s->diskon_nominal }}</td>
                            <td class="text-right">{{ number_format($s->amount_nota, 2, '.', ',') }}</td>
                        </tr>
                        @endforeach

                        <tr style="background-color: #6082B6; color:white">
                            <td class="text-center" colspan="3"><b>TOTAL</b></td>
                            <td class="text-right"><b>Rp. {{ number_format($header->details_nota->sum('amount_nota'), 2, ',', '.') }}</b></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    @endif
</div>
@endsection

@section('script')

<script>

    function updateNominal(i) {
        const amount  = parseFloat($('#amount-' + i).data('amount'));
        const sign    = $('#sign-' + i).val();
        const balance = parseFloat($('#balance-' + i).val());

        let nominal = 0;

        if (sign === '+') {
            nominal = amount + balance;
        } else if (sign === '-') {
            nominal = amount - balance;
        } else {
            console.error('Invalid sign');
            return;
        }

        const formattedNominal = Number(nominal).toLocaleString('id-ID');
        $('#nominal-' + i).val(formattedNominal);

        let totalNominal = 0;

        $('[id^=nominal-]').each(function () {
            const value         = $(this).val().replace(/,/g, '');
            const parsedValue   = parseFloat(value.replace(/\./g, '').replace(/,/g, '.'));
            if (!isNaN(parsedValue)) {
                totalNominal += parsedValue;
            }

            const totalDisplay = (Math.round(totalNominal)/100).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            $('#totalNominal').val(totalDisplay);
        });

        

    }

</script>


@endsection