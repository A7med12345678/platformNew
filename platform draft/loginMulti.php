/**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


// protected function authenticated($user)
    // {

    //     // dispatch(new SpecialLoginJob(Auth::user()->id, Auth::user()->name, 1, "login success"));

    //     SpecialLogService::createLog('3', "login success");

    //     if (Auth::user()->role === 'admin' || Auth::user()->role == 'Sadmin') {
    //         return redirect()->route('Admin.index');
    //     } else if (Auth::user()->role === 'studnt') {
    //         return redirect()->route('home');
    //     }
    //     return redirect()->route('login')->withErrors(['error' => 'Invalid credentials']);

    // }



    // Override the logout method to update "last seen" timestamp when user logs out
    // public function logout(\Illuminate\Http\Request $request)
    // {
    //     // if (Auth::check()) {
    //     //     Auth::user()->update(['last_seen' => '0']);
    //     // }

    //     $this->guard()->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return $this->loggedOut($request) ?: redirect('/');
    // }