<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isAdvertiser()) {
            return redirect()->route('advertiser.offers.index');
        }

        if ($user->isWebmaster()) {
            return redirect()->route('webmaster.subscriptions.index');
        }

        abort(403);
    }
}
