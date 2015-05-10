<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Lunch;
use App\Services\LunchSchedulingService;
use App\Services\LunchSignupService;

class LunchesController extends Controller {
    public function index(Request $request)
    {
	    $circles = $request->user()->circles;

        return view('lunches.index', compact('circles'));
    }

	public function create(Request $request)
	{
		$circles = $request->user()->foundedCircles()->lists('name', 'id');

		return view('lunches.create', compact('circles'));
	}

    public function store(Request $request)
    {
        $service = new LunchSchedulingService($request->input(), $request->user());

        if($service->schedule())
        {
            return Redirect::to("/lunches")->withNotification('You scheduled a lunch!');
        } else {
            return Redirect::back()->withErrors($service->getErrors());
        }
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
