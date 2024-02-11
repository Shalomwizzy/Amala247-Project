<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome(){
        return view('pages.welcome');
    }

    public function menu(){
        return view('pages.menu');
    }

    public function aboutUs(){
        return view('pages.about-us');
    }

    public function promo(){
        return view('pages.promo');
    }

    public function contactUs(){
        return view('pages.contact-us');
    }
    
    public function bachelor(){
        return view('pages.bachelor');
    }

    public function event(){
        return view('pages.event');
    }

    public function registerSuccess(){
        return view('pages.register-success');
    }

    public function career(){
        return view('pages.career');
    }

    public function value(){
        return view('pages.value');
    }

    public function mission(){
        return view('pages.mission');
    }

    public function privacyPolicy(){
        return view('pages.privacy');
    }

    public function termsConditions(){
        return view('pages.terms');
    }

}
