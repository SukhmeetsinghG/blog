<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function index()
    {
    	$users = [
    		'0' =>[
    			'first_name' => 'Humble',
    			'last_name' => 'Dust',
    			],
    		'1' =>[
    			'first_name' => 'singh',
    			'last_name' => 'saab'
    			]
    		];
    		return view('admin/users/index', compact('users'));
    }

    public function create()
    {
    	return view('admin/users/create');
    }

    public function store(Request $request)
    {
         //dd($request['_token']);
  /*  	$userobj = new User();
    	$userobj->name =  $request->get('name');
    	$userobj->save();
    	die;*/
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' =>bcrypt($request['password']),
            'remember_token' => $request['_token']
            ]);
    	// User::create($request->all());
    	return "Success";
    	return $request->all();
    }
}
