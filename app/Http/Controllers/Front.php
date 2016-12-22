<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Brand;
use App\Category;
use App\Products1;
use App\User;
use App\Post1;

// use App\Http\Controllers\Products1;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Cart;



class Front extends Controller
{
	var $brands;
    var $categories;
    var $products;
    var $title;
    var $description;

    public function __construct()
    {
        $this->brands = Brand::all(array('name'));
        $this->categories = Category::all(array('name'));
        $this->products = Products1::all(array('id','name','price'));
    }
	
	public function index()
	{
		return view('home', array('title' => 'Welcome','description' => '','page' => 'home', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function products()
    {
        return view('products', array('title' => 'Products Listing','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_details($id)
    {
        $product = Product::find($id);
        return view('product_details', array('product' => $product, 'title' => $product->name,'description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_categories()
    {
        
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_brands()
    {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function blog()
    {
    	$posts = Post1::where('id', '>', 0)->paginate(3);
    $posts->setPath('blog');

    $data['posts'] = $posts;

    return view('blog', array('data' => $data, 'title' => 'Latest Blog Posts', 'description' => '', 'page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
      // return view('blog', array('title' => 'Welcome','description' => '','page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function blog_post($id)
    {
    	$post = Post1::whereUrl($url)->first();

	    $tags = $post->tags;
	    $prev_url = Post1::prevBlogPostUrl($post->id);
	    $next_url = Post1::nextBlogPostUrl($post->id);
	    $title = $post->title;
	    $description = $post->description;
	    $page = 'blog';
	    $brands = $this->brands;
	    $categories = $this->categories;
	    $products = $this->products;

	    $data = compact('prev_url', 'next_url', 'tags', 'post', 'title', 'description', 'page', 'brands', 'categories', 'products');

	    return view('blog_post', $data);

        // return view('blog_post', array('title' => 'Welcome','description' => '','page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function contact_us()
    {
       return view('contact_us', array('title' => 'Welcome','description' => '','page' => 'contact_us'));
    }

    public function login()
    {
        return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function logout()
    {
        Auth::logout();
    
    	return Redirect::away('login');

    }

    public function cart()
    {
    	if (Request::isMethod('post'))
    	{
	        $product_id = Request::get('product_id');
	        $product = Products1::find($product_id);
	        Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
    	}
  
    	  //increment the quantity
  		if (Request::get('product_id') && (Request::get('increment')) == 1)
  		{
	        $rowId = Cart::search(array('id' => Request::get('product_id')));
	        $item = Cart::get($rowId[0]);

	        Cart::update($rowId[0], $item->qty + 1);
    	}

    //decrease the quantity
    	if (Request::get('product_id') && (Request::get('decrease')) == 1)
    	{
	        $rowId = Cart::search(array('id' => Request::get('product_id')));
	        $item = Cart::get($rowId[0]);

	        Cart::update($rowId[0], $item->qty - 1);
    	}


    	$cart = Cart::content();

    	return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
	}

    public function checkout()
    {
       return view('checkout', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function search($query)
    {
       return view('products', array('title' => 'Welcome','description' => '','page' => 'products'));
    }

    public function register()
    {
    	//dd('sddd');
    	// return Validator::make($data, [
     //        'name' => 'required|max:255',
     //        'email' => 'required|email|max:255|unique:users',
     //        'password' => 'required|min:6|confirmed',
     //    ]);

	    if (Request::isMethod('post'))
	    {
	    	$rules=array(
	    		'name' => 'required|alpha',
	    		'email' => 'required|email',
	    		'password' => 'required|max:5'
	    		);

	    	$messages = [
				    	'required' => '*:Attribute field is empty',
			   			 'alpha' => 'The :attribute must be in alphabets',
			   			 'max' => 'Password length is 5'
						];
	    	$validator = Validator::make(Input::only('name', 'email', 'password'), $rules, $messages);

	    	if($validator->fails())
	    	{
	    		// return view('home')->withErrors('Something wrong');	
	    		return redirect('/login')
                        ->withErrors($validator->messages(),'register')
                        ->withInput();
                   
       			// return $validator->errors()->all();
	    	}else
	    	{


		        User::create([
		                    'name' => Request::get('name'),
		                    'email' => Request::get('email'),
		                    'password' => bcrypt(Request::get('password')),
		        ]);
	    	}
    	} 
    
    	return Redirect::away('login');
	}

	public function authenticate()
	{
	    if (Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')])) {
	        return redirect()->intended('checkout');
	    } else {
	        return view('login', array('title' => 'Welcome', 'description' => '', 'page' => 'home'));
	    }
	}

	public function checkmail()
	{
		//dd('asdasdasd');

		if (Request::isMethod('post'))
    	{
           $mailcheck = Request::get('emailname');
	      $mail = DB::table('users')
                    ->where('email',$mailcheck)->get();
	    	 if($mail->isEmpty())
            {
                echo "No result";
            }else
            {
                echo "found";
            }
            // echo $mail;
            }
	}

// 
}
