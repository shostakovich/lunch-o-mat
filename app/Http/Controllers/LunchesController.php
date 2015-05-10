<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\RSVPChangeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Lunch;
use App\Services\LunchSchedulingService;
use App\Services\RSVPCreatorService;

class LunchesController extends Controller {
    public function index(Request $request)
    {
        $user = $request->user();
	    $circles = $user->circles;

        return view('lunches.index', compact('circles', 'user'));
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
            return Redirect::to("/lunches")->withSuccess('You scheduled a lunch!');
        } else {
            return Redirect::back()->withErrors($service->getErrors());
        }
    }

	public function signup($id, Request $request)
	{
		$user = $request->user();
		$lunch = Lunch::find($id);

		$service = new RSVPCreatorService($lunch, $user);

		if($service->signUp())
			return Redirect::back()->withSuccess('You succesfully signed up!');
		else
			return Redirect::back()->withError('Signup failed');
	}

    public function cancel($id, Request $request)
    {
        $lunch = Lunch::find($id);
        $user = $request->user();
        $service = new RSVPChangeService($lunch, $user);

       if($service->cancel())
           return Redirect::back()->withSuccess('You will not take part in this lunch!');
    }
}
