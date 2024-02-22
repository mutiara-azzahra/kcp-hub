@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Ubah Target SPV by Produk</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('master-target-spv-produk.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Maaf!</strong> Ada yang belum terisi<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">
                <form action="{{ route('master-target-spv-produk.store', $target_spv->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <strong>Pilih SPV</strong>
                            <select name="spv" class="form-control my-select" value="{{ $target_spv->spv }}">
                                <option value="">---Pilih SPV--</option>
                                <option value="yana" {{ $target_spv->spv == 'yana' ? 'selected' : '' }}>Yana</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <strong>Pilih Produk</strong>
                            <select name="kode_produk" class="form-control my-select" value="{{ $target_spv->kode_produk }}">
                                <option value="">---Pilih Produk--</option>
                                <option value="ICH" {{ $target_spv->kode_produk == 'ICH' ? 'selected' : '' }}>ICHIDAI</option>
                                <option value="BRI" {{ $target_spv->kode_produk == 'BRI' ? 'selected' : '' }}>BRIO</option>
                                <option value="ACC" {{ $target_spv->kode_produk == 'ACC' ? 'selected' : '' }}>AIR ACCU</option>
                                <option value="ACL" {{ $target_spv->kode_produk == 'ACL' ? 'selected' : '' }}>AIR COOLANT</option>
                                <option value="PEN" {{ $target_spv->kode_produk == 'PEN' ? 'selected' : '' }}>PENTIL</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-2 col-md-12 col-lg-12">
                        <label for="">Tahun</label>
                        <select class="form-control mr-2 my-select" id="date-dropdown" name="tahun">
                            @if(isset($target_spv->tahun))
                                <option value="{{ $target_spv->tahun }}" selected>{{ $target_spv->tahun }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group mb-2 col-md-12 col-lg-12">
                        <label for="">Bulan</label>
                        <select name="bulan" class="form-control mr-2 my-select" value= "{{ $target_spv->bulan }}">
                            <option value="">-- Pilih Bulan --</option>
                            <option value="1" {{ $target_spv->bulan == 1 ? 'selected' : '' }}>Januari</option>
                            <option value="2" {{ $target_spv->bulan == 2 ? 'selected' : '' }}>Februari</option>
                            <option value="3" {{ $target_spv->bulan == 3 ? 'selected' : '' }}>Maret</option>
                            <option value="4" {{ $target_spv->bulan == 4 ? 'selected' : '' }}>April</option>
                            <option value="5" {{ $target_spv->bulan == 5 ? 'selected' : '' }}>Mei</option>
                            <option value="6" {{ $target_spv->bulan == 6 ? 'selected' : '' }}>Juni</option>
                            <option value="7" {{ $target_spv->bulan == 7 ? 'selected' : '' }}>Juli</option>
                            <option value="8" {{ $target_spv->bulan == 8 ? 'selected' : '' }}>Agustus</option>
                            <option value="9" {{ $target_spv->bulan == 9 ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $target_spv->bulan == 10 ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $target_spv->bulan == 11 ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $target_spv->bulan == 12 ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>
                    <div class="form-group mb-2 col-md-12 col-lg-12">
                        <div class="form-group">
                            <strong>Nominal Target</strong>
                            <input type="text" id="rupiah" name="nominal" class="form-control" value= "{{ number_format($target_spv->nominal, 0, ',', '.') }}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="float-right pt-3">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan Data</button>                            
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
    let dateDropdown = document.getElementById('date-dropdown');
    let currentYear = new Date().getFullYear();
    let earliestYear = 2022;

    dateDropdown.innerHTML = '';

    while (currentYear >= earliestYear) {
        let dateOption = document.createElement('option');
        dateOption.text = currentYear;
        dateOption.value = currentYear;

    
        if (dateOption.value === "{{ $target_spv->tahun }}") {
            dateOption.selected = true;
        }

        dateDropdown.add(dateOption);
        currentYear -= 1;
    }

    var rupiah = document.getElementById("rupiah");

    rupiah.addEventListener("keyup", function(e) {
    rupiah.value = formatRupiah(this.value);
    });

    function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? rupiah : "";
    }

</script>

@endsection