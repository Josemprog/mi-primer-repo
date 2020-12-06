<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): \Illuminate\View\View
    {
        return view('admin.api.panel');
    }
}
