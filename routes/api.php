<?php

use App\Models\Humidity;
use App\Models\Temperature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post("/send", function (Request $request) {
    Temperature::create([
        "nilai" => $request->temperature
    ]);
    Humidity::create([
        "nilai" => $request->humidity
    ]);

    if ($request->temperature >= 40) {
        $users = User::all();
        Mail::send('mail.msg', ["temperature" => $request->temperature], function ($message) use ($users) {
            $message->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"));
            $message->to($users[0]->email);
            foreach ($users as $user) {
                if ($user->id == $users[0]->id) {
                    continue;
                }
                $message->cc($user->email);
            }
            $message->subject("Peringatan suhu tinggi");
        });
    }
    return true;
});
