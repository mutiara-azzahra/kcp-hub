<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Label</title>
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
      .atas-tengah{
          text-align: left;
          border: none;
          margin-bottom: 10px;
      }
      .atas-center{
          text-align: center;
          border: none;
          font-size: 18px;
      }
      .ttd-table{
          border: none;
      }
      .nama-kcp{
          text-align: left;
          border: none;
          font-size: 12px;
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
         margin-bottom: 18px;
         text-align: center;
         height: 200px;
         padding: 4px;
         border: 0.5px solid #000;
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
     .page-break {
            page-break-before: always;
        }

    </style>
</head>
<body>
    <style>
        @page { 
          size: 21 cm 29.6 cm; 
          margin-top: 20px;
          margin-left: 0px;
          margin-right: 0px;
          padding: 0px !important;
          } 
    </style>
                    @foreach($data_dus as $data)
                    <div class="header">
                            <table class="table atas">
                                <tr>
                                    <td class="nama-kcp">PT. KCP</td>
                                    <td class="atas"><b>KCP/{{ $data->header_ps->kd_outlet }}/{{ $data->nops }}</b></td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Jl. Sutoyo S. No. 144 Banjarmasin</td>
                                    <td class="alamat-kcp">Tgl. Packingsheet: {{ $data->created_at}}</td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Hp. 0811 517 1595, 0812 5156 2768</td>
                                    <td class="atas"></td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Telp. 0511-4416579, 4417127</td>
                                    <td class="atas"></td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">Fax. 3364674 </td>
                                    <td class="atas"></td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp"></td>
                                    <td class="atas"></td>
                                </tr>
                            </table>

                            <table class="table atas-tengah">
                                <tr>
                                    <td class="atas-center">
                                        <b>{{ $data->header_ps->nm_outlet }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="atas-center">
                                        <b>KCP/{{ $data->header_ps->kd_outlet }}/{{ $data->no_dus }}</b>
                                    </td>
                                </tr>
                            </table>

                            <br>
                            <table class="table atas">
                                <tr>
                                    <td class="nama-kcp">{{ $data->header_ps->outlet->almt_outlet }}</td>
                                </tr>
                                <tr>
                                    <td class="alamat-kcp">{{ $data->header_ps->outlet->kode_area->nm_area }}, {{ $data->header_ps->outlet->kode_area->provinsi->provinsi }}</td>
                                </tr>
                            </table>
                        </div>

                    @endforeach
                        
</body>
</html>