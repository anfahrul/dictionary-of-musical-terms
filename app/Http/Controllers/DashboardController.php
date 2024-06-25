<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicTerms;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $musicTerms = MusicTerms::all();

        return view('admin.dashboard.index', [
            'title' => 'Dashboard',
            'musicTermsCount' => $musicTerms->count()
        ]);
    }
}
