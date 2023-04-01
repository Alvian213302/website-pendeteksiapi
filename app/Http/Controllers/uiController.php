<?php

namespace App\Http\Controllers;

use App\Models\Humidity;
use App\Models\Temperature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class uiController extends Controller
{
    public function index()
    {
        $temperature = Temperature::orderBy('id', 'desc')->get()->take(10);
        $humidity = Humidity::orderBy('id', 'desc')->get()->take(10);


        return view('welcome', compact('temperature', 'humidity'));
    }
    public function location()
    {
        return view('location');
    }
    public function user()
    {
        $users = User::where("username", "!=", "admin")->get();
        return view('user', compact('users'));
    }
    public function userCreate(Request $request)
    {
        User::create([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);
        return redirect()->back()->with('pesan', 'Data berhasil ditambahkan');
    }
    public function userUpdate(User $user, Request $request)
    {
        $user->update([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->back()->with('pesan', 'Data berhasil diubah');
    }
    public function userDelete(User $user)
    {
        $user->delete();
        return redirect()->back()->with('pesan', 'Data berhasil dihapus');
    }
    public function about()
    {
        return view('about');
    }

    public function login()
    {
        return view('login');
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect("/");
        }

        return redirect("/login")->with('pesan', 'Username atau password salah');
    }

    public function logout()
    {
        auth()->logout();
        return redirect("/login");
    }

    public function updateChart()
    {
        $temperature = Temperature::orderBy('id', 'desc')->get()->take(10);
        $humidity = Humidity::orderBy('id', 'desc')->get()->take(10);

        $time = [];
        $dtTemp = [];
        foreach ($temperature as $data) {
            $time[] = $data->time;
            $dtTemp[] = $data->nilai;
        }

        $dtHum = [];
        foreach ($humidity as $data) {
            $dtHum[] = $data->nilai;
        }

        return response()->json([
            'time' => $time,
            'temperature' => $dtTemp,
            'humidity' => $dtHum
        ]);
    }

    public function updateStatus()
    {
        $data = Temperature::latest()->first();
        $status = $data->nilai < 40 ? "Aman" : "Kebakaran";

        return response()->json([
            'status' => $status
        ]);
    }

    public function updateSuhu()
    {
        $data = Temperature::latest()->first();
        $suhu = $data->nilai;

        return response()->json([
            'suhu' => $suhu
        ]);
    }
}
