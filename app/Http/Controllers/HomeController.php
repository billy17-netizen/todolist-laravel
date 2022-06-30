<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends Controller
{
    public function home (Request $request): RedirectResponse
    {
        if ($request->session()->exists('user')) {
            return redirect('/todolist');
        }
        return redirect('/login');
    }
}
