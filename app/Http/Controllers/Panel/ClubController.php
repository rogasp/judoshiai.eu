<?php

namespace App\Http\Controllers\Panel;

use App\Club;
use App\Http\Controllers\Controller;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::involved()->get();

        return view('panel.clubs.index')
            ->with([
                'clubs' => $clubs,
            ]);
    }

    public function show(Club $club)
    {
        return view('panel.clubs.show')
            ->with([
                'club' => $club,
            ]);
    }
}
