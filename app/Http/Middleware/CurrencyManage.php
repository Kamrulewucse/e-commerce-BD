<?php

namespace App\Http\Middleware;

use App\Models\Tracker;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class CurrencyManage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        $track = Tracker::where('ip',$_SERVER['REMOTE_ADDR'])->first();
        //dd($track);
        if ($track){
            if ($track->lang){
                App::setLocale($track->lang);
                session()->put('locale',$track->lang);
                session()->put('currency',$track->currency);
                session()->put('language_currency',$track->language_currency);
            }
            return $next($request);
        }else{
            $tracker = new Tracker();
            $tracker->ip = $_SERVER['REMOTE_ADDR'];
            $tracker->date = date('Y-m-d');
            $tracker->save();

            //$previousUrl = url()->previous();
            return redirect()->route('dispatch');

   //old code
            //$currentLocale = \Session::all();

//            $currentLocale = $request->session()->get('locale');
//
//            if (!$currentLocale){
//                return redirect()->route('dispatch');
//            }
//            return $next($request);
        }
    }
}
