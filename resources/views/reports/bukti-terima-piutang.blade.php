<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Terima Piutang</title>
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
        border-top: 1px solid #000; /* Add a top border with a black color */
        border-bottom: 1px solid #000; /* Add a bottom border with a black color */
        border-left: none; /* Remove the left border */
        border-right: none;
      }
      br{
          margin-bottom: 2px !important;
      }
      .kotak{
        border-left: 0.5px; /* Remove left border */
        border-right: 0.5px;
        border-top:none; /* Add a top border with a black color */
        border-bottom: none;
        text-align: left;
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
        <table class="table atas" style="line-height: 15px;">
            <tr>
                <td class="atas-header">PT. KCP</td>  
            </tr>
            <tr>
                <td class="atas-header"><b>BUKTI PENERIMAAN PIUTANG</b></td>
            </tr>
        </table>
        <table class="table atas" style="line-height: 12px;">
            <tr style="line-height: 13px;">
                <td class="nops">
                    <table class="atas">
                        <tr>
                            <td class="atas">No. Piutang</td>
                            <td class="atas">:</td>
                            <td class="atas">{{ $data->no_piutang}}</td>

                            @if($data->area_piutang == 'KS')
                            <td class="atas">KCP/NON/KS/{{ $data->no_piutang }}</td>

                            @elseif($data->area_piutang == 'KT')
                            <td class="atas">KCP/NON/KT/{{ $data->no_piutang }}</td>
                    
                            @endif
                        </tr>
                        <tr>
                            <td class="atas">Telah Diterima Dari</td>
                            <td class="atas">:</td>
                            <td class="atas">{{ $data->nm_outlet }} [{{ $data->kd_outlet }}]</td>
                        </tr>
                    </table>
                </td>
                <td class="nops">
                    <table class="atas-total">
                        <tr>
                            <td class="atas-total">Tanggal</td>
                            <td class="atas-total">:</td>
                            <td class="atas">{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        <div class="row">
            <table style="border: none;">
                <tr>
                    <td style="border: none;">
                        <table>
                            <tr>
                                <td class="kotak">Pembayaran Dalam Bentuk</td>
                                <td class="kotak"></td>
                            </tr>
                            <tr>
                                <td class="kotak"><b>{{ $data->pembayaran_via }}</b></td>
                                <td class="kotak">Rp. {{ number_format($data->nominal_potong, 0, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <td class="kotak">Titipan Toko</td>
                                <td class="kotak"></td>
                            </tr>
                        </table>
                    </td>
                    <td style="border: none;">
                        <table>
                            <tr>
                                <td class="kotak">Untuk Pembayaran : </td>
                                <td class="kotak"></td>
                            </tr>
                            <tr>
                                <td class="kotak">
                                    @foreach($data->details as $a)
                                    {{ $a->noinv }},
                                    @endforeach
                                </td>
                                <td class="kotak">Rp. {{ number_format($data->details->sum('nominal'), 0, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <td class="kotak" style="color:white">xxxxxx</td>
                                <td class="kotak" style="color:white">xxxxxx</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        
        </div>
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