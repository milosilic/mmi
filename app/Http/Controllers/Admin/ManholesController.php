<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Manholes;
use App\Http\Requests\CreateManholesRequest;
use App\Http\Requests\UpdateManholesRequest;
use Illuminate\Http\Request;



class ManholesController extends Controller {

	/**
	 * Display a listing of manholes
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $manholes = Manholes::limit(2000)->get();

		return view('admin.manholes.index', compact('manholes'));
	}

	/**
	 * Show the form for creating a new manholes
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.manholes.create');
	}

	/**
	 * Store a newly created manholes in storage.
	 *
     * @param CreateManholesRequest|Request $request
	 */
	public function store(CreateManholesRequest $request)
	{
	    
		Manholes::create($request->all());

		return redirect()->route(config('quickadmin.route').'.manholes.index');
	}

	/**
	 * Show the form for editing the specified manholes.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$manholes = Manholes::find($id);
	    
	    
		return view('admin.manholes.edit', compact('manholes'));
	}

	/**
	 * Update the specified manholes in storage.
     * @param UpdateManholesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateManholesRequest $request)
	{
		$manholes = Manholes::findOrFail($id);

        

		$manholes->update($request->all());

		return redirect()->route(config('quickadmin.route').'.manholes.index');
	}

	/**
	 * Remove the specified manholes from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Manholes::destroy($id);

		return redirect()->route(config('quickadmin.route').'.manholes.index');
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
            Manholes::destroy($toDelete);
        } else {
            Manholes::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.manholes.index');
    }

}
