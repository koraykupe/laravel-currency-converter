<?php

namespace App\Http\Controllers;

use App\AuthorizationIp;
use App\Http\Requests\StoreAuthorizedIpRequest;
use Illuminate\Support\Facades\Artisan;
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
        Artisan::call('add:authorized-ip', [
            'ip_address' => $request->ip_address,
        ]);

        return redirect()->back()->with('success', 'Your request will be processed soon.');

    }

    /**
     * Remove the specified IP from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        AuthorizationIp::findOrFail($id)->delete();
        Log::info('IP ' . $id . ' deleted');
        return redirect()->back()->with('success', 'IP deleted successfully');
    }
}
