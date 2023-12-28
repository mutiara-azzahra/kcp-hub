<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kas Keluar</title>
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

      .atas-kanan{
          text-align: left;
          border: none;
          padding-right: 50px;
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
         height: 40px;
         padding: 0px;
     }
     .isi{
         margin-bottom: 0;
         text-align: center;
         height: 10px;
         padding-left: 150px;
     }
     .judul{
         margin-bottom: 0;
         text-align: center;
         height: 60px;
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
     .ttd-kanan{
        text-align: center;
        padding-right: 20px;
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
                <td class="atas">KCP/NON/{{ $data->no_keluar }}</td>
                <td class="atas">{{ \Carbon\Carbon::now() }}</td>
            </tr>
        </table>
    </div>
    <div class="judul">
        <table class="table atas" style="line-height: 15px;">
            <tr>
                <td class="atas-header"><h5 style="text-decoration:underline; margin:0px">BUKTI PENGELUARAN</h5></td>
            </tr>
        </table>
    </div>
    <div class="isi">
        <table class="table atas">
            <tr>
                <td class="atas-isi">Sudah Diterima Dari</td>
                <td class="atas">PT. KCP</td>
            </tr>
            <tr>
                <td class="atas-isi">Uang Sejumlah</td>
                <td class="atas"><b> {{ Terbilang::make($data->details_keluar->where('akuntansi_to', 'D')->sum('total'), ' rupiah') }}</b></td>
                <!-- 123456; -->
            </tr>
            <tr>
                <td class="atas-isi">Untuk Pembayaran</td>
                <td class="atas">{{ $data->pembayaran }}</td>
            </tr>
            <tr>
                <td class="atas-isi">Catatan</td>
                <td class="atas">{{ $data->keterangan }}</td>
            </tr>
            <tr style="padding: 15px;">
                <td>Rp. {{ number_format($data->details_keluar->where('akuntansi_to', 'D')->sum('total'), 0, ',', '.') }}</td>
                <td class="atas"></td>
            </tr>
        </table>
    </div>

    <div style="padding-left: 150px;">
        <br>
        <br>
        <br>
        <table class="atas">
            <tr>
                <td class="atas" style="padding-right:70px;">
                    <div class="ttd-biasa">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h5 style="text-decoration:underline; margin:0px">Menyetujui,</h5>
                    </div>
                </td>
                <td class="atas">
                    <div class="ttd-biasa">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h5 style="text-decoration:underline; margin:0px">Menerima,</h5>
                    </div>
                </td>
                <td class="atas">
                    <div class="ttd-kanan">
                        <br>
                        <p>Banjarmasin, {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
                        <br>
                        <br>
                        <h5 style="margin:0px; text-decoration:underline; padding-right: 20px;" >{{ Auth::user()->nama_user }}</h5>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>