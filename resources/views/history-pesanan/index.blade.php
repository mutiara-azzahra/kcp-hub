@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>History Pesanan</h4>
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
            List History Pesanan
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">No. Surat Pesanan</th>
                            <th class="text-center">No. Back Order</th>
                            <th class="text-center">Tgl. Sales Order</th>
                            <th class="text-center">No. Sales Order</th>
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">No. Packingsheet</th>
                            <th class="text-center">Tgl. LKH</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($surat_pesanan as $p)
                        <tr>
                            <td class="text-center">{{ $p->kd_outlet }}</td>
                            <td class="text-left">{{ $p->nm_outlet }}</td>
                            <td class="text-left">{{ $p->nosp }}</td>
                            <td class="text-center">-</td>

                            @if(isset($p->so->crea_date))
                            <td class="text-left">{{ $p->so->crea_date }}</td>
                            @else
                            <td class="text-center">-</td>
                            @endif

                            @if(isset($p->so->noso))
                            <td class="text-left">{{ $p->so->noso }}</td>
                            @else
                            <td class="text-center">-</td>
                            @endif

                            @if(isset($p->so->invoice->noinv))
                            <td class="text-left">{{ $p->so->invoice->noinv }}</td>
                            @else
                            <td class="text-center">-</td>
                            @endif

                            @if(isset($p->so->ps->nops))
                            <td class="text-left">{{ $p->so->ps->nops }}</td>
                            @else
                            <td class="text-center">-</td>
                            @endif

                            @if(isset($p->so->ps->date_lkh))
                            <td class="text-left">{{ $p->so->ps->date_lkh }}</td>
                            @else
                            <td class="text-center">-</td>
                            @endif

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