@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Inventaris</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('inventaris.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
            @endif

            {{-- <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <strong>Tata Cara Proses Inventaris</strong><br>
                    <ul>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div> --}}

            <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nama Aset</strong><br>
                                    {{ $inventaris->nama }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Tanggal Pembelian</label><br>
                                    {{ $inventaris->tgl_beli }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Harga Awal</strong><br>
                                    Rp. {{ $inventaris->hrg_beli }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Kredit</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;

                                $hrg_beli = $inventaris->hrg_beli;
                                $kurang = $hrg_beli * ($inventaris->persen/100);
                                @endphp

                                @for ($i = 0; $i < $inventaris->tahun_ekonomis; $i++)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $inventaris->nama }} : Penyusutan (Tahun Ke-{{ $i + 1 }})</td>
                                    <td>{{ Carbon\Carbon::parse($inventaris->tgl_beli)->addYears($i) }}</td>

                                    @if ( $i == 0)
                                    <td>{{ $hrg_beli }}</td>
                                    <td>0</td>
                                    @else

                                    <td>0</td>
                                    <td>{{ ($hrg_beli - $kurang)/$inventaris->tahun_ekonomis }}</td>

                                    @endif


                                    
                                    
                                </tr>
                                @endfor
                                
                            </tbody>
                        </table>
                </div>
            </div>



</div>
@endsection

@section('script')

    <script>
      $(function () {
        $("#example1")
          .DataTable({
            paging: true,
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)")
                  
        $("#example2").DataTable({
          paging: true,
          lengthChange: false,
          searching: false,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
        });
      });
    </script>
    
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