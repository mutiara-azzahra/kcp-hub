@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Details Kiriman Harian</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('laporan-kiriman-harian.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Maaf!</strong> Ada yang salah<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($details == null)
    <div class="card" style="padding: 20px;">
        <form action="{{ route('laporan-kiriman-harian.store-details', ['no_lkh' => $details->no_lkh ]) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>No. LKH</strong> : 
                        {{ $details->no_lkh }}<br>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Driver</strong>
                            <select name="id" class="form-control mr-2">
                                <option value="">-- Pilih Driver --</option>
                                @foreach($driver as $s)
                                    <option value="{{ $s->username }}">{{ $s->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Helper</strong>
                        <input type="text" name="helper" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Plat Mobil</strong>
                        <input type="text" name="plat_mobil" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jam Berangkat</strong>
                        <input type="datetime-local" name="jam_berangkat" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jam Kembali</strong>
                        <input type="datetime-local" name="jam_kembali" class="form-control" placeholder="">
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>KM. Berangkat</strong>
                        <input type="text" name="km_berangkat_mobil" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>KM. Kembali</strong>
                        <input type="text" name="km_kembali_mobil" class="form-control" placeholder="">
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
    @else
    <div class="card" style="padding: 20px;">
        <form action="{{ route('laporan-kiriman-harian.update', ['no_lkh', $details->no_lkh]) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>No. LKH</strong> : 
                        {{ $details->no_lkh }}<br>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Driver</strong>
                        <input type="text" name="helper" class="form-control" placeholder="{{ $details->driver }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Helper</strong>
                        <input type="text" name="helper" class="form-control" placeholder="{{ $details->helper }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Plat Mobil</strong>
                        <input type="text" name="plat_mobil" class="form-control" placeholder="{{ $details->plat_mobil }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jam Berangkat</strong>
                        @if($details->jam_berangkat != null)
                        <input type="text" name="plat_mobil" class="form-control" placeholder="{{ $details->jam_kembali }}">
                        @else
                        <input type="datetime-local" name="jam_kembali" class="form-control" placeholder="">
                        @endif
                        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jam Kembali</strong>

                        @if($details->jam_kembali != null)
                        <input type="text" name="plat_mobil" class="form-control" placeholder="{{ $details->jam_kembali }}">
                        @else
                        <input type="datetime-local" name="jam_kembali" class="form-control" placeholder="">
                        @endif
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>KM. Berangkat</strong>
                        <input type="text" name="km_berangkat_mobil" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>KM. Kembali</strong>
                        <input type="text" name="km_kembali_mobil" class="form-control" placeholder="">
                    </div>
                </div>
                @if($details->jam_kembali != null)

                @else
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <div class="float-right">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </div>
                @endif
            </div>
        </form>
    </div>
    @endif
                        <div class="card" style="padding: 20px;">
                            <div class="col-lg-12 p-1">
                                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">No. LKH</th>
                                            <th class="text-center">Kode/Nama Toko</th>
                                            <th class="text-center">No. Packingsheet</th>
                                            <th class="text-center">Koli</th>
                                            <th class="text-center">No. Urut</th>
                                            <th class="text-center">Ekspedisi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="input-fields">
                                        @foreach($lkh_details as $i)

                                            @foreach($i->details_lkh as $d)
                                            <tr>
                                                <td class="text-left">KCP/{{ $details->no_lkh }}</td>

                                                @foreach($d->outlet as $o)
                                                <td class="text-left">{{ $d->kd_outlet }}/{{ $o->nm_outlet }}</td>
                                                @endforeach

                                                <td class="text-center">{{ $d->no_packingsheet }}</td>
                                                <td class="text-center">{{ $d->koli }}</td>
                                                <td class="text-center"> - </td>

                                                @foreach($d->outlet as $o)
                                                <td class="text-left">{{ $o->expedisi }}</td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
</div>


@endsection

@section('script')


@endsection