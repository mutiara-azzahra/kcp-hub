<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
    h4,h2{
        font-family:'Times New Roman', Times;
    }
        body{
            font-family:'Times New Roman', Times;
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
      .td-center{
        text-align: center;
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
        border-top: 1px solid #000; 
        border-bottom: 1px solid #000;
        border-left: none;
        border-right: none;
      }
      br{
          margin-bottom: 2px !important;
      }
      .table-bawah{
        border-left: none;
        border-right: none;
      }
     .judul{
         text-align: center;
     }
     .header{
         margin-bottom: 0;
         text-align: center;
         height: 120px;
         padding: 0px;
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
          margin: 10px;
          padding: 0px !important;
          } 
     </style>
    <div class="header">
        <table class="table atas" style="line-height: 12px;">
            <tr>
                <td class="atas" style="width: 350px;">
                    <table class="atas" style="line-height: 13px;">
                        <tr>
                            <td class="atas">PT. KCP</td>
                        </tr>
                        <tr>
                            <td class="alamat-kcp">Jl. Sutoyo S. No. 144 Banjarmasin</td>
                        </tr>
                        <tr>
                            <td class="alamat-kcp">Hp. 0811 517 1595, 0812 5156 2768</td>
                        </tr>
                        <tr>
                            <td class="alamat-kcp">Telp. 4417127</td>
                        </tr>
                    </table>
                </td>
                <td class="atas">
                    <table class="atas" style="line-height: 13px;">
                        <tr>
                            <td class="atas"><b>SURAT JALAN (SJ)</b></td>
                        </tr>
                        <tr>
                            <td class="atas"></td>
                        </tr>
                        <tr>
                            <td class="atas">{{ $data_details->outlet->nm_outlet }} ({{ $data_details->outlet->kd_outlet }})</td>
                        </tr>
                        <tr>
                            <td class="atas">{{ $data_details->outlet->almt_pengiriman }}</td>
                        </tr>
                        <tr>
                            <td class="atas">{{ $data_details->outlet->kode_area->provinsi->provinsi}}</td>
                        </tr>
                    </table>
                </td>
            </tr>

            @foreach($data as $i)
            <tr style="line-height: 10px;">
                <td class="nops">
                    <table class="atas">
                        <tr>
                            <td class="atas">No. P/S</td>
                            <td class="atas">:</td>
                            <td class="atas">{{ $i->nosj }}</td>
                        </tr>
                    </table>
                </td>

                <td class="nops">
                    <table class="atas">
                        <tr>
                            <td class="atas">Tanggal SJ</td>
                            <td class="atas">:</td>
                            <td class="atas">{{ $i->created_at }}</td>
                        </tr>
                    </table>
                </td>
            </tr>

            @endforeach
        </table>
    </div>

    <div class="container">
        <div class="isi">
            <table class="table table-bawah" style="line-height: 14px;">
                <thead>
                    <tr>
                        <th class="th-header">No.</th>
                        <th class="th-header">No. Packingsheet</th>
                        <th class="th-header">Invoice</th>
                        <th class="th-header" style="width: 150px;">Dus</th>
                        <th class="th-header">Koli</th>
                        <th class="th-header" style="width: 30px;">Check</th>
                        <th class="th-header">Keterangan</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $p)
                    @foreach ($p->details_sj as $s)

                    <tr>
                        <td class="td-qty">{{$loop->iteration}}. </td>
                        <td class="td-part">{{ $s->nops }}</td>
                        <td class="td-part">
                            @foreach($s->header_ps->invoice as $i)
                            {{ $i->noinv }},
                            @endforeach
                        </td>
                        <td class="td-part">
                           {{ $s->header_ps->details_dus->first()->no_dus }} - {{ $s->header_ps->details_dus->last()->no_dus }}
                        </td>
                        <td class="td-center">{{ $s->header_ps->details_dus->count('no_dus') }}</td>
                        <td class="td-dus"></td>
                        <td class="td-qty">
                            @php
                            $uniqueValues = [];
                            $valueMap = [
                                'A' => 'AIR AKI',
                                'SP' => 'SPAREPART',
                            ];
                            @endphp

                            @foreach($s->header_ps->details_dus as $d)
                                @if(array_key_exists($d->kd_kategori, $valueMap) && !in_array($d->kd_kategori, $uniqueValues))
                                    @php
                                    $uniqueValues[] = $d->kd_kategori;
                                    @endphp
                                @endif
                            @endforeach

                            @foreach($uniqueValues as $value)
                                {{ $valueMap[$value] }}
                                @if (!$loop->last)
                                    , 
                                @endif
                            @endforeach


                        </td>
                    </tr>

                    @endforeach
                    @endforeach
                </tbody>
            </table>
                <table class="table atas">
                    <tr>
                        <td class="alamat-kcp">Catatan:</td>
                        <td class="alamat-kcp"></td>
                        <td class="alamat-kcp"></td>
                    </tr>
                    <tr>
                        <td class="alamat-kcp">Cetak Oleh : {{ Auth::user()->nama_user }}, {{ NOW() }}</td>
                        <td class="alamat-kcp"></td>
                        <td class="alamat-kcp"></td>
                    </tr>
                </table>
                <table class="atas">
                    <tr>
                        <td class="atas">
                            <div class="ttd">
                                <h5 style="margin:0px">Penjualan,</h5>
                                <br>
                                <br>
                                
                                <h5 style="text-decoration:underline; margin:0px">__________________</h5>
                            </div>
                        </td>
                        <td class="atas">
                            <div class="ttd">
                                <h5 style="margin:0px">Ekspedisi,</h5>
                                <br>
                                <br>
                                <h5 style="text-decoration:underline; margin:2px">{{ $data_details->outlet->expedisi }}</h5>
                            </div>
                        </td>
                        <td class="atas">
                            <div class="ttd">
                                <h5 style="margin:0px">Toko,</h5>
                                <br>
                                <br>
                                
                                <h5 style="text-decoration:underline; margin:0px">__________________</h5>
                            </div>
                        </td>
                        <td class="atas">
                            <div class="ttd">
                                <h5 style="margin:0px">Staff Gudang,</h5>
                                <br>
                                <br>
                                
                                <h5 style="text-decoration:underline; margin:0px">__________________</h5>
                            </div>
                        </td>
                        
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>