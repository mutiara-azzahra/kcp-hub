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
        border-collapse: collapse;
        width:100%;
      }
      table, th, td{
        border: 1px solid black;
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
         height: 180px;
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
          margin: 0 cm 0 cm 0 cm 0 cm !important;
          padding: 0px !important;
          } 
     </style>
    
    <div class="header">
                            <table class="table atas">
                                <tr>
                                    <td class="nama-kcp">PT. KCP</td>
                                    <td class="atas">Packingsheet / PS</td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Jl. Sutoyo S. No. 144 Banjarmasin</td>
                                    <td class="atas"></td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Hp. 0811 517 1595, 0812 5156 2768</td>
                                    <td class="atas"> {{ $data->nm_outlet }} ({{ $data->kd_outlet }})</td>
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
                                    <td class="nops">
                                        <table class="atas">
                                            <tr>
                                                <td class="atas">No. P/S</td>
                                                <td class="atas">:</td>
                                                <td class="atas">KCP/{{ $data->area_ps }}/{{ $data->nops }}</td>
                                            </tr>
                                            <tr>
                                                <td class="atas">Tgl. P/S</td>
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
            <table class="table table-bawah" id="dataTable">
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
                        <td class="td-qty">{{$loop->iteration}}. </td>
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
                <br>

                <table class="atas">
                    <tr>
                        <td class="atas">
                            <div class="ttd">
                                <h6 style="margin:0px">Checker,</h6>
                                <br>
                                <br>
                                <br>
                                <h5 style="text-decoration:underline; margin:0px">__________________________</h5>
                            </div>
                        </td>
                        <td class="atas">
                            <div class="ttd">
                                <h6 style="margin:0px">Yang Membuat,</h6>
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