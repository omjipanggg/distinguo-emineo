<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated(Request $request, $user) {
        if ($user->hasRole(1)) {
            return redirect()->route('dashboard.index');
        }
        return redirect($this->redirectPath())->with([
            'code' => 200,
            'status' => 'Login'
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function logout(Request $request) {
        if ($this->guard()->check()) {
            $this->guard()->logout();
        }

        $request->session()->invalidate();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson() ? new JsonResponse([], 204) : redirect()->route('home.index');
    }

    protected function loggedOut(Request $request) {
        alert()->success('Sukses', 'Sesi Anda telah berakhir.');
        return redirect()->route('home.index');
    }
}
