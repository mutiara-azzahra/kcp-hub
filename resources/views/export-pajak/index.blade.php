@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Export Pajak Keluaran</h4>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-header">
            Pilih Periode
        </div>
        <div class="card-body">
            <form action="{{ route('export-pajak.store') }}"  method="GET">
                <!-- @csrf -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>No. Faktur Pajak</strong>
                            <input type="text" name="no_faktur_pajak" class="form-control" placeholder="Isi Nomor Faktur Pajak">
                        </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-6">
                        <label for="">Jenis Data</label>
                        <select name="jenis_data" class="form-control mr-2 my-select">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="FK">FK</option>
                            <option value="OF">OF</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" id="" class="form-control" placeholder="">
                    </div>

                    <div class="form-group col-6">
                        <label for="">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <div class="float-right pt-3">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Proses Data</button>                            
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
  let dateDropdown = document.getElementById('date-dropdown'); 
       
  let currentYear = new Date().getFullYear();    
  let earliestYear = 2022;     
  while (currentYear >= earliestYear) {      
    let dateOption = document.createElement('option');          
    dateOption.text = currentYear;      
    dateOption.value = currentYear;        
    dateDropdown.add(dateOption);      
    currentYear -= 1;    
  }

</script>

@endsection