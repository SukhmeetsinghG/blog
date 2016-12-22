<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Fileentry;
use Request;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class FileEntryController extends Controller
{
    public function index()
	{
		$entries = Fileentry::all();
 
		return view('fileentries.index', compact('entries'));
	}
 
	public function add(Request $request)
	{	dd($request->all());
 		

	  $rules = array(

	  	 'filefield' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100',
	  	);
	  $messages = [
					    	'required' => '*:Attribute field is empty',
				   			 'image' => '*The :attribute is not image',
				   			 'max' => '*Image size allowed is 100kb max'
							];

	  	$validator = Validator::make(Input::only('filefield'), $rules, $messages);

    	if($validator->fails())
    	{ 
    		return redirect('fileentry')
    		->withErrors($validator->messages());
    	}else
    	{

			$file = Request::file('filefield');
			$extension = $file->getClientOriginalExtension();
			Storage::disk('public')->put($file->getFilename().'.'.$extension,  File::get($file));
			$entry = new Fileentry();
			$entry->mime = $file->getClientMimeType();
			$entry->original_filename = $file->getClientOriginalName();
			$entry->filename = $file->getFilename().'.'.$extension;
	 
			$entry->save();
	 
			return redirect('fileentry');
    	}		
	}
	

	public function get($filename)
	{
	
		$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
		$file = Storage::disk('public')->get($entry->filename);
 
		return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);
	}

	public function remove($filename)
	{
		$name = Fileentry::find($filename);
		 // dd(storage_path('app/public').'/'.$name->filename);
		File::delete(storage_path('app/public').'/'.$name->filename);
		$name = Fileentry::find($filename)->delete();
		// unlink(.$name->original_filename);
		return redirect('fileentry')
		->with('message', 'File Deleted');
		// // dd($filename);
		// $data=Fileentry::find($filename);
  //   	if($data == null)
  //   	{ dd('dasd'); }
	}
}
