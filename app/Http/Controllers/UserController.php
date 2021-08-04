<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Mail\ForgetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function home()
    {
        return 'home';
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        try {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];

            if (Auth::attempt($credentials)) {
                Auth::logoutOtherDevices($request->input('password'));
                /* Fez autenticação */
                $user = auth()->user();
                Auth::login($user);
                session()->flash('success', 'Welcome, we glad to see you here.');
                if (session('success')) {
                    Alert::toast(session('success'), 'success');
                }
                return redirect()->route('auth.home');
            }
            session()->flash('warning', 'Email or Password invalid.');
            if (session('warning')) {
                Alert::toast(session('warning'), 'warning');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', "Ops! There's an error.");
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }
    public function register()
    {
        return view('auth.register');
    }
    public function auth_register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            session()->flash('success', 'Account created successfully.');
            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }
            return redirect()->route('auth.login');
        } catch (\Exception $e) {
            session()->flash('error', "Ops! There's an error.");
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function forget_password()
    {
        return view('auth.forget-password');
    }

    public function auth_forget_password(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        try {

            if ($user) {
                $email = $user->email;
                $url = URL::temporarySignedRoute(
                    'reset.password',
                    now()->addHours(1),
                    ['id' => encrypt($user->id)]
                );
                session()->put('url', $url);
                session()->flash('success', 'We sent a link to your email.');
                if (session('success')) {
                    Alert::toast(session('success'), 'success');
                }
                Mail::to($email)->send(new ForgetPassword($user));
                return redirect()->back()->withInput($request->all());
            }
            session()->flash('warning', "We can't find this email. Try again.");
            if (session('warning')) {
                Alert::toast(session('warning'), 'warning');
            }
            return redirect()->back()->withInput($request->all());
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back()->withInput($request->all());
        }
    }

    public function reset_password(Request $request, $id)
    {
        try {
            $user = User::find(decrypt($id));
            if (!$request->hasValidSignature()) {
                if (session()->has('url')) {
                    session()->forget('url');
                }
                session()->flash('error', "Link is invalid. Send it again");
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->route('forget.password');
            }
            return view('auth.reset-password', compact('user'));
        } catch (\Exception $e) {
            session()->flash('error', "Ops! There's an error.");
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->route('forget.password');
        }
    }
    public function auth_reset_password(Request $request)
    {
        try {
            if ($request->input('confirmPassword') == $request->input('password')) {
                $user = User::where('email', $request->input('email'))->first();
                $user->password = Hash::make($request->input('password'));
                $user->save();

                session()->flash('success', "Password reset successfully");
                if (session('success')) {
                    Alert::toast(session('success'), 'success');
                }
                return redirect()->route('login');
            }
            session()->flash('error', "Password must be the same.");
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back()->withInput($request->all());
        } catch (\Exception $e) {
            session()->flash('error', "Ops! There's an error.");
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back()->withInput($request->all());
        }
    }
}
