<?php
namespace App\Http\Controllers;

class PagesController extends Controller {
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function homepage()
    {
        return view('pages.homepage');
    }
}
