<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LKH</title>
    <style>
    h4,h2{
        font-family:serif;
    }
        body{
            font-family:sans-serif;
        }
        table{
        border-collapse: collapse;
        width:100%;
      }
      table, th, td{
        border: 1px solid black;
      }
      th{
        text-align: center;
      }
      .atas{
          text-align: left;
          border: none;
      }
      .atas-total{
          text-align: right;
          border: none;
      }
      .ttd-table{
          border: none;
      }
      .nama-kcp{
          text-align: left;
          border: none;
          font-size: 14px;
      }
      .alamat-kcp{
          text-align: left;
          border: none;
          font-size: 12px;
      }
      .nops{
          padding-top:10px;
          text-align: left;
          border: none;
      }
      .table-part{
          border: none;
      }
      td{
        text-align: center;
      }
      .td-part{
        text-align: left;
        border: none;
      }
      .td-qty{
        text-align: center;
        border: none;
      }
      .td-angka{
        text-align: right;
        border: none;
      }
      .th-header{
        text-align: center;
        border: none;
      }
      br{
          margin-bottom: 2px !important;
      }
      .table-bawah{
        border-left: none; /* Remove left border */
        border-right: none;
      }
     .judul{
         text-align: center;
     }
     .header{
         margin-bottom: 0;
         text-align: center;
         height: 200px;
         padding: 0px;
         border: none;
     }
     hr{
         height: 3px;
         background-color: black;
         width:100%;
     }
     .ttd{
        text-align: center;
        text-transform: uppercase;
     }
     .text-right{
         text-align:right;
     }
     .isi{
         padding:0px;
     }

    </style>
</head>
<body>
    <style>
        @page { 
          size: 21 cm 29.6 cm; 
          margin: 0 cm 0 cm 0 cm 0 cm !important;
          padding: 0px !important;
          } 
     </style>
    <div class="header">
                            <table class="table atas">
                                <tr>
                                    <td class="nama-kcp">Laporan Kiriman Harian - LKH</td>
                                    <td class="nama-kcp">KCP/{{ $data_no_lkh->no_lkh }}</td>
                                </tr>
                            </table>

                            <table class="table atas">
                                <tr class="nama-kcp">
                                    <td class="nama-kcp">
                                        <table class="table atas">
                                            <tr>
                                                <th class="nama-kcp">Tanggal</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp">{{ $data_no_lkh->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <th class="nama-kcp">Jam Berangkat</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp">{{ $data_no_lkh->jam_berangkat }}</td>
                                            </tr>
                                            <tr>
                                                <th class="nama-kcp">Tanggal</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp">{{ $data_no_lkh->jam_kembali }}</td>
                                            </tr>
                                            <tr>
                                                <th class="nama-kcp">KM Saat Berangkat</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp">{{ $data_no_lkh->km_berangkat_mobil }}</td>
                                            </tr>
                                            <tr>
                                                <th class="nama-kcp">KM Saat Kembali</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp">{{ $data_no_lkh->km_kembali_mobil }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="nama-kcp">
                                        <table class="table atas">
                                            <tr>
                                                <th class="nama-kcp">Driver</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp">{{ $data_no_lkh->driver }}</td>
                                            </tr>
                                            <tr>
                                                <th class="nama-kcp">Helper</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp">{{ $data_no_lkh->helper }}</td>
                                            </tr>
                                            <tr>
                                                <th class="nama-kcp">Plat Mobil</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp">{{ $data_no_lkh->plat_mobil }}</td>
                                            </tr>
                                            <tr>
                                                <th class="nama-kcp">Total Toko</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp"></td>
                                            </tr>
                                            <tr>
                                                <th class="nama-kcp">Total Koli</th>
                                                <td class="nama-kcp">:</td>
                                                <td class="nama-kcp"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                            </table>
    
    </div>

    <div class="container">
        <div class="isi">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Toko/Alamat</th>
                        <th>Koli</th>
                        <th>Invoice</th>
                        <th>Ekspedisi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $p)

                    @foreach($p->details_lkh as $d)

                    @foreach($d->ps->invoice as $i)
                    <tr>
                        <td>{{$loop->iteration}}.</td>
                        <td>{{ $i->kd_outlet }}/{{ $i->nm_outlet }}</td>
                        <td>{{ $d->ps->details_dus->count('no_dus') }}</td>
                        <td>{{ $i->noinv }}</td>
                        <td>{{ $i->outlet->expedisi }}</td>
                        <td></td>
                    </tr>

                    @endforeach

                    @endforeach

                    @endforeach
                </tbody>

            </table>

            <br>
            <br>
                <table class="atas">
                    <tr>
                        <td class="atas">
                            <div class="ttd">
                                <h6 style="margin:0px">AR</h6>
                                <br>
                                <br>
                                <br>
                                
                                <h5 style="text-decoration:underline; margin:0px">__________________________</h5>
                            </div>
                        </td>
                        <td class="atas">
                            <div class="ttd">
                                <h6 style="margin:0px">Security</h6>
                                <br>
                                <br>
                                <br>

                                <h5 style="text-decoration:underline; margin:0px">__________________________</h5>
                            </div>
                        </td>
                        <td class="atas">
                            <div class="ttd">
                                <h6 style="margin:0px">Driver</h6>
                                <br>
                                <br>
                                <br>
                                
                                <h5 style="text-decoration:underline; margin:0px">__________________________</h5>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>