<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
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
        border-top: 1px solid #000; /* Add a top border with a black color */
        border-bottom: 1px solid #000; /* Add a bottom border with a black color */
        border-left: none; /* Remove the left border */
        border-right: none;
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
                                    <td class="nama-kcp">PT. KCP</td>
                                    <td class="atas">INVOICE</td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Jl. Sutoyo S. No. 144 Banjarmasin</td>
                                    <td class="atas"></td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Hp. 0811 517 1595, 0812 5156 2768</td>
                                    
                                    <td class="atas">{{ $data->nm_outlet }} ({{ $data->kd_outlet }})</td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Telp. 0511-4416579, 4417127</td>
                                    <td class="atas">{{ $data->outlet->almt_pengiriman }}</td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Fax. 3364674 </td>
                                    <td class="atas">{{ $data->outlet->kode_area->nm_area }}</td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp"></td>
                                    <td class="atas">{{ $data->outlet->kode_area->provinsi->provinsi}}</td>
                                </tr>
                                <tr>
                                    <td class="nops">
                                        <table class="atas">
                                            <tr>
                                                <td class="atas">No. Nota</td>
                                                <td class="atas">:</td>

                                                @if($data->outlet->kode_area->provinsi->kode_prp == 6200)
                                                <td class="atas">KCP/KT/{{ $data->noinv }}</td>

                                                @else
                                                <td class="atas">KCP/KS/{{ $data->noinv }}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td class="atas">Tanggal</td>
                                                <td class="atas">:</td>
                                                <td class="atas">{{ $data->created_at }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="atas"></td>
                                </tr>
                            </table>
    
    </div>

    <div class="container">
        <div class="isi">
            <table class="table table-bawah">
                <thead>
                    <tr>
                        <th class="th-header">No.</th>
                        <th class="th-header">Part No</th>
                        <th class="th-header">Nama Barang</th>
                        <th class="th-header">Qty</th>
                        <th class="th-header">Hrg/Pcs</th>
                        <th class="th-header">Disc</th>
                        <th class="th-header">%</th>
                        <th class="th-header">Jumlah</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice_details as $p)
                    <tr>
                        <td class="td-qty">{{$loop->iteration}}.</td>
                        <td class="td-part">{{ $p->part_no }}</td>
                        <td class="td-part">{{ $p->nama_part->part_nama }}</td>
                        <td class="td-qty">{{ $p->qty }}</td>
                        <td class="td-angka">{{ number_format($p->hrg_pcs, 0, ',', '.') }}</td>
                        <td class="td-angka">{{ number_format($p->nominal_disc, 0, ',', '.') }}</td>
                        <td class="td-angka">{{ $p->disc }}</td>
                        <td class="td-angka">{{ number_format($p->nominal_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                                        <table class="atas">
                                            <tr>
                                                <td class="atas">Tanggal Jatuh Tempo: </td>
                                                <td class="atas-total"><b>TOTAL :</b></td>
                                                <td class="atas-total"><b>{{ number_format($p->sum('nominal_total'), 0, ',', '.') }}</b></td>
                                            </tr>
                                            <tr>
                                                <td class="atas">Terbilang</td>
                                                <td class="atas"></td>
                                                <td class="atas"></td>
                                            </tr>
                                            <tr>
                                                <td class="atas"># #</td>
                                                <td class="atas"></td>
                                                <td class="atas"></td>
                                            </tr>
                                        </table>
        
                <table class="atas">
                    <tr>
                        <td class="atas">
                            <div class="ttd">
                                <h6 style="margin:0px">Penjualan,</h6>
                                <br>
                                <br>
                                <br>
                                <br>
                                
                                <h5 style="text-decoration:underline; margin:0px">__________________________</h5>
                            </div>
                        </td>
                        <td class="atas">
                            <div class="ttd">
                                <h6 style="margin:0px">AR</h6>
                                <br>
                                <br>
                                <br>
                                <h6 style="margin:0px">Approve by System</h6>
                                <h5 style="text-decoration:underline; margin:0px">__________________________</h5>
                            </div>
                        </td>
                    </tr>
                </table>

                <br>
                <br>
                <table class="table atas">
                    <tr>
                        <td class="alamat-kcp">- Pembayaran dianggap sah bila dicap LUNAS</td>
                    </tr>
                    <tr>
                        <td class="alamat-kcp">- Barang yang sudah dibeli tidak dapat ditukarkan/dikembalikan</td>
                    </tr>
                    <tr>
                        <td class="alamat-kcp">- Pembayaran dengan giro/cheque dianggap sah bila telah diclearingkan</td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>