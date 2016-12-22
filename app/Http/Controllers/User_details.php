<?php

namespace App\Http\Controllers;
use App\User;
use App\Fileentry;
use Session;    
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Mail\MyTestMail;



class User_details extends Controller
{
    
    public function register(Request $request)
    {
    	//dd($request->all());
    	$rules=array(
	    		'username' => 'required|alpha',
	    		'email' => 'required|email',
	    		'password' => 'required|max:5'
	    		);

	    	$messages = [
				    	'required' => '*:Attribute field is empty',
			   			 'alpha' => '*The :attribute must be in alphabets only',
			   			 'max' => '*Password length is 5'
						];
	    	$validator = Validator::make(Input::only('username', 'email', 'password'), $rules, $messages);

	    	if($validator->fails())
	    	{
	    		// return view('home')->withErrors('Something wrong');	
	    		return redirect('/practice')
                        ->withErrors($validator->messages())
                        ->withInput();
                   
       			// return $validator->errors()->all();
	    	}else
	    	{

	    		//dd('sdsdasd');
		        User::create([
		                    'name' => $request->input('username'),
		                    'email' => $request->input('email'),
		                    'password' => bcrypt($request->input('password')),
		        ]);
		        return redirect('practice/pract-login');
	    	}
    }

    public function userlogin(Request $request)
    {
    	// dd($request->email);
    	if (Auth::attempt(['email' => $request->email, 'password' =>$request->password])) {
    		session::put('emailid', $request->email);
	        return redirect('practice/list');
	    }else{
	    	return redirect('practice/pract-login');
	    }
    }

    public function userlogout()
    {
    	session::forget('emailid');
    	return redirect('practice/pract-login');
    }

    public function userlist()
    {
    	 $list = DB::table('users')->get();
        // $list = User::pluck('name', 'email')->all();

		$entry = Fileentry::all();
        // dd($list); 
		return view('userlist', compact('list', 'entry'));   
    }

    public function edituser($id)
    {
    	$data=User::find($id);
    	if($data == null)
    	{ 
    		return redirect('practice/list')->with('message', 'No User Found with id '. $id);
    	}else{

    		return view('edituser', compact('data'));
    	}
    }

    public function updateuser(Request $request, $id)
    {
        
        //dd($request->all());
    	$data=User::find($id);
    	$input= $request->all();
        $input['password'] = bcrypt($input['password']);
    	$data->fill($input)->save();
    	
    	return redirect('practice/list');
    }

    public function deleteuser($id)
    {
    	//dd($id);
    	$data=User::find($id);
    	if($data == null)
    	{ //dd('dasd');
    		// return view('practice/list')->with
    		return redirect('practice/list')->with('message', 'No User Found with id '. $id);
    	}else{

    		$data->delete();
    		return redirect('practice/list');
    	}
    }

    public function formtest(Request $request)
    { 

        $result = User::create([
                            'name' => $request->input('name'),
                            'email' => $request->input('email'),
                            'password' => bcrypt($request->input('password')),
                ]);
        $id = $result->id;
       // $id = User::insertGetId($result->toArray());
        //dd($id);
        if($id)
        {
            $file = $request->imagefile;
            //  dd($file);
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->put($file->getFilename().'.'.$extension,  File::get($file));
            $entry = new Fileentry();
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->filename = $file->getFilename().'.'.$extension;
        //dd($entry);
            $entry->save();
     
            return redirect('fileentry');
        }
    }

    public function myTestMail()
    {

        $myEmail = 'singh3817@gmail.com';

        Mail::to($myEmail)->send(new MyTestMail());  
       //        dd("Mail Send Successfully");
    }

    public function mailregisteration($id)
    { //  dd($id);
        $data = User::find($id);
        dd($data->email);
        $myEmail = $data->email;
        // Mail::to($myEmail)->send
    }
}
