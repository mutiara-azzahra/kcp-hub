<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Piutang Toko</title>
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
                        <tr>
                            <td class="alamat-kcp">Jl. Sutoyo S. No. 144 Banjarmasin, Hp. 0811 517 1595, 0812 5156 2768</td>
                        </tr>
                        <tr>
                            <td class="atas" style="margin:0px; text-decoration:underline;"><b>Daftar Piutang Toko</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        <div class="isi">
            <table class="table table-bawah">
                <thead>
                    <tr>
                        <th class="th-header">NO</th>
                        <th class="th-header">TANGGAL</th>
                        <th class="th-header">NO FAKTUR</th>
                        <th class="th-header">JATUH TEMPO</th>
                        <th class="th-header">TOTAL</th>
                        <th class="th-header">RETUR</th>
                        <th class="th-header">TELAH BAYAR</th>
                        <th class="th-header">TANGGAL BAYAR</th>
                        <th class="th-header">SISA</th>
                        <th class="th-header">CATATAN</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
            <table class="atas" style="line-height: 15px;">
                <tr>
                    <td class="atas">Harap dibayar pada tangal</td>
                    <td class="atas-total"><b>TOTAL :</b></td>
                </tr>
            </table>

            <br>
            <table class="atas">
                <tr>
                    <td class="atas">
                        <table class="table atas" style="line-height: 11px;">
                            <tr>
                                <td class="alamat-kcp">- Nota Asli Menyusul Setelah Pembayaran Lunas</td>
                            </tr>
                            <tr>
                                <td class="alamat-kcp">- Harap melakukan transfer kepada Rekening:</td>
                            </tr>
                            <tr>
                                <td class="alamat-kcp">PT. KUMALA CENTRAL PARTINDO</td>
                            </tr>
                            <tr>
                                <td class="alamat-kcp">BANK MANDIRI</td>
                                <td class="alamat-kcp">:</td>
                            </tr>
                            <tr>
                                <td class="alamat-kcp">BANK BCA</td>
                                <td class="alamat-kcp">:</td>
                            </tr>
                            <tr>
                                <td class="alamat-kcp">BANK BNI</td>
                                <td class="alamat-kcp">:</td>
                            </tr>
                            <tr>
                                <td class="alamat-kcp">BANK BRI</td>
                                <td class="alamat-kcp">:</td>
                            </tr>
                            <tr>
                                <td class="alamat-kcp">BANK DANAMON</td>
                                <td class="alamat-kcp">:</td>
                            </tr>
                        </table>
                    </td>
                    <td class="nama-kcp" style="width: 250px">
                        <table class="atas">
                            <tr>
                                <td class="atas">
                                    <div class="ttd">
                                        <h6 >Diterima Oleh,</h6>
                                        <br>
                                        <h6 style="margin:0px; text-decoration:underline;" >TTD, NAMA & STEMPEL TOKO</h6>
                                    </div>
                                    <div class="ttd">
                                        <h6 >Dibuat Oleh,</h6>
                                        <br>
                                        <h6 style="margin:0px; text-decoration:underline;" ></h6>
                                    </div>
                                    <div class="ttd">
                                        <h6 >Diketahui Oleh,</h6>
                                        <br>
                                        <h6 style="margin:0px; text-decoration:underline;" ></h6>
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