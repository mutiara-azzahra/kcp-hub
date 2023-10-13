@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Approved SO</b></h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('sales-order.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th class="text-center">No Sales Order</th>
                                    <th class="text-center">Back Order</th>
                                    <th class="text-center">Kode | Nama Toko</th>
                                    <th class="text-center">Nominal SP</th>
                                    <th class="text-center">Nominal Plafond</th>
                                    <th class="text-center">Nama Sales</th>
                                    <th class="text-center">Approve SPV</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp
                                @foreach($so_approved as $s)
                                <tr>
                                    <td class="text-center">{{ $s->noso }}</td>
                                    <td class="text-center"></td>
                                    <td class="text-left">{{ $s->kd_outlet }} | {{ $s->nm_outlet }}</td>
                                    <td class="text-right">{{ $s->details_so->sum('nominal_total') }}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">{{ $s->user_sales }}</td>

                                    @if($s->flag_approve ==='Y')
                                    <td class="text-center" style="background-color: green; color:white">Approved</td>
                                    @elseif($s->flag_approve === 'N')
                                    <td class="text-center" style="background-color: red;">Ditolak</td>
                                    @else
                                    <td class="text-center" style="background-color: yellow;">Diproses</td>
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
        function closeAlertAfterTime(alertId, milliseconds) {
            setTimeout(function () {
                var alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.style.display = 'none'; 
                }
            }, milliseconds);
        }
        closeAlertAfterTime('myAlert', 4000);
    </script>

@endsection