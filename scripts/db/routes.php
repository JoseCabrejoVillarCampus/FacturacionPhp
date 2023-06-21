<?php

$router->get('/seller', 'sellerController@getAllSeller');
$router->post('/seller', 'sellerController@postSeller');
/* $router->get('/seller/{id}', 'sellerController@getSellerById'); */
$router->put('/seller/{id}', 'sellerController@putSeller');
$router->delete('/seller/{id}', 'sellerController@deleteSeller');

$router->get('/bill', 'billController@getAllBill');
$router->post('/bill', 'billController@postBill');
/* $router->get('/bill/{id}', 'billController@getBillById'); */
$router->put('/bill/{id}', 'billController@putBill');
$router->delete('/bill/{id}', 'billController@deleteBill');

$router->get('/client', 'billController@getAllClient');
$router->post('/client', 'billController@postClient');
/* $router->get('/bill/{id}', 'billController@getClientById'); */
$router->put('/client/{id}', 'billController@putClient');
$router->delete('/client/{id}', 'billController@deleteClient');

$router->get('/product', 'billController@getAllProduct');
$router->post('/product', 'billController@postProduct');
/* $router->get('/product/{id}', 'billController@getProductById'); */
$router->put('/product/{id}', 'billController@putProduct');
$router->delete('/product/{id}', 'billController@deleteProduct');
?>
