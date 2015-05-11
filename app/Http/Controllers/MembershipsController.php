<?php namespace App\Http\Controllers;

use App\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Circle;
use Illuminate\Support\Facades\Redirect;

use App\Services\MembershipCreatorService;

class MembershipsController extends Controller
{
	public function store(Request $request)
	{
		$circle = Circle::findOrFail($request->input('circle_id'));

		$service = new MembershipCreatorService($circle, $request->user());
		$service->create();

		return Redirect::back()->withSuccess("You joined the Circle: '{$circle->name}'");
	}

	public function destroy($id, Request $request)
	{
		// Only the user who is member may delete the membership..
		$scope = ['id' => $id, 'user_id' => $request->user()->id];

		Membership::where($scope)->delete();
		return Redirect::back()->withSuccess("You are no longer member of this circle");
	}
}
