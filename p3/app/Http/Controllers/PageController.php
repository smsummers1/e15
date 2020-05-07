<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * GET /support
     */
    public function support()
    {
        return view('pages.support');
    }
}
