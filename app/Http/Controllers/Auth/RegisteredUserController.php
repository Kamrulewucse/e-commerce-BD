<?php

namespace App\Http\Controllers\Auth;

use App\Enumeration\Role;
use App\Http\Controllers\Controller;
use App\Mail\NewsLetter;
use App\Mail\UserRegisterVerification;
use App\Models\Country;
use App\Models\NewsLetterList;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }
    public function personalInformation(Request $request)
    {
        if (!$request->session()->has('user_register_info')) {
            return redirect()->route('register');
        }elseif ($request->session()->has('user_register_info')){
            $user_register_info = $request->session()->get('user_register_info');
            if ($user_register_info['step'] == 2){
                return redirect()->route('register_verification');
            }
        }

        //$user_register_info = $request->session()->get('user_register_info');

        $countries = Country::all();
        return view('auth.register_personal_information',compact('countries'));
    }
    public function registerVerification(Request $request)
    {
        if (!$request->session()->has('user_register_info')) {
            return redirect()->route('register');
        }elseif ($request->session()->get('user_register_info')['step'] == 2){
            $user_register_info = $request->session()->get('user_register_info');
            return view('auth.register_email_verification',compact('user_register_info'));

        }elseif ($request->session()->get('user_register_info')['step'] == 1){
            return view('auth.register_personal_information');

        }else{
            return redirect()->route('register');
        }

    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeEmailConfirmation(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'email_confirmation' => ['required', 'same:email'],
        ]);

        $checkUser = User::where('email',$request->email)->first();

        if ($checkUser && $checkUser->status == 1){
            return redirect()->back()
                ->withInput()
                ->with('error','You are already registered');
        }elseif ($checkUser && $checkUser->status == 0){
            $userInfo = [
                'id'=>$checkUser->id,
                'email'=>$checkUser->email,
                'step'=>1,
            ];
            Session::put('user_register_info',$userInfo);

            return redirect()->route('register_personal_information');
        }else{
            $checkUser = User::create([
                'role' => Role::$BUYER,
                'wishlist' => json_encode(array()),
                'email' => $request->email,
            ]);
            $userInfo = [
                'id'=>$checkUser->id,
                'email'=>$checkUser->email,
                'step'=>1,
            ];
            Session::put('user_register_info',$userInfo);
            return redirect()->route('register_personal_information');
        }

    }
    public function storePersonalInformation(Request $request)
    {

        $request->validate([
            'title' => ['required'],
            'first_name' => ['required','max:255'],
            'last_name' => ['required','max:255'],
            'country' => ['required'],
            'agree' => ['nullable'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        if (!$request->session()->has('user_register_info')) {
            return redirect()->route('register');
        }
        $user_register_info = $request->session()->get('user_register_info');

        $checkUser = User::where('id',$user_register_info['id'])->first();

        if ($checkUser && $checkUser->status == 1){
            return redirect()->route('register')
                ->withInput()
                ->with('error','You are already registered');
        }else

            $checkUser->title = $request->title != 'null' ? $request->title : '';
            $checkUser->name = $request->first_name.' '.$request->last_name;
            $checkUser->first_name = $request->first_name;
            $checkUser->last_name = $request->last_name;
            $checkUser->password = bcrypt($request->password);
            $checkUser->country_id = $request->country;
            $checkUser->verification_code = rand(10000,99999);
            $checkUser->save();

            if ($request->agree){
                $checkNewsLetter = NewsLetterList::where('email',$checkUser->email)->first();
                if ($checkNewsLetter)
                    $checkNewsLetter->delete();

                $newsLetterList = new NewsLetterList();
                $newsLetterList->sub_name = $request->title;
                $newsLetterList->first_name = $request->first_name;
                $newsLetterList->last_name = $request->last_name;
                $newsLetterList->country_id = $request->country;
                $newsLetterList->email = $checkUser->email;
                $newsLetterList->verification_email = $checkUser->email;
                $newsLetterList->privacy_policy = 'on';
                $newsLetterList->save();

                $subject = "Bangladesh Drip Newsletter Subscription";
                Mail::to([$checkUser->email,'ctashiqkhan@gmail.com'])
                    ->send(new NewsLetter($newsLetterList, $subject));

            }
        $subject = "MyBD account activation";
        Mail::to([$checkUser->email,'ctashiqkhan@gmail.com'])
            ->send(new UserRegisterVerification($checkUser, $subject));

            $userInfo = [
                'id'=>$checkUser->id,
                'email'=>$checkUser->email,
                'step'=>2,
            ];
            Session::put('user_register_info',$userInfo);

            return redirect()->route('register_verification');

    }
    public function storeRegisterVerification(Request $request)
    {

        $request->validate([
            'activation_code' => ['required','min:5','max:5'],
        ]);
        if (!$request->session()->has('user_register_info')) {
            return redirect()->route('register');
        }elseif ($request->session()->has('user_register_info')){
            $user_register_info = $request->session()->get('user_register_info');
            if ($user_register_info['step'] == 1){
                return redirect()->route('register_personal_information');
            }
        }
        $user_register_info = $request->session()->get('user_register_info');

        $checkUser = User::where('id',$user_register_info['id'])->first();

        if ($checkUser && $checkUser->status == 1){
            return redirect()->route('register')
                ->withInput()
                ->with('error','You are already registered');
        }else
            if ($checkUser->verification_code != $request->activation_code){
                return redirect()->back()
                    ->withInput()
                    ->with('error','This code is incorrect. Please try again !');
            }else{
                $checkUser->verification_code = null;
                $checkUser->status = 1;
                $checkUser->save();
            }

            Session::put('user_register_info',[]);

            event(new Registered($checkUser));

            Auth::login($checkUser);

        return redirect()->route('account_details')
            ->with('message','Your account active successfully');

    }
    
    public function registerVerificationReSend(Request $request)
    {

        if (!$request->session()->has('user_register_info')) {
            return redirect()->route('register');

        }elseif ($request->session()->get('user_register_info')['step'] == 2){
            $user_register_info = $request->session()->get('user_register_info');
            $checkUser = User::where('id',$user_register_info['id'])->first();

            if ($checkUser && $checkUser->status == 1){
                return redirect()->route('register')
                    ->withInput()
                    ->with('error','You are already registered');
            }

            $checkUser->verification_code = rand(10000,99999);
            $checkUser->save();

            $subject = "MyBD Account Activation";
            Mail::to([$checkUser->email,'ctashiqkhan@gmail.com'])
                ->send(new UserRegisterVerification($checkUser, $subject));


            return redirect()->route('register_verification',
                compact('user_register_info'))
                ->with('again_send','A new code has been sent to you.');

        }elseif ($request->session()->get('user_register_info')['step'] == 1){
            return view('auth.register_personal_information');

        }else{
            return redirect()->route('register');
        }


    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile_no' => ['required', 'unique:users'],
            'username' => ['required', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'role' => Role::$BUYER,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'username' => $request->username,
            'wishlist' => json_encode(array()),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
