<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\sitting;
use App\Models\Countries;
use App\Models\PinnedPages;
use App\Models\Adds;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $Settings = sitting::first();
        $country_names = Countries::select('id', 'country_name','href' , 'country_flag')->get();
        $all_pinned_page = PinnedPages::all();
        $adds = Adds::first();

        return view('auth.loginn', compact('Settings', 'country_names', 'all_pinned_page'));
        // return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        // $id = Auth::user()->id;
        // return redirect()->intended(RouteServiceProvider::HOME);
        return redirect()->route('pageme.user', Auth::check() ? Auth::user()->en_name : '')->with('pass', 'تم دخول الى حسابك بنجاح');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
        // return redirect('/login');
    }
}
