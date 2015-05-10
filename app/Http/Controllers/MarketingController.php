<?php
namespace App\Http\Controllers;

class MarketingController extends Controller {
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function welcome()
    {
        return view('marketing.welcome');
    }
}
