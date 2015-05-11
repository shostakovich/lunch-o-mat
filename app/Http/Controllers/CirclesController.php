<?php namespace App\Http\Controllers;

use App\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Circle;
use App\Services\CircleCreatorService;
use Illuminate\Support\Facades\Redirect;

class CirclesController extends Controller
{
	public function index()
	{
		$circles = Circle::all();
		return view('circles.index', compact('circles'));
	}

	public function show($id, Request $request)
	{
		$circle = Circle::findOrFail($id);
		$user = $request->user();

		$membership = Membership::where(array('circle_id' => $circle->id, 'user_id' => $user->id))->first();
		return view('circles.show', compact('circle', 'membership'));
	}

	public function create()
	{
		return view('circles.create');
	}

	public function store(Request $request)
	{
		$service = new CircleCreatorService($request->all(), $request->user());

		if (!$service->make())
			return Redirect::back()->withInput()->withErrors($service->getErrors());

		return redirect('/circles');
	}
}
