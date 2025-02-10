<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return response($user->createToken($request->device_name)->plainTextToken)->header('Content-Type','application/json');
});


Route::controller(\App\Http\Controllers\API\MobileController::class)->group(function(){
    Route::post('/items', 'store_acte');
})->middleware(['auth:sanctum']);

Route::get('/livraisons/{type}/{id}/check-status', [
    \App\Http\Controllers\API\LivraisonController::class,
    'checkStatus',
])->middleware(['auth:sanctum']);
