<?php

namespace App\Http\Controllers\Panel;

use App\Club;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::all();

        return view('panel.clubs.index')
            ->with([
                'clubs' => $clubs,
            ]);
    }

}
