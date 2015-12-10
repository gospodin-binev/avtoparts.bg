<?php

namespace App\Http\Controllers;

use App\Contacts;
use App\BlogPosts;
use App\Orders;
use App\SubProductCategories;
use App\ProductCategories;
use App\Images;
use App\Models;
use App\Brands;
use App\Products;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    	$productCategories = DB::table('product_categories')
	        ->orderBy('position', 'asc')
	        ->get();

	    $productSubCategories = DB::table('product_sub_categories')
	    	->orderBy('position', 'asc')
	    	->get();

        $brands = DB::table('brands')
            ->orderBy('position', 'asc')
            ->get();

        $models = DB::table('models')
            ->where('in_brand', $request->input('brand-id'))
            ->orderBy('position', 'asc')
            ->get();

        $selectedBrand = $request->input('brand-id');

        $products = DB::table('products')
            ->orderBy('id', 'desc')
            ->paginate(8);

        $productImages = DB::table('product_images')
            ->get();

        $count = 0; // making clearfix for latest products

        $blog_posts = DB::table('blog_posts')
            ->orderBy('id', 'desc')
            ->paginate(3);

    	return view('pages.home')
    		->with('productCategories', $productCategories)
    		->with('productSubCategories', $productSubCategories)
    		->with('brands', $brands)
            ->with('models', $models)
            ->with('selectedBrand', $selectedBrand)
            ->with('products', $products)
            ->with('productImages', $productImages)
            ->with('count', $count)
            ->with('blog_posts', $blog_posts);
    }

    public function getViewProduct($id)
    {
        $product = Products::findOrFail($id);

        $brands = Brands::all();
        $models = Models::all();

        $productImages = DB::table('product_images')
            ->where('in_product', $id)
            ->get();

        $randProducts = Products::orderBy(DB::raw('RAND()'))->take(3)->get();
        $randImages = Images::all();

        $price_text = '';

        if ($product->price_count == 'yes')
        {
            $price_text = 'за брой';
        }

        return view('pages.view-product')
            ->with('product', $product)
            ->with('brands', $brands)
            ->with('models', $models)
            ->with('productImages', $productImages)
            ->with('randProducts', $randProducts)
            ->with('randImages', $randImages)
            ->with('price_text', $price_text);
    }

    public function getViewCategories(Request $request, $id)
    {
        $subPaginate = '';

        if ($request->input('model') == '') {

            $products = DB::table('products')
                ->where('category', $id)
                ->orderBy('id', 'desc')
                ->paginate(12);

        } 
        else {

            $products = DB::table('products')
                ->where('category', $id)
                ->where('model', $request->input('model'))
                ->orderBy('id', 'desc')
                ->paginate(12);

            $subPaginate = 'on';

            $products->setPath('?model='.$request->input('model'));
            
        }

        $count = 0; // making clearfix for latest products

        $categories = ProductCategories::findOrFail($id);

        $productImages = DB::table('product_images')->get();

        $subCategories = DB::table('product_sub_categories')
            ->where('in_category', $id)
            ->orderBy('position', 'asc')
            ->get();

        $brands = DB::table('brands')
            ->orderBy('position', 'asc')
            ->get();

        $selectedBrand = $request->input('brand_id');
        $selectedModel = $request->input('model');

        $models = DB::table('models')
            ->where('in_brand', $request->input('brand'))
            ->get();

        return view('pages.view-category')
            ->with('products', $products)
            ->with('categories', $categories)
            ->with('count', $count)
            ->with('subPaginate', $subPaginate)
            ->with('productImages', $productImages)
            ->with('subCategories', $subCategories)
            ->with('brands', $brands)
            ->with('selectedBrand', $selectedBrand)
            ->with('selectedModel', $selectedModel)
            ->with('models', $models);
    }

    public function getViewSubCategories(Request $request, $id)
    {
        $subPaginate = '';

        if ($request->input('model') == '') {

            $products = DB::table('products')
                ->where('sub_category', $id)
                ->orderBy('id', 'desc')
                ->paginate(12);

        } 
        else {

            $products = DB::table('products')
                ->where('sub_category', $id)
                ->where('model', $request->input('model'))
                ->orderBy('id', 'desc')
                ->paginate(12);

            $subPaginate = 'on';

            $products->setPath('?model='.$request->input('model'));
        }

        $brands = DB::table('brands')
            ->orderBy('position', 'asc')
            ->get();

        $models = DB::table('models')
            ->where('in_brand', $request->input('brand'))
            ->get();

        $selectedBrand = $request->input('brand_id');
        $selectedModel = $request->input('model');

        $count = 0; // making clearfix for latest products

        $subcategories = SubProductCategories::findOrFail($id);

        $productImages = DB::table('product_images')->get();

        return view('pages.view-subcategory')
            ->with('products', $products)
            ->with('brands', $brands)
            ->with('models', $models)
            ->with('selectedBrand', $selectedBrand)
            ->with('selectedModel', $selectedModel)
            ->with('subPaginate', $subPaginate)
            ->with('count', $count)
            ->with('subcategories', $subcategories)
            ->with('productImages', $productImages);
    }

    public function getViewModels(Request $request, $id)
    {
        if ($request->input('subcategory-id') == '')
        {
            $products = DB::table('products')
                ->where('model', $id)
                ->orderBy('id', 'desc')
                ->paginate(18);
        } 
        else
        {
            $products = DB::table('products')
                ->where('model', $id)
                ->where('sub_category', $request->input('subcategory-id'))
                ->orderBy('id', 'desc')
                ->paginate(500);
        }

        $categories = ProductCategories::all();

        $subcategories = SubProductCategories::all();

        $currentPath = $request->url();

        $models = Models::findOrFail($id);

        $productImages = DB::table('product_images')->get();

        $count = 0; // making clearfix for latest products

        return view('pages.view-model')
            ->with('products', $products)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('currentPath', $currentPath)
            ->with('models', $models)
            ->with('productImages', $productImages)
            ->with('count', $count);
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('search-query');
        if ($query == '')
        {
            return redirect('/');
        }

        if ($request->input('model') == '')
        {
            $products = Products::where(DB::raw("name"), 'LIKE', "%$query%")
                ->paginate(18);

            $products->setPath('/search?search-query='.$query);
        }
        else
        {
            $products = Products::where(DB::raw("name"), 
                'LIKE', "%{$query}%")
                ->where('model', $request->input('model'))
                ->paginate(18);

            $products->setPath('/search?search-query='.$query.'&model='.$request->input('model'));
        }

        $brands = Brands::all();
        $models = Models::all();

        $productImages = DB::table('product_images')->get();

        $count = 0; // making clearfix for latest products

        return view('pages.search-results')
            ->with('query', $query)
            ->with('products', $products)
            ->with('query', $query)
            ->with('brands', $brands)
            ->with('models', $models)
            ->with('productImages', $productImages)
            ->with('count', $count);
    }

    public function getProfileOrders($id)
    {
        $orders = DB::table('orders')
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.profile-orders')
            ->with('orders', $orders);
    }

    public function getBlog()
    {
        $blog_posts = DB::table('blog_posts')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('pages.blog_home')
            ->with('blog_posts', $blog_posts);
    }

    public function viewPost($id)
    {
        $blog_post = BlogPosts::findOrFail($id);

        return view('pages.view_blog_post')
            ->with('blog_post', $blog_post);
    }

    public function getContacts()
    {
        $contacts = Contacts::all();

        return view('pages.contacts')
            ->with('contacts', $contacts);
    }
    
}
