<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;

class PagesController extends Controller
{
    
    //Set a home page variable
    //
    //@return a redirect to routing method with parametr of home page
    public function index()
    {
    	
    	
    	$page='Home';
		
		return redirect()->action('PagesController@pages', $page);
       
    }

    //Get a view of requested page with a dynamic menu and a master layout or throw a 404-error page
    //
    //@param string $page page from the route.php
    //@return view with parameters string $current_page, string $content, array $menu 
    public function pages($page)
    {
    	

    	$menu = $this->buildmenu();//building a dynamic menu
    	

        if(Page::where('title', $page)->first())
        {
            $current_page = Page::where('title', $page)->first();
            $content = 'The content of ' . $current_page->title;
           

        return view('pages.index')->with('current_page', $current_page)
        							->with('page_content', $content)
                                	->with('pages', $menu);

        } else 
        {
            return view('errors.404')->with('pages', $menu);
        }
    }

    //Get a collection of pages as objects
    //
    // @return an array of App\Page - an Eloquant model, with a subarray of subpages as well    

    public function buildmenu()
    {
    	$pages = Page::where('published', 1)->where('ischild', '0')->get();
    	foreach ($pages as $page) 
    	{
            if ($page->issection!=0)//checking if an object has subpages
	    	{
	    		if (Page::where('parent_id', $page->id)->get())
	    		{
	    			$children = Page::where('parent_id', $page->id)->get();
	    		}
	    		$count=0;
				foreach ($children as $child)//building array of subpages
                {
                    if (Page::find($child->id))
                    {
                        if (Page::find($child->id)->published!=1)
                        {
                            unset($children[$count]);

                        }
                    }
                    $count++;
                }
                $page->children = $children;
                }
	       	}
    	return $pages;
    }
}
