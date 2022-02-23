<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\InvocesPaid;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function get()
    {//->markAsRead();
      // Auth::user()->unreadNotification;

        $user =  User::where('id',1)->first();
//
//        $user->notify(new InvocesPaid($user));
//      //Natification::send(Auth::user(), new InvocesPaid($user));

      return $user;
    }

}
