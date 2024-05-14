<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/Home', 'Home::index');

// GET ALL INDEX
// $routes->get('/', 'Login::index');
$routes->get('/dataSayur', 'DataSayur::index');
$routes->get('/dataTanamanObat', 'DataTanamanObat::index');
$routes->get('/dataTernak', 'DataTernak::index');
$routes->get('/dataIkan', 'DataIkan::index');
$routes->get('/dataBuah', 'DataBuah::index');
$routes->get('/dataOlahanHasil', 'DataOlahanHasil::index');
$routes->get('/dataPengolahanSampah', 'DataPengolahanSampah::index');
$routes->get('/DataKelompok', 'DataKelompok::index');
$routes->get('/DataKomoditi', 'DataKomoditi::index');
$routes->get('DataPanen', 'DataPanen::index');

//Routing Data Komoditi
$routes->get('/datakomoditi', 'DataKomoditi::index');
$routes->get('/DataKomoditi/edit/(:num)', 'DataKomoditi::edit/$1');
$routes->get('/datakomoditi/edit/(:num)', 'datakomoditi::edit/$1');
$routes->post('/DataKomoditi/update/(:num)', 'DataKomoditi::update/$1');
$routes->get('/DataKomoditi/createDataKomoditi', 'DataKomoditi::createDataKomoditi');
$routes->post('/DataKomoditi/save', 'DataKomoditi::save');
$routes->delete('/DataKomoditi/delete/(:num)', 'DataKomoditi::delete/$1');

//Routing Data Kelompok
// $routes->get('/DataKelompok/editDataKelompok/(:segment)', 'DataKelompok::editDataKelompok/$1');
$routes->get('/DataKelompok/editDataKelompok/(:num)', 'DataKelompok::editDataKelompok/$1');
$routes->post('DataKelompok/update/(:num)', 'DataKelompok::update/$1');
$routes->get('/DataKelompok/tambahDataKelompok', 'DataKelompok::tambahDataKelompok');
$routes->post('/DataKelompok/save', 'DataKelompok::save');

//Routing Data Sayur
$routes->get('/dataSayur/tambahDataSayur', 'DataSayur::tambahDataSayur');
$routes->post('/dataSayur/save', 'DataSayur::save');
$routes->delete('/dataSayur/(:num)', 'DataSayur::delete/$1');
$routes->get('/dataSayur/editDataSayur/(:num)', 'DataSayur::editDataSayur/$1');
$routes->post('/dataSayur/update/(:num)', 'DataSayur::update/$1');
$routes->get('/dataSayur/dataPanenSayur/(:num)', 'DataSayur::dataPanenSayur/$1');
$routes->post('/dataSayur/updateDataPanen/(:num)', 'DataSayur::updateDataPanen/$1');

//Routing Data Tanaman Obat
$routes->get('/dataTanamanObat/tambahDataTanamanObat', 'DataTanamanObat::tambahDataTanamanObat');
$routes->post('/dataTanamanObat/save', 'DataTanamanObat::save');
$routes->delete('/dataTanamanObat/(:num)', 'DataTanamanObat::delete/$1');
$routes->get('/dataTanamanObat/editDataTanamanObat/(:num)', 'DataTanamanObat::editDataTanamanObat/$1');
$routes->post('/dataTanamanObat/update/(:num)', 'DataTanamanObat::update/$1');
$routes->get('/dataTanamanObat/dataPanenTanamanObat/(:num)', 'DataTanamanObat::dataPanenTanamanObat/$1');
$routes->post('/dataTanamanObat/updateDataPanen/(:num)', 'DataTanamanObat::updateDataPanen/$1');

//Routing Data Ternak
$routes->get('/dataTernak/tambahDataTernak', 'DataTernak::tambahDataTernak');
$routes->post('/dataTernak/save', 'DataTernak::save');
$routes->delete('/dataTernak/(:num)', 'DataTernak::delete/$1');
$routes->get('/dataTernak/editDataTernak/(:num)', 'DataTernak::editDataTernak/$1');
$routes->post('/dataTernak/update/(:num)', 'DataTernak::update/$1');
$routes->get('/dataTernak/dataPanenTernak/(:num)', 'DataTernak::dataPanenTernak/$1');
$routes->post('/dataTernak/tambah_data_panen/(:num)', 'DataTernak::tambah_data_panen/$1');

//Routing Data Ikan
$routes->get('/dataIkan/tambahDataIkan', 'DataIkan::tambahDataIkan');
$routes->post('/dataIkan/save', 'DataIkan::save');
$routes->delete('/dataIkan/(:num)', 'DataIkan::delete/$1');
$routes->get('/dataIkan/editDataIkan/(:num)', 'DataIkan::editDataIkan/$1');
$routes->post('/dataIkan/update/(:num)', 'DataIkan::update/$1');
$routes->get('/dataIkan/dataPanenIkan/(:num)', 'DataIkan::dataPanenIkan/$1');
$routes->post('/dataIkan/tambah_data_panen/(:num)', 'DataIkan::tambah_data_panen/$1');

//Routing Data Buah
$routes->get('/dataBuah/tambahDataBuah', 'DataBuah::tambahDataBuah');
$routes->post('/dataBuah/save', 'DataBuah::save');
$routes->delete('/dataBuah/(:num)', 'DataBuah::delete/$1');
$routes->get('/dataBuah/editDataBuah/(:num)', 'DataBuah::editDataBuah/$1');
$routes->post('/dataBuah/update/(:num)', 'DataBuah::update/$1');
$routes->get('/dataBuah/dataPanenBuah/(:num)', 'DataBuah::dataPanenBuah/$1');
$routes->post('/dataBuah/tambah_data_panen/(:num)', 'DataBuah::tambah_data_panen/$1');

//Routing Data Olahan Hasil
$routes->get('/dataOlahanHasil/tambahDataOlahanHasil', 'DataOlahanHasil::tambahDataOlahanHasil');
$routes->post('/dataOlahanHasil/save', 'DataOlahanHasil::save');
$routes->delete('/dataOlahanHasil/(:num)', 'DataOlahanHasil::delete/$1');
$routes->get('/dataOlahanHasil/editDataOlahanHasil/(:num)', 'DataOlahanHasil::editDataOlahanHasil/$1');
$routes->post('/dataOlahanHasil/update/(:num)', 'DataOlahanHasil::update/$1');
$routes->get('/dataOlahanHasil/dataProduksi/(:num)', 'DataOlahanHasil::dataProduksi/$1');
$routes->post('/dataOlahanHasil/tambah_data_produksi/(:num)', 'DataOlahanHasil::tambah_data_produksi/$1');

//Routing Data Olahan Produksi Sampah
$routes->get('/dataPengolahanSampah/tambahDataSampah', 'DataPengolahanSampah::tambahDataSampah');
$routes->post('/dataPengolahanSampah/save', 'DataPengolahanSampah::save');
$routes->delete('/dataPengolahanSampah/(:num)', 'DataPengolahanSampah::delete/$1');
$routes->get('/dataPengolahanSampah/editDataSampah/(:num)', 'DataPengolahanSampah::editDataSampah/$1');
$routes->post('/dataPengolahanSampah/update/(:num)', 'DataPengolahanSampah::update/$1');
$routes->get('/dataPengolahanSampah/dataProduksiSampah/(:num)', 'DataPengolahanSampah::dataProduksiSampah/$1');
$routes->post('/dataPengolahanSampah/tambah_data_produksi/(:num)', 'DataPengolahanSampah::tambah_data_produksi/$1');
