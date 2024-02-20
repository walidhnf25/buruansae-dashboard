<?php

namespace Config;

use App\Controllers\DataSayur;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
// $routes->get('/', 'DataSayur::save');
$routes->delete('/dataSayur/(:num)', 'DataSayur::delete/$1');
$routes->delete('/dataTanamanObat/(:num)', 'DataTanamanObat::delete/$1');
$routes->delete('/dataTernak/(:num)', 'DataTernak::delete/$1');
$routes->delete('/dataIkan/(:num)', 'DataIkan::delete/$1');
$routes->delete('/dataBuah/(:num)', 'DataBuah::delete/$1');
$routes->delete('/dataOlahanHasil/(:num)', 'DataOlahanHasil::delete/$1');
$routes->delete('/dataPengolahanSampah/(:num)', 'DataPengolahanSampah::delete/$1');
$routes->delete('/dataPembibitan/(:num)', 'DataPembibitan::delete/$1');
$routes->delete('/dataPembibitan/(:num)', 'DataPembibitan::delete/$1');

//Routing Data Sayur
$routes->get('/dataSayur/dataPanenSayur/(id_sayur)', 'DataSayur::dataPanenSayur/$1');
$routes->get('/dataSayur/editDataSayur/(:segment)', 'DataSayur::editDataSayur/$1');

//Routing Data Tanaman Obat
$routes->get('/dataTanamanObat/editDataTanamanObat/(:segment)', 'DataTanamanObat::editDataTanamanObat/$1');
$routes->get('/dataTanamanObat/dataPanenTanamanObat/(id_tanaman_obat)', 'DataTanamanObat::dataPanenTanamanObat/$1');

//Routing Data Ternak
$routes->get('/dataTernak/editDataTernak/(:segment)', 'DataTernak::editDataTernak/$1');
$routes->get('/dataTernak/dataPanenTernak/(id_ternak)', 'DataTernak::dataPanenTernak/$1');

//Routing Data Ikan
$routes->get('/dataIkan/editDataIkan/(:segment)', 'DataIkan::editDataIkan/$1');
$routes->get('/dataIkan/dataPanenIkan/(id_ikan)', 'DataIkan::dataPanenIkan/$1');

//Routing Data Buah
$routes->get('/dataBuah/editDataBuah/(:segment)', 'DataIkan::editDataBuah/$1');
$routes->get('/dataBuah/dataPanenBuah/(id_buah)', 'DataBuah::dataPanenBuah/$1');

//Routing Data Olahan Hasil
$routes->get('/dataOlahanHasil/editDataOlahanHasil/(:segment)', 'DataOlahanHasil::editDataOlahanHasil/$1');
$routes->get('/dataOlahanHasil/dataProduksi/(id_data_olahan_hasil)', 'DataOlahanHasil::dataProduksi/$1');

//Routing Data Olahan Produksi Sampah
$routes->get('/dataPengolahanSampah/editDataSampah/(:segment)', 'DataPengolahanSampah::editDataSampah/$1');
$routes->get('/dataPengolahanSampah/dataProduksiSampah/(id_data_sampah)', 'DataPengolahanSampah::dataProduksiSampah/$1');

//Routing Data Olahan Pembibitan
$routes->get('/dataPembibitan/editDataPembibitan/(:segment)', 'DataPembibitan::editDataPembibitan/$1');
$routes->get('/dataPembibitan/dataPanenPembibitan/(id_bibit)', 'DataPembibitan::dataPanenPembibitan/$1');

// $routes->get('/dataSayur', 'dataSayur::index');
// $routes->get('/dataSayur/(:num)', 'DataSayur::dataPanenSayur/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
