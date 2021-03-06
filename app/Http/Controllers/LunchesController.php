<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Lunch;
use App\Services\LunchSchedulingService;
use App\Services\RSVPService;

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
		$service = new LunchSchedulingService($request->all(), $request->user());

		if($service->schedule())
		{
			return Redirect::to("/lunches")->withSuccess('You scheduled a lunch!');
		} else {
			return Redirect::back()->withErrors($service->getErrors());
		}
	}

	public function signup($id, Request $request)
	{
		$service = $this->rsvpService($id, $request);

		if ($service->rsvp())
			return Redirect::back()->withSuccess('You succesfully signed up!');
		else
			return Redirect::back()->withError('Signup failed');
	}

	public function cancel($id, Request $request)
	{
		$service = $this->rsvpService($id, $request);

	   if($service->rsvp(false))
		   return Redirect::back()->withSuccess('You will not take part in this lunch!');
	}

	protected function rsvpService($id, Request $request)
	{
		$lunch = Lunch::findOrFail($id);
		$user = $request->user();
		$service = new RSVPService($lunch, $user);
		return $service;
	}
}
