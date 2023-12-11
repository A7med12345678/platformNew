<?php

namespace App\Http\Controllers\Auth;

use App\Services\SpecialLogService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    // login via mail or phone : 
    protected function username()
    {
        $login = request()->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        request()->merge([$field => $login]);
        return $field;
    }

    protected function authenticated($user)
    {

        // dispatch(new SpecialLoginJob(Auth::user()->id, Auth::user()->name, 1, "login success"));

        $user = Auth::user();
        $user->session_id = session()->getId();
        $user->save();

        SpecialLogService::createLog('3', "login success");

        if (Auth::user()->role === 'admin' || Auth::user()->role == 'Sadmin') {
            return redirect()->route('adminDashboard');
        } else if (Auth::user()->role === 'studnt') {
            return redirect()->route('home');
        }
        return redirect()->route('login')->withErrors(['error' => 'Invalid credentials']);

    }

    protected function sendFailedLoginResponse()
    {
        SpecialLogService::createLog('3', 'login fail : ' . request('email') . ', Password: ' . request('password'));

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function logout(\Illuminate\Http\Request $request)
    {

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
