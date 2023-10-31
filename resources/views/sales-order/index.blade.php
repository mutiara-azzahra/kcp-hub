@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Sales Order / SO</h4>
            </div>
            {{-- <div class="float-right">
                <a class="btn btn-success m-1" href="{{ route('sales-order.approved') }}">List SO Approved</a>
            </div>
            <div class="float-right">
                <a class="btn btn-warning m-1" href="{{ route('sales-order.rejected') }}">List SO Rejected</a>
            </div> --}}
            {{-- <div class="float-right">
                <a class="btn btn-primary m-1" href="{{ route('sales-order.create') }}"><i class="fas fa-plus"></i> SO Baru</a>
            </div> --}}
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" id="myAlert">
                    <p>{{ $message }}</p>
                </div>  
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">  
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">No Sales Order</th>
                                    <th class="text-center" style="width: 15px;">Kode Toko</th>
                                    <th class="text-center">Nama Toko</th>
                                    <th class="text-center">Nominal SP</th>
                                    <th class="text-center">Nominal Plafond</th>
                                    <th class="text-center">Sales</th>
                                    <th class="text-center" style="width: 50px;">Approve SPV</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp

                                @foreach($surat_pesanan as $s)
                                <tr>
                                    <td class="text-left">{{ $s->noso }}</td>
                                    <td class="text-center">{{ $s->kd_outlet }}</td>
                                    <td class="text-left">{{ $s->nm_outlet }}</td>
                                    <td class="text-left">Rp. {{ number_format($s->details_sp->sum('nominal_total'), 0, ',', '.') }}</td>

                                    @if($s->outlet->plafond != null)
                                    <td class="text-left">Rp. {{ number_format($s->outlet->plafond->nominal_plafond, 0, ',', '.') }}</td>
                                    @else
                                    <td class="text-left" style="color: red;">Belum ada</td>
                                    @endif

                                    <td class="text-center">{{ $s->user_sales }}</td>

                                    @if(isset($s->so['flag_approve']) && $s->so['flag_approve'] ==='Y')
                                    <td class="text-center" style="background-color: #32CD32; color:white">Approved</td>
                                    @elseif(isset($s->so['flag_approve']) && $s->flag_approve === 'N')
                                    <td class="text-center" style="background-color: red;">Ditolak</td>
                                    @else
                                    <td class="text-center" style="background-color: yellow;">Diproses</td>
                                    @endif
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="{{ route('sales-order.details', $s->nosp) }}">
                                            <i class="fas fa-info"></i>
                                        </a>
                                    </td>
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