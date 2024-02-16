@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-3">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Surat Pesanan / SP by Sales</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('surat-pesanan.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                            <th class="text-left">No. Surat Pesanan / SP</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $nosp }}</b></td>
                        </tr>
                        <tr>
                            <th class="text-left">Kode / Nama Toko</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $details->kd_outlet }} / {{ $details->nm_outlet }}</b></td>
                        </tr>
                        <tr>
                            <th class="text-left">Plafond Toko</th>
                            <td>:</td>

                            @if($details->outlet->plafond != null)
                            <td class="text-left">Rp. {{ number_format($details->outlet->plafond->nominal_plafond, 0, ',', '.') }}</td>
                            @else
                            <td class="text-left" style="color: red;">Belum Ada Plafond</td>
                            @endif
                        </tr>
                        <tr>
                            <th class="text-left">Piutang Terakhir</th>
                            <td>:</td>
                            <td class="text-left">
                                <a class="btn btn-info btn-sm" href=""><i class="fas fa-eye"></i> Piutang Terakhir</a>
                            </td>
                        </tr>
                    </table>
                </div>
                
                @if($check === null)
                <div class="col-lg-12 p-1" id="main" data-loading="true">
                    <form action="{{ route('surat-pesanan.store_details')}}" method="POST">
                        @csrf
                        <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Part No | Nama Part</th>
                                    <th class="text-center">HET</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Disc (%)</th>
                                    <th class="text-center">Nominal</th>
                                    <th class="text-center">Tambah</th>
                                </tr>
                            </thead>
                            @if($details->user_sales == 'nursehan')
                            <tbody class="input-fields">
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <select name="inputs[0][part_no]" class="form-control mr-2 my-select" id="package-default" onchange="updateData(`default`)">
                                                <option value="">-- Pilih --</option>
                                                @foreach($part_kanvasan as $k)
                                                    <option value="{{ $k->part_no }}" data-het="{{ $k->part_rak->het }}">{{ $k->part_no }} | {{ $k->part_rak->part_nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" name="het" for="het" id="het-default" class="form-control" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="hidden" name="inputs[0][nosp]" value="{{ $nosp }}">
                                            <input type="text" id="qty-default" name="inputs[0][qty]" class="form-control" placeholder="0" onkeyup="updateNominal(`default`)">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" id="disc-default" name="inputs[0][disc]" class="form-control" placeholder="0" onkeyup="updateNominal(`default`)">
                                        </div>
                                    </td>
                                    <td class="text-center" id="nominal">
                                        <div class="form-group col-12">
                                            <input type="text" id="nominal-default" name="nominal" for="nominal" class="form-control" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <a type="button" class="btn btn-primary m-1" id="add"><i class="fas fa-plus"></i></a>                                                                                  
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @else
                            <tbody class="input-fields">
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <select name="inputs[0][part_no]" class="form-control mr-2 my-select" id="package-default" onchange="updateData(`default`)">
                                                <option value="">-- Pilih --</option>
                                                @foreach($master_part as $k)
                                                    <option value="{{ $k->part_no }}" data-het="{{ $k->het }}"> {{ $k->part_no }} | {{ $k->part_nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" name="het" for="het" id="het-default" class="form-control" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="hidden" name="inputs[0][nosp]" value="{{ $nosp }}">
                                            <input type="text" id="qty-default" name="inputs[0][qty]" class="form-control" placeholder="0" onkeyup="updateNominal(`default`)">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" id="disc-default" name="inputs[0][disc]" class="form-control" placeholder="0" onkeyup="updateNominal(`default`)">
                                        </div>
                                    </td>
                                    <td class="text-center" id="nominal">
                                        <div class="form-group col-12">
                                            <input type="text" id="nominal-default" name="nominal" for="nominal" class="form-control" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <a type="button" class="btn btn-primary m-1" id="add"><i class="fas fa-plus"></i></a>                                                                                  
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                            @endif
                            </table>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                           
                                </div>
                            </div>
                        </div>
                    </form>

                @else

                <div class="col-lg-12 p-1">
                    <table class="table table-hover table-bordered table-sm bg-light table-striped" id="table">
                        <thead>
                            <tr style="background-color: #6082B6; color:white">
                                <th class="text-center">Part No</th>
                                <th class="text-center">HET</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Nominal Diskon</th>
                                <th class="text-center">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="input-fields">
                            @foreach($details->details_sp as $d)
                            <tr>
                                <td class="text-left">{{ $d->part_no }}</td>
                                <td class="text-left">Rp. {{ number_format($d->hrg_pcs, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $d->qty }}</td>
                                <td class="text-center">{{ $d->disc }}%</td>
                                <td class="text-right">Rp. {{ number_format($d->nominal_total, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                                
                        </tbody>
                    </table>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    @if($details->user_sales == 'nursehan')

    <script>
        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(`<tr>
                <td class="text-center">
                    <div class="form-group col-12">
                        <select name="inputs[${i}][part_no]" class="form-control mr-2 my-select-1" id="package-${i}" onchange="updateData(${i})">
                            <option value="">-- Pilih --</option>
                            @foreach($part_kanvasan as $k)
                                <option value="{{ $k->part_no }}" data-het="{{ $k->part_rak->het }}">{{ $k->part_no }} | {{ $k->part_rak->part_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group col-12">
                        <input type="text" id="het-${i}" name="het" for="het" class="form-control" readonly>
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group col-12">
                        <input type="hidden" name="inputs[${i}][nosp]" value="{{ $nosp }}">
                        <input type="text" id="qty-${i}" name="inputs[${i}][qty]" class="form-control" placeholder="0" onkeyup="updateNominal(${i})">
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group col-12">
                        <input type="text" id="disc-${i}" name="inputs[${i}][disc]" class="form-control" placeholder="0" onkeyup="updateNominal(${i})">
                    </div>
                </td>
                <td class="text-center" id="nominal">
                    <div class="form-group col-12">
                        <input type="text" name="nominal" id="nominal-${i}" for="nominal" class="form-control" readonly>
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
        const het = $(`#package-${i} option:selected`).data('het');

        const formattedHet = Number(het).toLocaleString('id-ID');

        $(`#het-${i}`).val(formattedHet);
    }

    function updateNominal(i){
        const het = $(`#package-${i} option:selected`).data('het');
        const qty = Number($(`#qty-${i}`).val());
        const disc = Number($(`#disc-${i}`).val());
        const nominal = (het *qty ) - (het *qty * disc/100);

        const formattedNominal = Number(nominal).toLocaleString('id-ID');

        $(`#nominal-${i}`).val(formattedNominal);

    }

    </script>   

    @else

    <script>
        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(`<tr>
                <td class="text-center">
                    <div class="form-group col-12">
                        <select name="inputs[${i}][part_no]" class="form-control mr-2 my-select-1" id="package-${i}" onchange="updateData(${i})">
                            <option value="">-- Pilih --</option>
                            @foreach($master_part as $k)
                                <option value="{{ $k->part_no }}" data-het="{{ $k->het }}"> {{ $k->part_no }} | {{ $k->part_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group col-12">
                        <input type="text" id="het-${i}" name="het" for="het" class="form-control" readonly>
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group col-12">
                        <input type="hidden" name="inputs[${i}][nosp]" value="{{ $nosp }}">
                        <input type="text" id="qty-${i}" name="inputs[${i}][qty]" class="form-control" placeholder="0" onkeyup="updateNominal(${i})">
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group col-12">
                        <input type="text" id="disc-${i}" name="inputs[${i}][disc]" class="form-control" placeholder="0" onkeyup="updateNominal(${i})">
                    </div>
                </td>
                <td class="text-center" id="nominal">
                    <div class="form-group col-12">
                        <input type="text" name="nominal" id="nominal-${i}" for="nominal" class="form-control" readonly>
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
        const het = $(`#package-${i} option:selected`).data('het');

        const formattedHet = Number(het).toLocaleString('id-ID');

        $(`#het-${i}`).val(formattedHet);
    }

    function updateNominal(i){
        const het = $(`#package-${i} option:selected`).data('het');
        const qty = Number($(`#qty-${i}`).val());
        const disc = Number($(`#disc-${i}`).val());
        const nominal = (het *qty ) - (het *qty * disc/100);

        const formattedNominal = Number(nominal).toLocaleString('id-ID');

        $(`#nominal-${i}`).val(formattedNominal);

    }

    </script>  

    @endif
     

@endsection
