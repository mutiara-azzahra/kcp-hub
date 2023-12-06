<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rekap Pembelian Non</title>
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
      .atas-isi{
          text-align: left;
          width: 150px;
          border: none;
      }
      .atas-header{
          text-align: center;
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
        text-align: right;
        border-top: 0.5px solid #000; 
        border-bottom: 0.5px solid #000;
        border-left: none;
        border-right: none;
      }
      .td-qty{
        text-align: left;
        border-top: 0.5px solid #000; 
        border-bottom: 0.5px solid #000;
        border-left: none;
        border-right: none;
      }
      .td-angka{
        text-align: center;
        border-top: 0.5px solid #000; 
        border-bottom: 0.5px solid #000;
        border-left: none;
        border-right: none;
      }
      .th-header{
        text-align: center;
        border-top: 0.5px solid #000; 
        border-bottom: 0.5px solid #000;
        border-left: none;
        border-right: none;
      }
      br{
          margin-bottom: 2px !important;
      }
      .table-bawah{
        border-left: none;
        border-right: none;
        line-height: 14px;
      }
     .header{
         margin-bottom: 0;
         text-align: center;
         height: 40px;
         padding: 0px;
     }
     .isi{
         margin-bottom: 0;
         text-align: center;
         height: 10px;
     }
     .judul{
         margin-bottom: 0;
         text-align: center;
         height: 110px;
     }
     hr{
         height: 3px;
         background-color: black;
         width:100%;
     }
     .text-right{
         text-align:right;
     }
     .ttd{
        text-align: center;
        text-transform: uppercase;
     }
     .ttd-biasa{
        text-align: center;
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
        <table class="table atas" style="line-height: 15px;">
            <tr>
                <td class="atas">PT. KCP</td>
            </tr>
        </table>
    </div>
    <div class="judul">
        <table class="atas" style="line-height: 15px;">
            <tr>
                <td class="atas-header"><h4 style="text-decoration:underline; text-transform: uppercase; margin:0px">Rekap Pembelian Non</h4></td>
            </tr>
        </table>
        <table class="atas">
            <tr>
                <td class="atas">Tanggal Nota</td>
                <td class="atas">:</td>
                <td class="atas">{{ Carbon\Carbon::parse($data->tanggal_nota)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td class="atas">No. Nota</td>
                <td class="atas">:</td>
                <td class="atas">{{ $data->invoice_non }}</td>
            </tr>
            <tr>
                <td class="atas">Supplier</td>
                <td class="atas">:</td>
                <td class="atas">{{ $data->supplier }}</td>
            </tr>
            <tr>
                <td class="atas">Jatuh Tempo</td>
                <td class="atas">:</td>
                <td class="atas">{{ $data->tanggal_jatuh_tempo }}</td>
            </tr>
        </table>
    </div>

    <div class="isi">
        <table class="table table-bawah" style="line-height: 20px;">
            <thead>
                <tr>
                    <th class="th-header">No.</th>
                    <th class="th-header">No Part</th>
                    <th class="th-header">Banyaknya</th>
                    <th class="th-header">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $p)
                <tr>
                    <td class="td-angka">{{ $loop->iteration }}.</td>
                    <td class="td-qty">{{ $p->part_no }}</td>
                    <td class="td-angka">{{ number_format($p->qty, 0, ',', '.') }}</td>
                    <td class="td-part">{{ number_format($p->amount_nota, 2, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="td-angka"><b>GRAND TOTAL</b></td>
                    <td class="td-part"><b>{{ number_format($details->sum('amount_nota'), 2, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
    </body>
</html>