<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;

class PagesController extends Controller
{
    
    public function index()
    {
    	
    	
    	$page='Home';
		
		return redirect()->action('PagesController@pages', $page);
       
    }
    public function pages($page)
    {
    	

    	$menu = $this->buildmenu();
    	

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

    public function buildmenu()
    {
    	$pages = Page::where('published', 1)->where('ischild', '0')->get();
    	foreach ($pages as $page) 
    	{
            if ($page->issection!=0)
	    	{
	    		if (Page::where('parent_id', $page->id)->get())
	    		{
	    			$children = Page::where('parent_id', $page->id)->get();
	    		}
	    		$count=0;
				foreach ($children as $child)
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
