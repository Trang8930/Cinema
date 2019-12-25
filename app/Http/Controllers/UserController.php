<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\phim;
use App\tintuc;
use App\rap;
use App\lichchieu;
use App\phong;
use App\ghe;
use App\combo;
use App\User;
use App\ve;
use App\datcombo;

class UserController extends Controller
{
	public function index()
	{
		$ve=ve::where('id_user', Auth::user()->id)->orderBy('id', 'desc')->get();
		$count=ve::where('id_user', Auth::user()->id)->count();
		return view('users.index', compact('ve', 'count'));
	}
}
