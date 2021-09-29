<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/paymentresult', 'API\PaymentWallController');

Route::apiResource('/paymentresultmp', 'API\PaymentWallControllerMP');

Route::apiResource('/paymentresulttest', 'API\PaymentWallControllerTest');

Route::apiResource('/payment-paysera', 'API\PayseraController');

Route::apiResource('/paymentshare', 'API\FlutterWaveController');

Route::post('/paymentsharebuy', 'API\FlutterWaveController@sharebuy');

// Route::middleware('auth:api')->get('/test', function (Request $request) {
//     return "ssss";
//     // $request->user();
// });

//Route::get('api/gatewaycode', 'GatewayController@index');
