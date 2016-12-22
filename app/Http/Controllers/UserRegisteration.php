<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRegisteration extends Controller
{
	 public function index(Request $request){
	 	 
      // Usage of path method
      $path = $request->path();
      echo 'Path Method: '.$path;
      echo '<br>';
     
      // Usage of is method
      $pattern = $request->is('foo/*');
      echo 'is Method: '.$pattern;
      echo '<br>';
      
      // Usage of url method
      $url = $request->url();
    echo 'URL method: '.$url;
   }
    //
 public function postRegister(Request $request){
      //Retrieve the name input field
      $name = $request->input('name');
      echo 'Name: '.$name;
      echo '<br>';
      
      //Retrieve the username input field
      $username = $request->username;
      echo 'Username: '.$username;
      echo '<br>';
      
      //Retrieve the password input field
      $password = $request->password;
      echo 'Password: '.$password;
   }
}
