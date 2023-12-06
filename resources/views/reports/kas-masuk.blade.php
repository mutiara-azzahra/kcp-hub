<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kas Masuk</title>
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
        line-height: 14px;
      }
     .judul{
         text-align: center;
     }
     .header{
         margin-bottom: 0;
         text-align: center;
         height: 50px;
         padding: 0px;
     }
     .isi{
         margin-bottom: 0;
         text-align: center;
         height: 60px;
         padding-left: 200px;
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
        <table class="table atas" style="line-height: 15px;">
            <tr>
                <td class="atas">KCP/NON/{{ $data->no_kas_masuk }}</td>  
            </tr>
            <tr>
                <td class="atas-header"><b>Tanda Terima Pembayaran</b></td>
            </tr>
        </table>
    </div>
    <div class="isi">
        <table class="table atas">
            <tr>
                <td class="atas-isi">Telah Diterima Dari</td>
                <td class="atas">{{ $data->outlet->nm_outlet }} [{{ $data->kd_outlet }}]</td>
            </tr>
            <tr>
                <td class="atas-isi">Uang Sejumlah</td>
                <td class="atas">Rp. {{ number_format($data->nominal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="atas-isi">Pembayaran Via</td>
                <td class="atas">{{ $data->pembayaran_via }} </td>
            </tr>
        </table>
    </div>
    <div>
        <br>
        <br>
        <br>
        <table class="atas">
            <tr>
                <td class="atas">
                    <div class="ttd">
                        
                        <br>
                        <h5 style="text-decoration:underline; margin:0px">Yang Menyerahkan</h5>
                    </div>
                </td>
                <td class="atas">
                    <div class="ttd">
                        <br>
                        <h5 style="text-decoration:underline; margin:0px">Yang Menerima</h5>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="header">
        <table class="table atas" style="line-height: 15px;">
            <tr>
                <td class="atas">KCP/NON/{{ $data->no_kas_masuk }}</td>  
            </tr>
            <tr>
                <td class="atas-header"><h5 style="text-decoration:underline; margin:0px">TANDA TERIMA</h5></td>
                
            </tr>
        </table>
    </div>
    <div class="isi">
        <table class="table atas">
            <tr>
                <td class="atas-isi">Sudah Diterima Dari</td>
                <td class="atas">{{ $data->outlet->nm_outlet }} [{{ $data->kd_outlet }}]</td>
            </tr>
            <tr>
                <td class="atas-isi">Uang Sejumlah</td>
                <td class="atas">Rp. {{number_format( $data->nominal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="atas-isi">Untuk Pembayaran</td>
                <td class="atas">{{ $data->keterangan }} A/N {{ $data->outlet->nm_outlet }} </td>
            </tr>
        </table>
    </div>
    <div>
        <div class="atas-total" style="padding-right: 50px;">
            <br>
            <p>Banjarmasin, {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            <br>
            <h6 style="margin:0px; text-decoration:underline;text-transform: uppercase; padding-right: 20px;" >Approve by System</h6>
        </div>
    </div>

</body>
</html>