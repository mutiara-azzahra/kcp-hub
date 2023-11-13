<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Packingsheet</title>
    <style>
    h4,h2{
        font-family:'Times New Roman', Times, serif;
    }
        body{
            font-family:'Times New Roman', Times, serif;
        }
        table{
        border: 0.5px solid black;
        border-collapse: collapse;
        width:100%;
      }
      th, td{
        border: 0.5px solid black;

      }
      th{
        text-align: center;
      }
      .th-header{
        text-align: center;
        border-top: 1px solid #000; /* Add a top border with a black color */
        border-bottom: 1px solid #000; /* Add a bottom border with a black color */
        border-left: none; /* Remove the left border */
        border-right: none;
      }
      .atas{
          text-align: left;
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
      td{
        text-align: center;
      }
      .td-qty{
        text-align: center;
        border: none;
      }
      .td-part{
        text-align: left;
        border: none;
      }
      .table-bawah{
        border-left: none;
        border-right: none;
      }
      br{
          margin-bottom: 2px !important;
      }
     .judul{
         text-align: center;
     }
     .header{
         margin-bottom: 0px;
         text-align: center;
         height: 120px;
         padding: 0; /* Remove padding */
        margin: 0; /* Remove margin */
     }
     .logo{
         float: left;
         margin-right: 0px;
         width: 18%;
         padding:0px;
         text-align: right;
     }
     .headtext{
         float:right;
         margin-left: 0px;
         width: 100%;
         padding-left:0px;
         padding-right:0%;
     }
     hr{
         margin-top: 10%;
         height: 0px;
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
          margin: 20px;
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
                                                <td class="atas"><b>PACKINGSHEET (P/S)</b></td>
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
                                <tr style="line-height: 13px;">
                                    <td class="nops">
                                        <table class="atas">
                                            <tr>
                                                <td class="atas">No. P/S</td>
                                                <td class="atas">:</td>
                                                @if($data->outlet->kode_area->provinsi->kode_prp == 6200)
                                                <td class="atas">KCP/NON/{{ $data->area_ps }}/{{ $data->nops }}</td>

                                                @else
                                                <td class="atas">KCP/NON/{{ $data->area_ps }}/{{ $data->nops }}</td>
                                                @endif
                                            </tr>
                                        </table>
                                    </td>

                                    <td class="nops">
                                        <table class="atas">
                                            <tr>
                                                <td class="atas">Tanggal P/S</td>
                                                <td class="atas">:</td>
                                                <td class="atas">{{ $data->created_at }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
    
    </div>

    <div class="container">
        <div class="isi">
            <table class="table table-bawah" style="line-height: 14px;">
                <thead class="thead-light">
                    <tr>
                        <th class="th-header">No.</th>
                        <th class="th-header">No. SO</th>
                        <th class="th-header">Part No</th>
                        <th class="th-header">Qty</th>
                        <th class="th-header">Dus</th>
                        <th class="th-header">Keterangan</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ps_details as $p)
                    <tr>
                        <td class="td-qty" style="width: 6px;">{{$loop->iteration}}. </td>
                        <td class="td-part">{{ $p->noso }}</td>
                        <td class="td-part">{{ $p->part_no }}</td>
                        <td class="td-qty">{{ $p->qty }}</td>
                        <td class="td-dus"></td>
                        <td class="td-qty"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

                <br>

                <table class="atas">
                    <tr>
                        <td class="atas">
                            <div class="ttd">
                                
                                <br>
                                <h5 style="text-decoration:underline; margin:0px">Checker</h5>
                            </div>
                        </td>
                        <td class="atas">
                            <div class="ttd">
                                <br>
                                <h5 style="text-decoration:underline; margin:0px">Yang Membuat</h5>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>