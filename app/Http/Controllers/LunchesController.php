<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lunch;

class LunchesController extends Controller {
    public function index()
    {
        $lunches = Lunch::all();

        return view('lunches.index', compact('lunches'));
    }
}
