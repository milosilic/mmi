<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\RadniNalog;
use App\Http\Requests\CreateRadniNalogRequest;
use App\Http\Requests\UpdateRadniNalogRequest;
use Illuminate\Http\Request;

use App\User;
use App\Manholes;


class RadniNalogController extends Controller {

	/**
	 * Display a listing of radninalog
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $radninalog = RadniNalog::with("user")->with("manholes")->get();

		return view('admin.radninalog.index', compact('radninalog'));
	}

	/**
	 * Show the form for creating a new radninalog
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $user = User::pluck("name", "id")->prepend('Please select', 0);
$manholes = Manholes::pluck("name", "id")->prepend('Please select', 0);

	    
	    return view('admin.radninalog.create', compact("user", "manholes"));
	}

	/**
	 * Store a newly created radninalog in storage.
	 *
     * @param CreateRadniNalogRequest|Request $request
	 */
	public function store(CreateRadniNalogRequest $request)
	{
	    
		RadniNalog::create($request->all());

		return redirect()->route(config('quickadmin.route').'.radninalog.index');
	}

	/**
	 * Show the form for editing the specified radninalog.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$radninalog = RadniNalog::find($id);
	    $user = User::pluck("name", "id")->prepend('Please select', 0);
$manholes = Manholes::pluck("name", "id")->prepend('Please select', 0);

	    
		return view('admin.radninalog.edit', compact('radninalog', "user", "manholes"));
	}

	/**
	 * Update the specified radninalog in storage.
     * @param UpdateRadniNalogRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateRadniNalogRequest $request)
	{
		$radninalog = RadniNalog::findOrFail($id);

        

		$radninalog->update($request->all());

		return redirect()->route(config('quickadmin.route').'.radninalog.index');
	}

	/**
	 * Remove the specified radninalog from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		RadniNalog::destroy($id);

		return redirect()->route(config('quickadmin.route').'.radninalog.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            RadniNalog::destroy($toDelete);
        } else {
            RadniNalog::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.radninalog.index');
    }

}
