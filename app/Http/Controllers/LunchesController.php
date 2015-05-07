<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\LunchSignupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Lunch;

class LunchesController extends Controller {
    public function index(Request $request)
    {
	    $circles = $request->user()->circles;

        return view('lunches.index', compact('circles'));
    }

	public function signup($id, Request $request)
	{
		$user = $request->user();
		$lunch = Lunch::find($id);

		$service = new LunchSignupService($lunch, $user);

		if($service->signUp())
		{
			return Redirect::back()->withNotification('You succesfully signed up!');
		} else {
			return Redirect::back()->withNotification('Signup failed');
		}
	}
}
