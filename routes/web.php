<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\MasterRoleController;
use App\Http\Controllers\MasterPartController;
use App\Http\Controllers\MasterPartKelompokController;
use App\Http\Controllers\MasterPartKategoriController;
use App\Http\Controllers\MasterPartProdukController;
use App\Http\Controllers\MasterPartGroupController;
use App\Http\Controllers\MasterSalesController;
use App\Http\Controllers\MasterDiskonPartController;
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
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\MasterTargetController;
use App\Http\Controllers\MasterTargetSpvController;
use App\Http\Controllers\MasterTargetSpvProdukController;
use App\Http\Controllers\ReportLssController;
use App\Http\Controllers\ModalDbpController;


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

    //USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/reset/{id}', [UserController::class, 'reset'])->name('user.reset');

    //PROFIL
    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

    //INVENTARIS
    Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::post('/inventaris', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::get('/inventaris/create', [InventarisController::class, 'create'])->name('inventaris.create');
    Route::get('/inventaris/show/{id}', [InventarisController::class, 'show'])->name('inventaris.show');

    //MASTER PART
    Route::get('/master-part', [MasterPartController::class, 'index'])->name('master-part.index');
    Route::get('/master-part/create', [MasterPartController::class, 'create'])->name('master-part.create');
    Route::get('/master-part/update/{id}', [MasterPartController::class, 'edit'])->name('master-part.edit');
    Route::get('/master-part/delete/{id}', [MasterPartController::class, 'delete'])->name('master-part.delete');
    Route::get('/master-part/show/{id}', [MasterPartController::class, 'show'])->name('master-part.show');
    Route::post('/master-part/store', [MasterPartController::class, 'store'])->name('master-part.store');
    Route::post('/master-part/update/{id}', [MasterPartController::class, 'update'])->name('master-part.update');

    //MASTER PART DISKON
    Route::get('/master-diskon', [MasterDiskonPartController::class, 'index'])->name('master-diskon.index');
    Route::get('/master-diskon/create', [MasterDiskonPartController::class, 'create'])->name('master-diskon.create');
    Route::get('/master-diskon/update/{id}', [MasterDiskonPartController::class, 'edit'])->name('master-diskon.edit');
    Route::get('/master-diskon/delete/{id}', [MasterDiskonPartController::class, 'delete'])->name('master-diskon.delete');
    Route::get('/master-diskon/show/{id}', [MasterDiskonPartController::class, 'show'])->name('master-diskon.show');
    Route::post('/master-diskon/store', [MasterDiskonPartController::class, 'store'])->name('master-diskon.store');
    Route::post('/master-diskon/update/{id}', [MasterDiskonPartController::class, 'update'])->name('master-diskon.update');

    //MASTER ROLE
    Route::get('/master-role', [MasterRoleController::class, 'index'])->name('master-role.index');
    Route::get('/master-role/create', [MasterRoleController::class, 'create'])->name('master-role.create');
    Route::get('/master-role/update/{id}', [MasterRoleController::class, 'edit'])->name('master-role.edit');
    Route::get('/master-role/delete/{id}', [MasterRoleController::class, 'delete'])->name('master-role.delete');
    Route::get('/master-role/show/{id}', [MasterRoleController::class, 'show'])->name('master-role.show');
    Route::post('/master-role/store', [MasterRoleController::class, 'store'])->name('master-role.store');
    Route::post('/master-role/update/{id}', [MasterRoleController::class, 'update'])->name('master-role.update');

    //MASTER PLAFOND
    Route::get('/master-plafond', [PlafondController::class, 'index'])->name('master-plafond.index');
    Route::get('/master-plafond/details', [PlafondController::class, 'detail'])->name('master-plafond.detail');
    Route::get('/master-plafond/create', [PlafondController::class, 'create'])->name('master-plafond.create');
    Route::get('/master-plafond/show/{id}', [PlafondController::class, 'show'])->name('master-plafond.show');
    Route::post('/master-plafond/store', [PlafondController::class, 'store'])->name('master-plafond.store');

    Route::get('/part-kelompok', [MasterPartKelompokController::class, 'index'])->name('part-kelompok.index');
    Route::get('/part-kelompok/create', [MasterPartKelompokController::class, 'create'])->name('part-kelompok.create');
    Route::get('/part-kelompok/show/{id}', [MasterPartKelompokController::class, 'show'])->name('part-kelompok.show');
    Route::post('/part-kelompok/store', [MasterPartKelompokController::class, 'store'])->name('part-kelompok.store');
   
    Route::get('/part-kategori', [MasterPartKategoriController::class, 'index'])->name('part-kategori.index');
    Route::get('/part-kategori/create', [MasterPartKategoriController::class, 'create'])->name('part-kategori.create');
    Route::get('/part-kategori/show/{id}', [MasterPartKategoriController::class, 'show'])->name('part-kategori.show');
    Route::post('/part-kategori/store', [MasterPartKategoriController::class, 'store'])->name('part-kategori.store');
   
    Route::get('/part-produk', [MasterPartProdukController::class, 'index'])->name('part-produk.index');
    Route::get('/part-produk/create', [MasterPartProdukController::class, 'create'])->name('part-produk.create');
    Route::get('/part-produk/show/{id}', [MasterPartProdukController::class, 'show'])->name('part-produk.show');
    Route::post('/part-produk/store', [MasterPartProdukController::class, 'store'])->name('part-produk.store');

    Route::get('/part-group', [MasterPartGroupController::class, 'index'])->name('part-group.index');
    Route::get('/part-group/create', [MasterPartGroupController::class, 'create'])->name('part-group.create');
    Route::get('/part-group/show/{id}', [MasterPartGroupController::class, 'show'])->name('part-group.show');
    Route::post('/part-group/store', [MasterPartGroupController::class, 'store'])->name('part-group.store');

    //INTRANSIT
    Route::get('/intransit', [IntransitController::class, 'index'])->name('intransit.index');
    Route::post('/intransit', [IntransitController::class, 'store'])->name('intransit.store');
    Route::get('/intransit/create', [IntransitController::class, 'create'])->name('intransit.create');
    Route::get('/intransit/details/{id}', [IntransitController::class, 'details'])->name('intransit.details');
    Route::get('/intransit/show/{id}', [IntransitController::class, 'show'])->name('intransit.show');
    Route::post('/intransit/details/{id}', [IntransitController::class, 'store_details'])->name('intransit.store_details');
    Route::get('/intransit/validasi/{id}', [IntransitController::class, 'validasi'])->name('intransit.validasi');
    Route::get('/intransit/validasi-barang/{id}', [IntransitController::class, 'validasi_barang'])->name('intransit.validasi_barang');
    Route::get('/intransit/tambah-gudang/{id}', [IntransitController::class, 'tambah_gudang'])->name('intransit.tambah-gudang');
    Route::get('/intransit/stok-masuk/{id_intransit_header}', [IntransitController::class, 'stok_masuk'])->name('intransit.stok_masuk');
    Route::post('/intransit/store-stok-gudang/{part_no}', [IntransitController::class, 'store_stok_gudang'])->name('intransit.store_stok_gudang');

    //ROUTE PEMBELIAN
    Route::get('/pembelian-non-aop', [PembelianController::class, 'index'])->name('pembelian-non-aop.index');
    Route::get('/pembelian-non-aop/create', [PembelianController::class, 'create'])->name('pembelian-non-aop.create');
    Route::get('/pembelian-non-aop/show/{id}', [PembelianController::class, 'show'])->name('pembelian-non-aop.show');
    Route::post('/pembelian-non-aop/store', [PembelianController::class, 'store'])->name('pembelian-non-aop.store');
    Route::get('/pembelian-non-aop/detail/{id}/invoice/{invoice_non}', [PembelianController::class, 'detail'])->name('pembelian-non-aop.detail');
    Route::post('/pembelian-non-aop/store-details', [PembelianController::class, 'store_details'])->name('pembelian-non-aop.store_details');
    Route::get('/pembelian-non-aop/pembelian-details/{id}', [PembelianController::class, 'detail_pembelian'])->name('pembelian-non-aop.pembelian-details');

    //ROUTE PEMBAYARAN
    Route::get('/pembayaran-non-aop', [PembayaranController::class, 'index'])->name('pembayaran-non-aop.index');
    Route::get('/pembayaran-non-aop/pembayaran/{invoice_aop}', [PembayaranController::class, 'pembayaran'])->name('pembayaran-non-aop.pembayaran');
    Route::post('/pembayaran-non-aop/pembayaran', [PembayaranController::class, 'store_pembayaran'])->name('pembayaran-non-aop.pembayaran-store');
    Route::get('/pembayaran-non-aop/pembayaran-nota/{invoice_aop}', [PembayaranController::class, 'pembayaran_nota'])->name('pembayaran-non-aop.pembayaran-nota');
    Route::post('/pembayaran-non-aop/pembayaran-nota', [PembayaranController::class, 'store_pembayaran_balance'])->name('pembayaran-non-aop.pembayaran-store-balance');

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
    Route::get('/sales-order/edit/{id}', [SalesOrderController::class, 'edit'])->name('sales-order.edit');
    Route::post('/sales-order/update/{id}', [SalesOrderController::class, 'store_edit'])->name('sales-order.store_edit');
    Route::get('/sales-order/tolak/{noso}', [SalesOrderController::class, 'tolak'])->name('sales-order.tolak');
    
    //ROUTE BO
    Route::get('/back-order', [BackOrderController::class, 'index'])->name('back-order.index');
    Route::get('/back-order/create', [BackOrderController::class, 'create'])->name('back-order.create');
    Route::post('/back-order/store', [BackOrderController::class, 'store'])->name('back-order.store');

    //ROUTE VALIDASI SO
    Route::get('/validasi-so', [ValidasiSOController::class, 'index'])->name('validasi-so.index');
    Route::get('/validasi-so/details/{noso}', [ValidasiSOController::class, 'details'])->name('validasi-so.details');
    Route::get('/validasi-so/create', [ValidasiSOController::class, 'create'])->name('validasi-so.create');
    Route::post('/validasi-so/store', [ValidasiSOController::class, 'store'])->name('validasi-so.store');
    Route::get('/validasi-so/reset-so', [ValidasiSOController::class, 'reset'])->name('validasi-so.reset');
    Route::get('/validasi-so/reset-so-store/{noso}', [ValidasiSOController::class, 'store_reset'])->name('validasi-so.store_reset');
    Route::get('/validasi-so/validasi/{noso}', [ValidasiSOController::class, 'validasi'])->name('validasi-so.validasi');
    Route::get('/validasi-so/cetak/{noso}', [ValidasiSOController::class, 'cetak'])->name('validasi-so.cetak');
    Route::get('/validasi-so/edit/{id}', [ValidasiSOController::class, 'edit_details'])->name('validasi-so.edit_details');
    Route::post('/validasi-so/update/{id}', [ValidasiSOController::class, 'store_edit'])->name('validasi-so.store_edit');

    //ROUTE PACKINGSHEET
    Route::get('/packingsheet', [PackingSheetController::class, 'index'])->name('packingsheet.index');
    Route::get('/packingsheet/reset-packingsheet', [PackingSheetController::class, 'reset'])->name('packingsheet.reset');
    Route::get('/packingsheet/reset-label/{nops}', [PackingSheetController::class, 'reset_label'])->name('packingsheet.reset_label');
    Route::get('/packingsheet/details/{nops}', [PackingSheetController::class, 'details'])->name('packingsheet.details');
    Route::post('/packingsheet/details/', [PackingSheetController::class, 'store_packingsheet'])->name('packingsheet.store_packingsheet');
    Route::get('/packingsheet/koli/{nops}', [PackingSheetController::class, 'koli'])->name('packingsheet.koli');
    Route::post('/packingsheet/koli', [PackingSheetController::class, 'store_dus'])->name('packingsheet.store-dus');
    Route::get('/packingsheet/cetak/{nops}', [PackingSheetController::class, 'cetak'])->name('packingsheet.cetak');
    Route::get('/packingsheet/cetak-label/{nops}', [PackingSheetController::class, 'cetak_label'])->name('packingsheet.cetak_label');
    Route::get('/packingsheet/reset-packingsheet/{nops}', [PackingSheetController::class, 'store_reset'])->name('packingsheet.store_reset');
    Route::get('/packingsheet/edit/{id}', [PackingSheetController::class, 'edit_details'])->name('packingsheet.edit_details');
    Route::post('/packingsheet/update/{id}/{nops}', [PackingSheetController::class, 'store_edit'])->name('packingsheet.store_edit');

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
    Route::get('/laporan-kiriman-harian/details/{no_lkh}', [LkhController::class, 'details'])->name('laporan-kiriman-harian.details');
    Route::post('/laporan-kiriman-harian/details/{no_lkh}', [LkhController::class, 'store_details'])->name('laporan-kiriman-harian.store-details');
    Route::get('/laporan-kiriman-harian/cetak/{no_lkh}', [LkhController::class, 'cetak'])->name('laporan-kiriman-harian.cetak');
    Route::post('/laporan-kiriman-harian/store-update/{no_lkh}', [LkhController::class, 'update'])->name('laporan-kiriman-harian.update');

    //ROUTE SURAT JALAN
    Route::get('/surat-jalan', [SuratJalanController::class, 'index'])->name('surat-jalan.index');

    //ROUTE STOK GUDANG
    Route::get('/stok-gudang', [StokGudangController::class, 'index'])->name('stok-gudang.index');
    Route::post('/stok-gudang', [StokGudangController::class, 'store'])->name('stok-gudang.store');
    Route::get('/stok-gudang/create', [StokGudangController::class, 'create'])->name('stok-gudang.create');
    Route::get('/stok-gudang/delete/{id}', [StokGudangController::class, 'delete'])->name('stok-gudang.delete');
    Route::get('/stok-gudang/update/{id}', [StokGudangController::class, 'edit'])->name('stok-gudang.edit');
    Route::post('/stok-gudang/update/{id}', [StokGudangController::class, 'update'])->name('stok-gudang.update');
    Route::get('/stok-gudang/show/{id}', [StokGudangController::class, 'show'])->name('stok-gudang.show');
    Route::get('/stok-gudang/create-barang-masuk', [StokGudangController::class, 'create_barang_masuk'])->name('stok-gudang.tambah');
    Route::post('/stok-gudang/create-barang-masuk', [StokGudangController::class, 'store_barang_masuk'])->name('stok-gudang.store-barang-masuk');
    Route::get('/stok-gudang/details-barang-masuk/{id}', [StokGudangController::class, 'add_details'])->name('stok-gudang.add-details');
    Route::post('/stok-gudang/details-barang-masuk', [StokGudangController::class, 'store_add_details'])->name('stok-gudang.store_add_details');

    //ROUTE STOK GUDANG
    Route::get('/master-sales', [MasterSalesController::class, 'index'])->name('master-sales.index');
    Route::post('/master-sales/details', [MasterSalesController::class, 'store'])->name('master-sales.store');
    Route::post('/master-sales/store-details', [MasterSalesController::class, 'store_details'])->name('master-sales.store-details');
    Route::get('/master-sales/create', [MasterSalesController::class, 'create'])->name('master-sales.create');
    Route::get('/master-sales/show/{id}', [MasterSalesController::class, 'show'])->name('master-sales.show');
    Route::get('/master-sales/delete/{id}', [MasterSalesController::class, 'delete'])->name('master-sales.delete');
    Route::get('/master-sales/tambah-wilayah/{id}', [MasterSalesController::class, 'tambah_wilayah'])->name('master-sales.tambah-wilayah');

    //ROUTE MASTER PART HET
    Route::get('/master-part-het', [MasterPartHetController::class, 'index'])->name('master-part-het.index');
    Route::post('/master-part-het', [MasterPartHetController::class, 'store'])->name('master-part-het.store');
    Route::get('/master-part-het/create', [MasterPartHetController::class, 'create'])->name('master-part-het.create');

    //ROUTE AR
    Route::get('/account-receivable', [AccountReceivableController::class, 'index'])->name('account-receivable.index');
    Route::get('/account-receivable/create', [AccountReceivableController::class, 'create'])->name('account-receivable.create');
    Route::post('/account-receivable/store', [AccountReceivableController::class, 'store'])->name('account-receivable.store');

    //KAS KELUAR
    Route::get('/kas-masuk', [KasMasukController::class, 'index'])->name('kas-masuk.index');
    Route::get('/kas-masuk/bukti-bayar', [KasMasukController::class, 'bukti_bayar'])->name('kas-masuk.bukti-bayar');
    Route::get('/kas-masuk/bayar-manual', [KasMasukController::class, 'bayar_manual'])->name('kas-masuk.bayar-manual');
    Route::get('/kas-masuk/bayar-manual/details/{no_kas_masuk}', [KasMasukController::class, 'details'])->name('kas-masuk.details');
    Route::post('/kas-masuk/store-bukti-bayar', [KasMasukController::class, 'store_bukti_bayar'])->name('kas-masuk.store-bukti-bayar');
    Route::post('/kas-masuk/store', [KasMasukController::class, 'store'])->name('kas-masuk.store');
    Route::post('/kas-masuk/store-details', [KasMasukController::class, 'store_details'])->name('kas-masuk.store-details');
    Route::get('/kas-masuk/bukti-bayar', [KasMasukController::class, 'bukti_bayar'])->name('kas-masuk.bukti-bayar');
    Route::get('/kas-masuk/pembayaran-manual', [KasMasukController::class, 'pembayaran_manual'])->name('kas-masuk.bayar_manual');
    Route::get('/kas-masuk/cetak/{no_kas_masuk}', [KasMasukController::class, 'cetak'])->name('kas-masuk.cetak');

    //KAS KELUAR
    Route::get('/kas-keluar', [KasKeluarController::class, 'index'])->name('kas-keluar.index');
    Route::get('/kas-keluar/create', [KasKeluarController::class, 'create'])->name('kas-keluar.create');
    Route::post('/kas-keluar/store', [KasKeluarController::class, 'store'])->name('kas-keluar.store');
    Route::get('/kas-keluar/details/{no_keluar}', [KasKeluarController::class, 'details'])->name('kas-keluar.details');
    Route::post('/kas-keluar/store-details', [KasKeluarController::class, 'store_details'])->name('kas-keluar.store-details');
    Route::post('/kas-keluar/store-selesai', [KasKeluarController::class, 'store_kas_keluar'])->name('kas-keluar.store-selesai');
    Route::get('/kas-keluar/show/{no_keluar}', [KasKeluarController::class, 'show'])->name('kas-keluar.show');
    Route::delete('/kas-keluar/delete/{id}/{no_keluar}', [KasKeluarController::class, 'delete'])->name('kas-keluar.delete');

    //KODE RAK LOKASI
    Route::get('/kode-rak-lokasi', [KodeRakLokasiController::class, 'index'])->name('kode-rak-lokasi.index');
    Route::post('/kode-rak-lokasi', [KodeRakLokasiController::class, 'store'])->name('kode-rak-lokasi.store');
    Route::get('/kode-rak-lokasi/create', [KodeRakLokasiController::class, 'create'])->name('kode-rak-lokasi.create');
    Route::get('/kode-rak-lokasi/show/{id}', [KodeRakLokasiController::class, 'show'])->name('kode-rak-lokasi.show');
    Route::get('/kode-rak-lokasi/delete/{id}', [KodeRakLokasiController::class, 'delete'])->name('kode-rak-lokasi.delete');

    //MST. SALES ACHIVEMENTS
    Route::get('/master-target', [MasterTargetController::class, 'index'])->name('master-target.index');
    Route::post('/master-target', [MasterTargetController::class, 'store'])->name('master-target.store');
    Route::get('/master-target/create', [MasterTargetController::class, 'create'])->name('master-target.create');
    Route::get('/master-target/show/{id}', [MasterTargetController::class, 'show'])->name('master-target.show');
    Route::get('/master-target/delete/{id}', [MasterTargetController::class, 'delete'])->name('master-target.delete');

    //MST. SPV ACHIVEMENTS
    Route::get('/master-target-spv', [MasterTargetSpvController::class, 'index'])->name('master-target-spv.index');
    Route::post('/master-target-spv', [MasterTargetSpvController::class, 'store'])->name('master-target-spv.store');
    Route::get('/master-target-spv/create', [MasterTargetSpvController::class, 'create'])->name('master-target-spv.create');
    Route::get('/master-target-spv/show/{id}', [MasterTargetSpvController::class, 'show'])->name('master-target-spv.show');
    Route::get('/master-target-spv/delete/{id}', [MasterTargetSpvController::class, 'delete'])->name('master-target-spv.delete');

    //MST. SPV BY PRDOCUT ACHIVEMENTS
    Route::get('/master-target-spv-produk', [MasterTargetSpvProdukController::class, 'index'])->name('master-target-spv-produk.index');
    Route::post('/master-target-spv-produk', [MasterTargetSpvProdukController::class, 'store'])->name('master-target-spv-produk.store');
    Route::get('/master-target-spv-produk/create', [MasterTargetSpvProdukController::class, 'create'])->name('master-target-spv-produk.create');
    Route::get('/master-target-spv-produk/show/{id}', [MasterTargetSpvProdukController::class, 'show'])->name('master-target-spv-produk.show');
    Route::get('/master-target-spv-produk/edit/{id}', [MasterTargetSpvProdukController::class, 'edit'])->name('master-target-spv-produk.edit');
    Route::delete('/master-target-spv-produk/destroy/{id}', [MasterTargetSpvProdukController::class, 'destroy'])->name('master-target-spv-produk.destroy');

    //MONITORING ACH. MARKETING
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
    Route::get('/monitoring/pencapaian-sales', [MonitoringController::class, 'store'])->name('monitoring.store');
    Route::get('/monitoring/spv', [MonitoringController::class, 'spv'])->name('monitoring.spv');
    Route::get('/monitoring/pencapaian-spv', [MonitoringController::class, 'spv_store'])->name('monitoring.spv_store');
    Route::get('/monitoring/pesanan', [MonitoringController::class, 'pesanan'])->name('monitoring.pesanan');
    Route::get('/monitoring/pesanan-terjual', [MonitoringController::class, 'pesanan_store'])->name('monitoring.pesanan-store');

    //LSS
    Route::get('/report-lss', [ReportLssController::class, 'index'])->name('report-lss.index');
    Route::get('/report-lss/view', [ReportLssController::class, 'store'])->name('report-lss.store');

    //MODAL PENJUALAN
    Route::get('/modal', [ModalDbpController::class, 'index'])->name('modal.index');
    Route::post('/modal/store', [ModalDbpController::class, 'store'])->name('modal.store');

});

Route::get('/login', [LoginController::class, 'formLogin'])->name('login.formLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'formRegister'])->name('login.formRegister');




