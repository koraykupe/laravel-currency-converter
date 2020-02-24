<?php

namespace App\Http\Controllers;

use App\AuthorizationIp;
use App\Http\Requests\StoreAuthorizedIpRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AuthorizedIpController extends Controller
{
    /**
     * Display a listing of the IP.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $ips = AuthorizationIp::all();
        return view('ips.index', compact('ips'));
    }

    /**
     * Show the form for creating a new IP.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('ips.create');
    }

    /**
     * Store a newly created IP in storage.
     *
     * @param StoreAuthorizedIpRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAuthorizedIpRequest $request)
    {
        try {
            AuthorizationIp::create(['ip_address' => $request->ip_address]);
        } catch (QueryException $exception){
            return redirect()->back()->withErrors('IP is already registered.');
        }
        return redirect()->back()->with('success', 'IP has been added successfully.');
    }

    /**
     * Remove the specified IP from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        AuthorizationIp::findOrFail($id)->delete();
        Log::info('IP ' . $id . ' deleted');
        return redirect()->back()->with('success', 'IP deleted successfully');
    }
}
