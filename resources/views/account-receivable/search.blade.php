@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Daftar Piutang Toko</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('account-receivable.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
        <form action="{{ route('account-receivable.search')}}" method="POST">
            @csrf
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Pilih Toko</strong>
                    <select name="kd_outlet" class="form-control my-select" >
                        <option value="">---Pilih Toko--</option>
                        @foreach($outlet as $a)
                            <option value="{{ $a->kd_outlet }}">{{ $a->kd_outlet }} | {{ $a->nm_outlet }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <div class="float-right pt-3">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i> Cari Toko</button>                            
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection