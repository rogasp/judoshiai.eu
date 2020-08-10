<?php

namespace App\Http\Controllers\Panel;

use App\Club;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClubRequest;
use Illuminate\Support\Facades\Auth;

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

    public function create()
    {
        return view('panel.clubs.create');
    }

    //TODO: Only if you are registered user and logged in
    public function store(ClubRequest $request)
    {
        $club = Club::create($request->validated());
        $club->owner_id = Auth::id();
        $club->user_id = Auth::id();
        $club->save();

        return redirect()
            ->route('clubs.index')
            ->withSuccess("New club created, {$club->name}, withe id {$club->id} ");
    }

    public function show(Club $club)
    {
        return view('panel.clubs.show')
            ->with([
                'club' => $club,
            ]);
    }
}
