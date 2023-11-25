@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Kas Keluar</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('kas-keluar.create') }}"><i class="fas fa-plus"></i> Kas Keluar</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('warning'))
        <div class="alert alert-danger" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-header">
            Kas Keluar Belum Selesai
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No</th>
                            <th class="text-center">No. Kas Keluar</th>
                            <th class="text-center">Pembayaran</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($kas_keluar as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}.</td>
                            <td class="text-left">{{ $p->no_keluar }}</td>
                            <td class="text-left">{{ $p->pembayaran }}</td>
                            <td class="text-left">{{ $p->keterangan }}</td>
                            <td class="text-left">Rp. {{ number_format($p->details_keluar->where('akuntansi_to', 'D')->sum('total'), 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('kas-keluar.show', $p->no_keluar)}}"><i class="fas fa-eye"></i></a>
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
    
    <script>
    $(document).ready(function() {
        $('#tanggal_awal').change(function() {
            var selectedDate = $(this).val();
            
            if (selectedDate) {
                // Get the year and month from the selected date
                var year = selectedDate.split('-')[0];
                var month = selectedDate.split('-')[1];
                
                // Set the date input to the first day of the selected month
                var firstDayOfMonth = year + '-' + month + '-01';
                $(this).val(firstDayOfMonth);
            }
        });
    });
    </script>

@endsection