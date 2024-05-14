<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // if ($user->hasRole('admin')) {
        //     return redirect()->route('dashboard');
        // } elseif ($user->hasRole('operator')) {
        //     return redirect()->route('operator');
        // }
        // return redirect()->route('home');

        if ($user->hasRole('admin')) {
            $data = [
                'title' => 'Admin Page',
                'posts' => User::paginate(5)
            ];
            return view('admin.admin', $data);
        } elseif($user->hasRole('operator')) {
            $data = [
                'title' => 'Operator',
                'posts' => User::paginate(5)
            ];
            return redirect()->route('operator', $data);
        }elseif($user->hasRole('user')) {
            $data = [
                'title' => 'User',
                'posts' => User::paginate(5)
            ];
            return redirect()->route('home', $data);
        }
    }
}
