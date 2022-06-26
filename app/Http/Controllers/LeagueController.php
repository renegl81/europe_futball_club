<?php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeagueController extends Controller
{
    public function index() {
        $leagues = League::all();
        return Inertia::render('League', [
            'leagues' => $leagues
        ]);
    }
}
