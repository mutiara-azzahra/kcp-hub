@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Kas Masuk</b></h4>
            </div>
            {{-- <div class="float-right m-1">
                <a class="btn btn-info" href="{{ route('kas-masuk.pembayaran-manual') }}"><i class="fas fa-plus"></i> Terima Pembayaran Manual</a>
            </div> --}}
            <div class="float-right m-1">
                <a class="btn btn-success" href="{{ route('kas-masuk.bukti-bayar') }}"><i class="fas fa-plus"></i> Bukti Terima Pembayaran</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" id="myAlert">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <div class="col-lg-12">  
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">No</th>
                                    <th class="text-center">No. Kas Masuk</th>
                                    <th class="text-center">Kode Toko</th>
                                    <th class="text-center">Pembayaran Via</th>
                                    <th class="text-center">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp

                                @foreach($kas_masuk as $p)
                                <tr>
                                    <td class="text-center">{{ $no++ }}.</td>
                                    <td class="text-left">{{ $p->no_kas_masuk }}</td>
                                    <td class="text-left">{{ $p->kd_outlet }}</td>
                                    <td class="text-left">{{ $p->pembayaran_via }}</td>
                                    <td class="text-left">Rp. {{ number_format($p->nominal, 0, ',', '.') }}</td>
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
          searching: true,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
        });
      });

      //alert success time
      function closeAlertAfterTime(alertId, milliseconds) {
            setTimeout(function () {
                var alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.style.display = 'none'; 
                }
            }, milliseconds);
        }
        closeAlertAfterTime('myAlert', 2500);
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