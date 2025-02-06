<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\sitting;
use App\Models\Countries;
use App\Models\PinnedPages;
use App\Models\Adds;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $Settings = sitting::first();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $all_pinned_page = PinnedPages::all();
        $adds = Adds::first();
        return view('auth.registration', compact('Settings', 'country_names', 'all_pinned_page'));
        // return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'enname' => [
                'required',
                'string',
                'max:255',
                'unique:users,en_name',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],
        ], [
            'enname.required' => 'حقل اسم المستخدم مطلوب',
            'enname.regex' => 'يجب أن يحتوي حقل اسم المستخدم على أحرف ومسافات إنجليزية فقط.',
            'enname.unique' => 'تم استخدام اسم المستخدم هذا من قبل',
            'email.required' => 'حقل البريد الالكتروني مطلوب',
            'email.email' => 'عنوان البريد الالكتروني غير صالح',
            'email.unique' => 'تم استخدام البريد الالكتروني هذا من قبل',
            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.confirmed' => 'يجب تأكيد كلمة المرور',
            'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل',
            'password.regex' => 'يجب أن تحتوي كلمة المرور على حرف كبير وحرف صغير ورقم ورمز',
        ]);

        $string = $request->enname;
        if (strpos($string, ' ') !== false) {
            //   echo "String contains space between words.";

            return redirect('users/register/')->with('msg', 'لا يجب ان يحتوي اسم المستخدم على مسافات');
        } else {
            // String is not contains space between words

            $user = User::create([
                // 'name' => $request->name,
                'en_name' => $request->enname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            // Auth::login($user);


            // return redirect(RouteServiceProvider::HOME);
            return redirect()->route('loginu')->with('msg', 'تم انشاء الحساب بنجاح بإمكانك التسجيل الدخول');
        }
    }
}
