@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-3">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Details Retur</h4>
            </div>
            <div class="float-right">
                <a class="btn m-1 btn-success" href="{{ route('retur.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="float-right">
                <a class="btn m-1 btn-warning" href=""><i class="fas fa-check"></i> Approve</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-danger" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" >
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 p-1">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-left">No. Retur</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $header->no_retur }}</b></td>
                        </tr>
                        <tr>
                            <th class="text-left">Kode / Nama Toko</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $header->kd_outlet }} / {{ $header->nm_outlet }}</b></td>
                        </tr>
                    </table>
                </div>

                @if(isset($check))
                    <div class="col-lg-12 p-1">
                        <table class="table table-hover table-bordered table-sm bg-light" id="example2">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Part No</th>
                                    <th class="text-center">Qty Invoice</th>
                                    <th class="text-center">Qty Retur</th>
                                    <th class="text-center">Nominal</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="input-fields">
                                @foreach($header->details as $d)
                                <tr>
                                    <td class="text-left">{{ $d->part_no }}</td>
                                    <td class="text-right">{{ number_format($d->qty_invoice, 0, ',', ',') }}</td>
                                    <td class="text-right">{{ number_format($d->qty_retur, 0, ',', ',') }}</td>
                                    <td class="text-right">{{ number_format($d->nominal_retur, 0, ',', ',') }}</td>
                                    <td class="text-left">{{ $d->keterangan }}</td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="3" class="text-center"><b>TOTAL</b></td>
                                    <td class="text-right"><b>{{ number_format($header->details->sum('nominal_retur'), 0, ',', ',') }}</b></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                @else
                <div class="col-lg-12 p-1" id="main" data-loading="true">
                    <form action="{{ route('retur.store-details')}}" method="POST">
                        @csrf

                        <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Part No</th>
                                    <th class="text-center">Qty Invoice</th>
                                    <th class="text-center">Qty Retur</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="input-fields">
                                <tr>
                                    {{-- part_no inv --}}
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <select name="inputs[0][part_no]" class="form-control mr-2 my-select" id="package-default" onchange="updateData(`default`)">
                                                <option value="">-- Pilih --</option>
                                                @foreach($invoice_details as $k)
                                                    <option value="{{ $k->part_no }}" data-qty="{{ $k->qty }}"> {{ $k->part_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    {{-- qty-invoice --}}
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="number" name="inputs[0][qty_invoice]" id="qty-default" class="form-control" readonly>
                                        </div>
                                    </td>
                                    {{-- qty-retur --}}
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="hidden" name="inputs[0][no_retur]" value="{{ $header->no_retur }}">
                                            <input type="hidden" name="inputs[0][noinv]" value="{{ $header->noinv }}">
                                            <input type="text" name="inputs[0][qty_retur]" class="form-control" placeholder="0">
                                        </div>
                                    </td>
                                    {{-- keterangan --}}
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" name="inputs[0][keterangan]" class="form-control" placeholder="Isi keterangan">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <a type="button" class="btn btn-primary m-1" id="add"><i class="fas fa-plus"></i></a>                                                                                  
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan Data</button>                           
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    var i = 0;
    $('#add').click(function(){
        ++i;
        $('#table').append(`<tr>
            <td class="text-center">
                <div class="form-group col-12">
                    <select name="inputs[${i}][part_no]" class="form-control mr-2 my-select-1" id="package-${i}" onchange="updateData(${i})">
                        <option value="">-- Pilih --</option>
                        @foreach($invoice_details as $k)
                            <option value="{{ $k->part_no }}" data-qty="{{ $k->qty }}"> {{ $k->part_no }} </option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td class="text-center">
                <div class="form-group col-12">
                    <input type="number" name="inputs[${i}][qty_invoice]" id="qty-${i}" class="form-control" readonly>
                </div>
            </td>
            <td class="text-center">
                <div class="form-group col-12">
                    <input type="hidden" name="inputs[${i}][no_retur]" value="{{ $header->no_retur }}">
                    <input type="hidden" name="inputs[${i}][noinv]" value="{{ $header->noinv }}">
                    <input type="text" name="inputs[${i}][qty_retur]" class="form-control" placeholder="0">
                </div>
            </td>
            <td class="text-center">
                <div class="form-group col-12">
                    <input type="text" name="inputs[${i}][keterangan]" class="form-control" placeholder="Isi keterangan">
                </div>
            </td>

            <td class="text-center">
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-danger remove-table-row"><i class="fas fa-minus"></i></button>
                </div>
            </td>
        </tr>
        `);
        $('.my-select-1').select2({
            width: '100%'
        });
    });

    $(document).on('click','.remove-table-row', function(){
        $(this).parents('tr').remove();
    })

    //HET MUNCUL
    const data = $('#main').data('loading');

    function updateData(i){
        const qty = $(`#package-${i} option:selected`).data('qty');

        const formattedQty = Number(qty).toLocaleString('id-ID');

        $(`#qty-${i}`).val(formattedQty);
    }


    Approve = (id)=>{
        Swal.fire({
            title: 'Approve data retur ini?',
            text:  "Data tidak dapat kembali" ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6' ,
            cancelButtonColor: 'red' ,
            confirmButtonText: 'Approve' ,
            cancelButtonText: 'Batal' ,
            reverseButtons: false
            }).then((result) => {
                if (result.value) {
                    document.getElementById('approve_' + id).submit();
                }
        })
    }

</script>
@endsection
