<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('style.css')}}">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/fontawesome-free/css/all.min.css') }}">
    
    <!-- Second Font-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!--CSS-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <title>PT. Kumala Central Partindo</title>
  </head>

  <body>
  <header id="header" class="header">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('dist/img/logo_1.png')}}" alt="" class="img-fluid img-logo-navbar">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" style="padding-right: 30px;" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#tentang">Tentang <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#lokasi">Lokasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#alur">Alur</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Tanya Jawab</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Layanan Informasi
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="">KCP Hub</a>
                <a class="dropdown-item" href="">KCP Shop</a>
              </div>
            </li>
            @if (Auth::check())
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="">Profil Saya</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="">Keluar
                    <i class="nav-icon fas fa-sign-out-alt" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Keluar"></i>
                  </a>
                </div>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link dropdown" href="">Masuk</a>
              </li> 
            @endif
          </ul>
        </div>
      </nav>
  </header>

<div class="container" data-aos="fade-right">
  <div class="pt-3 pb-5">
    <div class="row">
      <div class="col-lg-6 col-sm-7 text-left">
        <h1>Selamat Datang di Website PT. Kumala Central Partindo</h1>
        <h3>Banjarmasin</h3><br>
        <p>PT. Kumala Central Partindo adalah Distributor Resmi Sukucadang motor serta mobil Aspira dan Federal dari PT.Astra Otoparts</p>
        <a type="button" href="" class="btn btn-primary btn-lg">Beli Sekarang</a>  
      </div>
      <div class="col-lg-6 order-sm-2">
        <div>
          <img class="img-fluid" src="{{asset('dist/img/dashboard.png')}}" style="width: 100%;" alt="">
        </div>
      </div>
    </div>    
  </div>
</div>

<!-- Pendaftaran Rusunawa -->
<div style="background-color: #0047AB;">
  <div class="container text-left p-3">
    <div style="padding-left: 10px; padding-right: 10px;">
      <div style="color: white;">
        <h3>Pendaftaran Akun Toko Baru</h3>
      </div>
      <div style="color: #dcdddc;">
        <h6>Pendaftaran dapat dilakukan untuk toko yang sudah melakukan pengajuan</h6>
      </div>
    </div>
  </div>
</div>

<div class="container justify-content-center" style="margin-top: 100px;">
  <h3 data-aos="zoom-in-up"><b>Informasi yang Tersedia</b></h3>
<div class="underline-title mx-auto" data-aos="zoom-in-up"></div>

<div class="container">
  <div class="row">
    <div class="col-md">
      <div class="card shadow p-3 mb-5 bg-white rounded" style=" height: 300px;">
        <img class="card-img-top" src="{{ asset('dist/img/shopping.png') }}"  style="width: 50px;">
        <div class="card-body">
          <h5 class="card-title">ONLINE SHOP</h5>
          <p class="card-text">Berisi informasi mengenai ketersediaan barang yang dijual oleh PT. KCP 
            yang dapat dibeli beserta harga dan kuantitas ketersediaan.</p>   
        </div>
      </div>
    </div>
    <div class="col-md">
        <div class="card shadow p-3 mb-5 bg-white rounded"  style=" height: 300px;">
          <img class="card-img-top" src="{{ asset('dist/img/search.png') }}" style="width: 50px;">
          <div class="card-body">
            <h5 class="card-title">INFORMASI PENGAJUAN TOKO BARU</h5>
            <p class="card-text">Halaman ini dapat
              memberikan anda informasi alur sebelum mengajukan
              menjadi pembeli dari PT. KCP.</p>  
          </div>
        </div>
    </div>
    <div class="col-md">
      <div class="card shadow p-3 mb-5 bg-white rounded" style=" height: 300px;">
        <img class="card-img-top" src="{{ asset('dist/img/store.png') }}" style="width: 50px; ">
        <div class="card-body">
          <h5 class="card-title">BUAT AKUN TOKO</h5>
          <p class="card-text">Register akun untuk dapat melanjutkan
          pengajuan toko yang terdaftar dalam sistem kami.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Tentang PT Kumala Central Partindo-->
<div class="container">
  <div class="jumbotron-rusunawa" id="tentang" style="padding-top: 50px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-md-12" >
          <div class="text-left">
              <h3 data-aos="zoom-in-up"><b>Tentang PT Kumala Central Partindo</b></h3>
              <div class="underline-title mr-auto" data-aos="zoom-in-up"></div>
              <p data-aos="zoom-in-up" class="text-justify pt-3">Awal bermula PT. Kumala Central Partindo adalah <b>Trio Motor Banjarmasin</b> yang diangkat & ditunjuk oleh 
              <span style="font: bold, italic; color: blue">PT. Astra Internasional Tbk</span></p>
              selaku Distributor Resmi dari sukucadang motor Honda dengan merek SCAA ( Suku Cadang Asli Astra ) untuk wilayah Kalimantan Selatan dan Kalimantan Tengah.
            </div>             
          </div>
        <div class="col-lg-5 col-md-12">
          <div class="card" style="border-radius:  30px !important;">
            <div class="beranda-syarat text-left">
            <h4 class="beranda-syarat-judul">Syarat Mendaftar</h4>
              <ul class="beranda-syarat">
                <li class="beranda-syarat-list"><i class="fas fa-check-circle" style="padding-right: 5px; color: green;"></i></li>           
              </ul>
            </div>
          </div>
        </div>    
      </div>
    </div>  
  </div> 
</div>

