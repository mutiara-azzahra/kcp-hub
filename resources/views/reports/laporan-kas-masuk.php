<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Kas Masuk</title>
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
         height: 40px;
         padding: 0px;
     }
     .isi{
         margin-bottom: 0;
         text-align: center;
         height: 10px;
         padding-left: 200px;
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
        <table class="table atas" style="line-height: 15px;">
            <tr>
                <td class="atas-header"><h5 style="text-decoration:underline; margin:0px">Laporan Kas Masuk</h5></td>
            </tr>
        </table>
    </div>
    <div class="header">
        <table class="atas">
            <tr>
                <td class="atas">Periode</td>
                <td class="atas">:</td>
                <td class="atas"></td>
            </tr>
            <tr>
                <td class="atas">Cetak Oleh</td>
                <td class="atas">:</td>
                <td class="atas"></td>
            </tr>
        </table>
    </div>

    <div class="container">
        <div class="isi">
            <table class="table table-bawah" style="line-height: 13px;">
                <thead>
                    <tr>
                        <th class="th-header">Tanggal</th>
                        <th class="th-header">Kas Masuk</th>
                        <th class="th-header">Bukti Potong</th>
                        <th class="th-header">Terima Dari/Keterangan</th>
                        <th class="th-header">Pembayaran Via</th>
                        <th class="th-header">Nominal</th>
                    </tr>
                </thead>
                <tbody style="line-height: 15px;">
                    @foreach ($data_details as $p)
                    <tr>
                        <td class="td-qty" style="width: 6px;">{{$loop->iteration}}.</td>
                        <td class="td-qty">{{$p->part_no}}</td>
                        <td class="td-qty">{{$p->nama_part->part_nama}}</td>
                        <td class="td-qty">{{$p->qty}}</td>
                        <td class="td-qty">{{$p->stok_ready->stok}}</td>

                        @if($p->nama_part->rak != null)
                        <td class="td-qty">{{$p->nama_part->rak->kode_rak}}</td>
                        @else
                        <td class="td-qty">-</td>
                        @endif

                        <td class="td-qty">
                            
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="kanan col-6">
                <table class="atas">
                    <tr>
                        <td class="atas">
                            <div class="ttd">
                                <br>
                                <h6 style="text-decoration:underline; margin:0px; color:white">xxxx</h6>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="kanan col-6">
                <table class="atas">
                    <tr>
                        <td class="atas">
                            <div class="ttd">
                                <br>
                                <h6 style="text-decoration:underline; margin:0px">Approve by System</h6>
                            </div>
                        </td>
                    </tr>
                </table>
            </div> 
        </div>
    </body>
</html>