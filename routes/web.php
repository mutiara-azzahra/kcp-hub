<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\MasterPartController;
use App\Http\Controllers\MasterPartKelompokController;
use App\Http\Controllers\MasterPartKategoriController;
use App\Http\Controllers\MasterPartProdukController;
use App\Http\Controllers\MasterPartGroupController;
use App\Http\Controllers\MasterSalesController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SuratPesananController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\BackOrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\IntransitController;
use App\Http\Controllers\ValidasiSOController;
use App\Http\Controllers\StokGudangController;
use App\Http\Controllers\MasterPartHetController;
use App\Http\Controllers\PackingSheetController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\LkhController;
use App\Http\Controllers\PlafondController;
use App\Http\Controllers\AccountReceivableController;
use App\Http\Controllers\KasKeluarController;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\KodeRakLokasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');

    //INVENTARIS
    Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::post('/inventaris', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::get('/inventaris/create', [InventarisController::class, 'create'])->name('inventaris.create');
    Route::get('/inventaris/show/{id}', [InventarisController::class, 'show'])->name('inventaris.show');

    //MASTER PART
    Route::get('/master-part', [MasterPartController::class, 'index'])->name('master-part.index');
    Route::post('/master-part', [MasterPartController::class, 'store'])->name('master-part.store');
    Route::get('/master-part/create', [MasterPartController::class, 'create'])->name('master-part.create');
    Route::get('/master-part/update/{id}', [MasterPartController::class, 'edit'])->name('master-part.edit');
    Route::get('/master-part/delete/{id}', [MasterPartController::class, 'delete'])->name('master-part.delete');
    Route::get('/master-part/show/{id}', [MasterPartController::class, 'show'])->name('master-part.show');
    Route::post('/master-part/store', [MasterPartController::class, 'store'])->name('master-part.store');
    Route::post('/master-part/update/{id}', [MasterPartController::class, 'update'])->name('master-part.update');

    //MASTER PLAFOND
    Route::get('/master-plafond', [PlafondController::class, 'index'])->name('master-plafond.index');
    Route::post('/master-plafond', [PlafondController::class, 'store'])->name('master-plafond.store');
    Route::get('/master-plafond/create', [PlafondController::class, 'create'])->name('master-plafond.create');
    Route::get('/master-plafond/show/{id}', [PlafondController::class, 'show'])->name('master-plafond.show');
    Route::post('/master-plafond/store', [PlafondController::class, 'store'])->name('master-plafond.store');

    Route::get('/part-kelompok', [MasterPartKelompokController::class, 'index'])->name('part-kelompok.index');
    Route::post('/part-kelompok', [MasterPartKelompokController::class, 'store'])->name('part-kelompok.store');
    Route::get('/part-kelompok/create', [MasterPartKelompokController::class, 'create'])->name('part-kelompok.create');
    Route::get('/part-kelompok/show/{id}', [MasterPartKelompokController::class, 'show'])->name('part-kelompok.show');
    Route::post('/part-kelompok/store', [MasterPartKelompokController::class, 'store'])->name('part-kelompok.store');
   
    Route::get('/part-kategori', [MasterPartKategoriController::class, 'index'])->name('part-kategori.index');
    Route::post('/part-kategori', [MasterPartKategoriController::class, 'store'])->name('part-kategori.store');
    Route::get('/part-kategori/create', [MasterPartKategoriController::class, 'create'])->name('part-kategori.create');
    Route::get('/part-kategori/show/{id}', [MasterPartKategoriController::class, 'show'])->name('part-kategori.show');
    Route::post('/part-kategori/store', [MasterPartKategoriController::class, 'store'])->name('part-kategori.store');
   
    Route::get('/part-produk', [MasterPartProdukController::class, 'index'])->name('part-produk.index');
    Route::post('/part-produk', [MasterPartProdukController::class, 'store'])->name('part-produk.store');
    Route::get('/part-produk/create', [MasterPartProdukController::class, 'create'])->name('part-produk.create');
    Route::get('/part-produk/show/{id}', [MasterPartProdukController::class, 'show'])->name('part-produk.show');
    Route::post('/part-produk/store', [MasterPartProdukController::class, 'store'])->name('part-produk.store');

    Route::get('/part-group', [MasterPartGroupController::class, 'index'])->name('part-group.index');
    Route::post('/part-group', [MasterPartGroupController::class, 'store'])->name('part-group.store');
    Route::get('/part-group/create', [MasterPartGroupController::class, 'create'])->name('part-group.create');
    Route::get('/part-group/show/{id}', [MasterPartGroupController::class, 'show'])->name('part-group.show');
    Route::post('/part-group/store', [MasterPartGroupController::class, 'store'])->name('part-group.store');

    //INTRANSIT
    Route::get('/intransit', [IntransitController::class, 'index'])->name('intransit.index');
    Route::post('/intransit', [IntransitController::class, 'store'])->name('intransit.store');
    Route::get('/intransit/create', [IntransitController::class, 'create'])->name('intransit.create');
    Route::get('/intransit/details/{id}', [IntransitController::class, 'details'])->name('intransit.details');
    Route::get('/intransit/show/{id}', [IntransitController::class, 'show'])->name('intransit.show');
    Route::post('/intransit/details', [IntransitController::class, 'store_details'])->name('intransit.store_details');
    Route::get('/intransit/validasi/{id}', [IntransitController::class, 'validasi'])->name('intransit.validasi');
    Route::get('/intransit/validasi-barang/{id}', [IntransitController::class, 'validasi_barang'])->name('intransit.validasi_barang');
    Route::get('/intransit/tambah-gudang/{id}', [IntransitController::class, 'tambah_gudang'])->name('intransit.tambah-gudang');
    Route::get('/intransit/stok-masuk/{id_intransit_header}', [IntransitController::class, 'stok_masuk'])->name('intransit.stok_masuk');
    Route::post('/intransit/store-stok-gudang/{part_no}', [IntransitController::class, 'store_stok_gudang'])->name('intransit.store_stok_gudang');

    //ROUTE PEMBELIAN
    Route::get('/pembelian-non-aop', [PembelianController::class, 'index'])->name('pembelian-non-aop.index');
    Route::post('/pembelian-non-aop', [PembelianController::class, 'store'])->name('pembelian-non-aop.store');
    Route::get('/pembelian-non-aop/create', [PembelianController::class, 'create'])->name('pembelian-non-aop.create');
    Route::get('/pembelian-non-aop/show/{id}', [PembelianController::class, 'show'])->name('pembelian-non-aop.show');
    Route::post('/pembelian-non-aop/store', [PembelianController::class, 'store'])->name('pembelian-non-aop.store');
    Route::get('/pembelian-non-aop/detail/{id}', [PembelianController::class, 'detail'])->name('pembelian-non-aop.detail');
    Route::post('/pembelian-non-aop/store-details', [PembelianController::class, 'store_details'])->name('pembelian-non-aop.store_details');
    Route::get('/pembelian-non-aop/pembelian-details/{invoice_non}', [PembelianController::class, 'detail_pembelian'])->name('pembelian-non-aop.pembelian-details');

    //ROUTE PEMBAYARAN
    Route::get('/pembayaran-non-aop', [PembayaranController::class, 'index'])->name('pembayaran-non-aop.index');
    Route::get('/pembayaran-non-aop/pembayaran/{invoice_aop}', [PembayaranController::class, 'pembayaran'])->name('pembayaran-non-aop.pembayaran');
    Route::post('/pembayaran-non-aop/pembayaran', [PembayaranController::class, 'store_pembayaran'])->name('pembayaran-non-aop.pembayaran-store');

    //ROUTE SP
    Route::get('/surat-pesanan', [SuratPesananController::class, 'index'])->name('surat-pesanan.index');
    Route::get('/surat-pesanan/create', [SuratPesananController::class, 'create'])->name('surat-pesanan.create');
    Route::post('/surat-pesanan/create', [SuratPesananController::class, 'store'])->name('surat-pesanan.store');
    Route::post('/surat-pesanan/detail/nosp', [SuratPesananController::class, 'store_details'])->name('surat-pesanan.store_details');
    Route::get('/surat-pesanan/detail/nosp/{nosp}', [SuratPesananController::class, 'detail'])->name('surat-pesanan.detail');

    //ROUTE SO
    Route::get('/sales-order', [SalesOrderController::class, 'index'])->name('sales-order.index');
    Route::get('/sales-order/create', [SalesOrderController::class, 'create'])->name('sales-order.create');
    Route::get('/sales-order/details/{nosp}', [SalesOrderController::class, 'details'])->name('sales-order.details');
    Route::post('/sales-order/create', [SalesOrderController::class, 'store'])->name('sales-order.store');
    Route::get('/sales-order/approve/{nosp}', [SalesOrderController::class, 'approve'])->name('sales-order.approve');
    Route::get('/sales-order/reject/{nosp}', [SalesOrderController::class, 'reject'])->name('sales-order.reject');
    Route::get('/sales-order/list-approved-so', [SalesOrderController::class, 'so_approved'])->name('sales-order.approved');
    Route::get('/sales-order/list-rejected-so', [SalesOrderController::class, 'so_rejected'])->name('sales-order.rejected');

    //ROUTE BO
    Route::get('/back-order', [BackOrderController::class, 'index'])->name('back-order.index');
    Route::get('/back-order/create', [BackOrderController::class, 'create'])->name('back-order.create');
    Route::post('/back-order/store', [BackOrderController::class, 'store'])->name('back-order.store');

    //ROUTE VALIDASI SO
    Route::get('/validasi-so', [ValidasiSOController::class, 'index'])->name('validasi-so.index');
    Route::get('/validasi-so/details/{noso}', [ValidasiSOController::class, 'details'])->name('validasi-so.details');
    Route::get('/validasi-so/create', [ValidasiSOController::class, 'create'])->name('validasi-so.create');
    Route::post('/validasi-so/store', [ValidasiSOController::class, 'store'])->name('validasi-so.store');
    Route::post('/validasi-so/reset-so', [ValidasiSOController::class, 'reset'])->name('validasi-so.reset');
    Route::get('/validasi-so/validasi/{noso}', [ValidasiSOController::class, 'validasi'])->name('validasi-so.validasi');

    //ROUTE PACKINGSHEET
    Route::get('/packingsheet', [PackingSheetController::class, 'index'])->name('packingsheet.index');
    Route::get('/packingsheet/reset-packingsheet', [PackingSheetController::class, 'reset'])->name('packingsheet.reset');
    Route::get('/packingsheet/details/{nops}', [PackingSheetController::class, 'details'])->name('packingsheet.details');
    Route::post('/packingsheet/details/', [PackingSheetController::class, 'store_packingsheet'])->name('packingsheet.store_packingsheet');
    Route::get('/packingsheet/cetak', [PackingSheetController::class, 'cetak'])->name('packingsheet.cetak');
    Route::get('/packingsheet/koli/{nops}', [PackingSheetController::class, 'koli'])->name('packingsheet.koli');
    Route::post('/packingsheet/koli', [PackingSheetController::class, 'store_dus'])->name('packingsheet.store-dus');
    Route::get('/packingsheet/cetak/{nops}', [PackingSheetController::class, 'cetak'])->name('packingsheet.cetak');
    Route::get('/packingsheet/cetak-label/{nops}', [PackingSheetController::class, 'cetak_label'])->name('packingsheet.cetak_label');

    //ROUTE INVOICE
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/invoice/create', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/invoice/approve/{noso}', [InvoiceController::class, 'approve'])->name('invoice.approve');
    Route::get('/invoice/reject/{noso}', [InvoiceController::class, 'reject'])->name('invoice.reject');
    Route::get('/invoice/cetak/{noinv}', [InvoiceController::class, 'cetak'])->name('invoice.cetak');

    //ROUTE SURAT JALAN
    Route::get('/surat-jalan', [SuratJalanController::class, 'index'])->name('surat-jalan.index');
    Route::get('/surat-jalan/reset', [SuratJalanController::class, 'reset'])->name('surat-jalan.reset');
    Route::post('/surat-jalan/store', [SuratJalanController::class, 'store_sj'])->name('surat-jalan.store_sj');
    Route::get('/surat-jalan/approve/{noso}', [SuratJalanController::class, 'approve'])->name('surat-jalan.approve');
    Route::get('/surat-jalan/reject/{noso}', [SuratJalanController::class, 'reject'])->name('surat-jalan.reject');
    Route::get('/surat-jalan/cetak/{nosj}', [SuratJalanController::class, 'cetak'])->name('surat-jalan.cetak');

    //ROUTE LKH
    Route::get('/laporan-kiriman-harian', [LkhController::class, 'index'])->name('laporan-kiriman-harian.index');
    Route::get('/laporan-kiriman-harian/create', [LkhController::class, 'create'])->name('laporan-kiriman-harian.create');
    Route::post('/laporan-kiriman-harian/store', [LkhController::class, 'store'])->name('laporan-kiriman-harian.store');
    Route::get('/laporan-kiriman-harian/approve/{noso}', [LkhController::class, 'approve'])->name('laporan-kiriman-harian.approve');
    Route::get('/laporan-kiriman-harian/reject/{noso}', [LkhController::class, 'reject'])->name('laporan-kiriman-harian.reject');
    Route::get('/laporan-kiriman-harian/cetak/{noinv}', [LkhController::class, 'cetak'])->name('laporan-kiriman-harian.cetak');
    Route::get('/laporan-kiriman-harian/details/{no_lkh}', [LkhController::class, 'details'])->name('laporan-kiriman-harian.details');
    Route::post('/laporan-kiriman-harian/details/{no_lkh}', [LkhController::class, 'store_details'])->name('laporan-kiriman-harian.store-details');
    Route::get('/laporan-kiriman-harian/cetak/{no_lkh}', [LkhController::class, 'cetak'])->name('laporan-kiriman-harian.cetak');

    //ROUTE SURAT JALAN
    Route::get('/surat-jalan', [SuratJalanController::class, 'index'])->name('surat-jalan.index');

    //ROUTE STOK GUDANG
    Route::get('/stok-gudang', [StokGudangController::class, 'index'])->name('stok-gudang.index');
    Route::post('/stok-gudang', [StokGudangController::class, 'store'])->name('stok-gudang.store');
    Route::get('/stok-gudang/create', [StokGudangController::class, 'create'])->name('stok-gudang.create');
    Route::get('/stok-gudang/delete/{id}', [StokGudangController::class, 'delete'])->name('stok-gudang.delete');
    Route::get('/stok-gudang/update/{id}', [StokGudangController::class, 'edit'])->name('stok-gudang.edit');
    Route::post('/stok-gudang/update/{id}', [StokGudangController::class, 'update'])->name('stok-gudang.update');

    //ROUTE STOK GUDANG
    Route::get('/master-sales', [MasterSalesController::class, 'index'])->name('master-sales.index');
    Route::post('/master-sales', [MasterSalesController::class, 'store'])->name('master-sales.store');
    Route::get('/master-sales/create', [MasterSalesController::class, 'create'])->name('master-sales.create');
    Route::get('/master-sales/show/{id}', [MasterSalesController::class, 'show'])->name('master-sales.show');
    Route::get('/master-sales/delete/{id}', [MasterSalesController::class, 'delete'])->name('master-sales.delete');
    Route::get('/master-sales/tambah-wilayah/{id}', [MasterSalesController::class, 'tambah_wilayah'])->name('master-sales.tambah-wilayah');

    //ROUTE STOK GUDANG
    Route::get('/master-part-het', [MasterPartHetController::class, 'index'])->name('master-part-het.index');
    Route::post('/master-part-het', [MasterPartHetController::class, 'store'])->name('master-part-het.store');
    Route::get('/master-part-het/create', [MasterPartHetController::class, 'create'])->name('master-part-het.create');

    //ROUTE AR
    Route::get('/account-receivable', [AccountReceivableController::class, 'index'])->name('account-receivable.index');
    Route::get('/account-receivable/create', [AccountReceivableController::class, 'create'])->name('account-receivable.create');
    Route::post('/account-receivable/store', [AccountReceivableController::class, 'store'])->name('account-receivable.store');

    //KAS KELUAR
    Route::get('/kas-keluar', [KasKeluarController::class, 'index'])->name('kas-keluar.index');
    Route::get('/kas-keluar/create', [KasKeluarController::class, 'create'])->name('kas-keluar.create');
    Route::post('/kas-keluar/store', [KasKeluarController::class, 'store'])->name('kas-keluar.store');

    //KODE RAK LOKASI
    Route::get('/kode-rak-lokasi', [KodeRakLokasiController::class, 'index'])->name('kode-rak-lokasi.index');
    Route::post('/kode-rak-lokasi', [KodeRakLokasiController::class, 'store'])->name('kode-rak-lokasi.store');
    Route::get('/kode-rak-lokasi/create', [KodeRakLokasiController::class, 'create'])->name('kode-rak-lokasi.create');
    Route::get('/kode-rak-lokasi/show/{id}', [KodeRakLokasiController::class, 'show'])->name('kode-rak-lokasi.show');
    Route::get('/kode-rak-lokasi/delete/{id}', [KodeRakLokasiController::class, 'delete'])->name('kode-rak-lokasi.delete');
    
});

Route::get('/login', [LoginController::class, 'formLogin'])->name('login.formLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'formRegister'])->name('login.formRegister');