<!--Rusun-->
<div class="jumbotron-lokasi" id="lokasi" style="padding-top: 100px;">
  <h3 data-aos="zoom-in-up"><b>Pilih Rusunawa</b></h3>
    <div class="underline-title mx-auto" data-aos="zoom-in-up"></div>
      <div class="container">
      
        <div class="row">
                  
        </div>
      </div>
    </div>

<!-- Alur-->
<div class="jumbotron-lokasi" id="alur" style="padding-top: 50px;">
  <h3 data-aos="zoom-in-up"><b>Alur Permohonan</b></h3>
  <div class="underline-title mx-auto" data-aos="zoom-in-up"></div>
      <div class="container">
          <div class="row content pb-5">
            <div class="col-md-5 col-sm-12">
              <img class="" src="{{ asset('masuk.jpg') }}" alt="" class="img-fluid" style="width: 40%;">
            </div>
            <div class="col-md-7 pt-5 order-2 order-md-1 text-justify">
              <h3>1. Masuk Ke Website Aplikasi Rusunawa</h3>
              <p style="font-size: 15px;">
                  Klik tombol <span style="font: bold; color: red">Login</span> untuk masuk kedalam akun anda.
              </p>
            </div>
          </div>
          <div class="row content pb-5">
            <div class="col-md-5 order-1 order-md-2">
              <img class="" src="{{ asset('form.jpg') }}" alt="" class="img-fluid" style="width: 50%;">
            </div>
            <div class="col-md-7 pt-5 order-2 order-md-1 text-right">
              <h3>2. Registrasi Akun Rusunawa</h3>
              <P style="font-size: 15px;">
                Apabila anda belum memiliki akun, <span style="font: bold; color: red">Registrasi</span> akun anda terlebih dahulu.
              </P>
            </div>
          </div>
          <div class="row content pb-5">
            <div class="col-md-5">
              <img class="" src="{{ asset('berkas.jpg') }}" alt="" class="img-fluid" style="width: 50%;">
            </div>
            <div class="col-md-7 pt-5 order-2 order-md-1 text-left">
              <h3>3. Daftarkan Permohonan Anda</h3>
              <P style="font-size: 15px;">
                  Daftarkan permohonan sewa rusun anda dan sertakan dokumen sesuai yang diperlukan.
              </P>
            </div>
          </div>
          <div class="row content pb-5">
              <div class="col-md-5 order-1 order-md-2">
                <img class="" src="{{ asset('wawancara.jpg') }}" alt="" class="img-fluid" style="width: 50%;">
              </div>
              <div class="col-md-7 pt-5 order-2 order-md-1 text-right">
                <h3>4. Wawancara dengan Verifikator</h3>
                <P style="font-size: 15px;">
                  Selanjutnya akan dihubungi melalui kontak anda untuk melakukan<br>
                  wawancara dengan membawa dokumen fisik yang diperlukan.<br>
                </P>
              </div>          
          </div>
          <div class="row content">
            <div class="col-md-5">
              <img class="" src="{{ asset('gedung.jpg') }}" alt="" class="img-fluid" style="width: 50%;">
            </div>
            <div class="col-md-7 pt-5 order-2 order-md-1 text-left">
              <h3>5. Permohonan Diterima</h3>
              <P style="font-size: 15px;">
                Anda dapat menempati rusunawa sesuai dengan hasil verifikasi dan wawancara.
              </P>
            </div>
          </div>  
      </div>
  </div>
</div>

<footer style="background-color: #4682B4; margin:0px !important;">
  <div class=" container container-fluid">
    <div class="row mb-3 pt-3">
      <div class="col-lg-2 text-center pt-2 pb-2">
        <img class="logo-footer" src="{{ asset('dist/img/logo_1.png')}}" style="width: 100px">
      </div>
      <div class="col-lg-7 text-left ">
        <div class="text footer-bawah"><h4><b>PT . Kumala Central Partindo</b></h4>
        </div>
        <div class="text footer-bawah">
          <h5><b>Rusunawa Teluk Kelayan</b></h5>
          <p>Jl. Tembus Mantuil, Kelayan Selatan, Kecamatan Banjarmasin 
          Selatan, Kota Banjarmasin, Kalimantan Selatan 70233</p>
        </div>
        <div class="text footer-bawah">
            <div class="col-11" style="padding: 0 !important">
              <b>Jam Operasional:</b></h5><br>
              <p class="font-weight-light">Senin - Jumat<br>
                Pukul 08.00 - 17.00 WITA</p>
              <p class="font-weight-light">Sabtu<br>
                Pukul 08.00 - 12.00 WITA</p>
            </div>  
        </div>
      </div>
      <div class="col-lg-3 col-sm-12">
        <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 200px">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.1195505013516!2d114.57874827505098!3d-3.3206215412339057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423cf961eb86f%3A0x2d087665bc89cc79!2sPT.%20Kumala%20Central%20Partindo!5e0!3m2!1sid!2sid!4v1710895092289!5m2!1sid!2sid" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
    <div class="col-lg-12 text-center" style="font-size: 15px;"><span>Developed by Dinas Komunikasi, Informasi dan Statistik</span> Kota Banjarmasin, 2021</div>
    </div>
  </div>
</footer> 

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
    $("a").on('click', function(event) {
  
      if (this.hash !== "") {
        event.preventDefault();
  
        var hash = this.hash;
  
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 500, function(){
     
          window.location.hash = hash;
        });
      }
    });
  });
  </script>

  <script>
    AOS.init();
  </script>
  </body>
</html>