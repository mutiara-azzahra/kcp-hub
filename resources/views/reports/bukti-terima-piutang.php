<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
    h4,h2{
        font-family: 'Times New Roman', Times;
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
          text-align: left;
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
        line-height: 14px;
      }
     .judul{
         text-align: center;
     }
     .header{
         margin-bottom: 0;
         text-align: center;
         height: 105px;
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
          size: 21 cm 14.8 cm; 
          margin-top: 10px;
          margin-left: 5px;
          margin-right: 5px;
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
                    </table>
                </td>
                <td class="atas">
                    <table class="atas" style="line-height: 13px;">
                        <tr>
                            <td class="atas"><b>BUKTI PENERIMAAN PIUTANG</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="line-height: 13px;">
                <td class="nops">
                    <table class="atas">
                        <tr>
                            <td class="atas">No. Piutang</td>
                            <td class="atas">:</td>
                            @if($data->outlet->kode_prp == 6200)
                            <td class="atas">KCP/NON/KT/{{ $data->no_piutang }}</td>

                            @else
                            <td class="atas">KCP/NON/KS/{{ $data->no_piutang }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="atas">Telah Diterima Dari</td>
                            <td class="atas">:</td>
                            <td class="atas">{{ $data->outlet->nm_outlet }} [{{$data->kd_outlet}}]</td>
                            @endif
                        </tr>
                    </table>
                </td>
                <td class="nops">
                    <table class="atas">
                        <tr>
                            <td class="atas">Tanggal</td>
                            <td class="atas">:</td>
                            <td class="atas">{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        <div class="isi">
            <table class="atas">
                <tr>
                    <td class="nama-kcp" style="width: 250px">
                        <table class="atas">
                            <tr>
                                <td class="atas">
                                    <div class="ttd">
                                        <br>
                                        <h6 style="margin:0px; text-decoration:underline;" >Banjarmasin, </h6>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>       
        </div>
    </div>
</body>
</html>