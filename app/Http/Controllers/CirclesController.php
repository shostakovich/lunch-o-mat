<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Circle;
use App\Services\CircleCreatorService;
use Illuminate\Support\Facades\Redirect;

class CirclesController extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
		$circles = Circle::all();
		return view('circles.index', compact('circles'));
	}

	public function create()
	{
		return view('circles.create');
	}

	public function store(Request $request)
	{
        $service = new CircleCreatorService($request->input(), $request->user());

		if (! $service->make())
			return Redirect::back()->withInput()->withErrors($service->getErrors());

		return redirect('/circles');
	}

	public function show($id)
	{
	}

	public function edit($id)
	{
	}

	public function update($id)
	{
	}

	public function destroy($id)
	{
	}
}
