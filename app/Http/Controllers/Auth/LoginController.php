<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::with(['RoleUser' => function ($query) {
            $query->where('status', 1);
        }, 'RoleUser'])
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return back()
                ->withErrors(['email' => 'Email tidak ditemukan'])
                ->withInput();
        }

        // cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['password' => 'Password salah'])
                ->withInput();
        }

        $namarole = role::where('idrole', $user->roleUser[0]->idrole)->first();

        Auth::login($user);

        // store a small set of user info in session (null-safe)
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->name ?? $user->nama,
            'user_email' => $user->email,
            'user_role' => $namarole->idrole ?? 'user',
            'user_role_name' => $namarole->nama_role ?? 'user',
            'user_status' => $user->roleUser[0]->status ?? 'active',
        ]);

        $userRole = $user->roleUser[0]->idrole ?? null;

        switch ($userRole) {
            case 1:
                return redirect()->route('admin.index')->with('success', 'Login berhasil');
            case 2:
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil');
            case 3:
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil');
            case 4:
                return redirect()->route('resepsionis.index')->with('success', 'Login berhasil');
            default: // pemilik or unknown
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('logout_success', 'Logout berhasil');
    }
}
