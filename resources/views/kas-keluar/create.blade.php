@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Buat Kas Keluar</b></h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('kas-keluar.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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

        <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{ route('pembelian-non-aop.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <strong>Tanggal Transaksi</strong>
                                    <input type="text" name="txt_invoice" class="form-control" placeholder="contoh: 12-234-77">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <strong>Divisi</strong>
                                    <input type="date" name="tanggal_nota" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                    <label for="">No. Kas Keluar</label>
                                    <select name="customer_to" class="form-control mr-2">
                                        <option value="">-- Pilih Customer --</option>
                                        <option value="KCP01001">KCP01001</option>
                                        <option value="KCP02001">KCP02001</option>
                                    </select>
                                </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <strong>Supplier</strong>
                                    <input type="text" name="supplier" class="form-control" placeholder="contoh: supplier a ">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <strong>TOP</strong>
                                    <input type="date" name="tanggal_jatuh_tempo" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                            
                                </div>
                            </div>
                        </div>
                    </form>
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