<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontController@index');

// Frontend
Route::get('pencarian-laundry','FrontController@search');

Auth::routes([
    'register' => false,
]);

Route::middleware('auth')->group(function () {
  Route::get('/home', 'HomeController@index')->name('home');

  // Modul Admin
  Route::prefix('/')->middleware('role:Admin')->group(function () {
    Route::resource('admin','Admin\AdminController');

    // Karyawan
    Route::resource('karyawan', 'Admin\KaryawanController');
    Route::get('update-status-karyawan', 'Admin\KaryawanController@updateKaryawan');
    Route::get('karyawan-create', 'Admin\KaryawanController@create');
    Route::post('karyawan-store', 'Admin\KaryawanController@store');
    Route::get('karyawan-edit/{id}', 'Admin\KaryawanController@edit');
    Route::put('karyawan-update/{id}', 'Admin\KaryawanController@update');
    Route::get('karyawan-delete/{id}', 'Admin\KaryawanController@destroy')->name('karyawan-delete');

    // Konsumen
    Route::resource('customer','Admin\CustomerController');
    Route::get('customer/{id}', 'Admin\CustomerController@detail');
    Route::get('customer-create', 'Admin\CustomerController@create');
    Route::post('customer-store', 'Admin\CustomerController@store');
    Route::get('customer-edit/{id}', 'Admin\CustomerController@edit');
    Route::put('customer-update/{id}', 'Admin\CustomerController@update');
    Route::get('customer-delete/{id}', 'Admin\CustomerController@destroy')->name('customer-delete');

    // Data Transaksi
    Route::resource('transaksi','Admin\TransaksiController');
    Route::get('filter-transaksi','Admin\TransaksiController@filtertransaksi'); // filter data transaksi by karyawan
    Route::get('invoice-customer/{invoice}','Admin\TransaksiController@invoice'); // lihat invoice

    Route::get('data-harga','Admin\FinanceController@dataharga');
    Route::post('harga-store','Admin\FinanceController@hargastore');
    Route::get('edit-harga','Admin\FinanceController@hargaedit');
    Route::put('harga-update/{id}','Admin\FinanceController@hargaupdate');
    Route::get('harga-delete/{id}','Admin\FinanceController@hargadelete');

    // Finance
    Route::get('finance','Admin\FinanceController@index')->name('finance.index');

    // Notifikasi
    Route::get('read-notification','Admin\AdminController@notif');

    // Setting
    Route::get('settings','Admin\SettingsController@setting');
    Route::put('set-target-laundry/{id}','Admin\SettingsController@set_target_laundry')->name('set-target.update');
    Route::post('add-bank','Admin\SettingsController@bank')->name('setting.bank');

    // Profile
    Route::get('profile-admin/{id}','Admin\AdminController@profile');
    Route::put('profile-admin/update/{id}','Admin\AdminController@adminProfileSave');

  });

  // Modul Karyawan
  Route::prefix('/')->middleware('role:Karyawan')->group(function () {
    Route::resource('pelayanan','Karyawan\PelayananController');
    // Transaksi
    Route::get('add-order','Karyawan\PelayananController@addorders');
    Route::get('update-status-laundry','Karyawan\PelayananController@updateStatusLaundry');

    // Konsumen
    Route::get('customers','Karyawan\CustomerController@index');
    Route::get('customers/{id}','Karyawan\CustomerController@detail');
    Route::get('customers-create','Karyawan\CustomerController@create');
    Route::post('customers-store','Karyawan\CustomerController@store');
    Route::get('customers-edit/{id}','Karyawan\CustomerController@edit');
    Route::put('customers-update/{id}','Karyawan\CustomerController@update');
    Route::get('customers-delete/{id}','Karyawan\CustomerController@destroy');

    // Filter
    Route::get('listharga','Karyawan\PelayananController@listharga');
    Route::get('listhari','Karyawan\PelayananController@listhari');

    // Laporan
    Route::get('laporan','Karyawan\LaporanController@laporan');
    Route::get('export-excel','Karyawan\LaporanController@exportExcel');

    // Invoice
    Route::get('invoice-kar/{id}','Karyawan\InvoiceController@invoicekar');
    Route::get('cetak-invoice/{id}/print','Karyawan\InvoiceController@cetakinvoice');

    // Profile
    Route::get('profile-karyawan/{id}','Karyawan\ProfileController@karyawanProfile');
    Route::put('profile-karyawan/update/{id}','Karyawan\ProfileController@karyawanProfileSave');

  });

});
