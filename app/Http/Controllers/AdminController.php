<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Input;
use App\Contacts;
use App\BlogPosts;
use App\Orders;
use App\Images;
use App\Products;
use App\Models;
use App\Brands;
use App\SubProductCategories;
use App\ProductCategories;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;

class AdminController extends Controller
{
    public function getDashboard()
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

            $countUsers = count(User::all());
            $countProducts = count(Products::all());
            $countOrders = count(Orders::all());


    		return view('admin.dashboard')
                ->with('countUsers', $countUsers)
                ->with('countProducts', $countProducts)
                ->with('countOrders', $countOrders);
    	}

    	return redirect('/');
    }

    public function getAddProduct(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		$productCategories = ProductCategories::all();
    		$subProductCategories = SubProductCategories::all();
    		$brands = Brands::all();
    		$models = Models::all();

    		return view('admin.add-product')
    			->with('productCategories', $productCategories)
    			->with('subProductCategories', $subProductCategories)
    			->with('brands', $brands)
    			->with('models', $models);

    	}

    	return redirect('/');
    }

    public function postAddProduct(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		$validator = Validator::make($request->all(), [
    			'category_id' => 'required|integer',
    			'subcategory_id' => 'required|integer',
    			'name' => 'required',
    			'brand_id' => 'required|integer',
    			'model_id' => 'required|integer',
    			'weight' => 'required',
    			'klimatik' => 'required',
    			'count_doors' => 'required',
    			'engine' => 'required',
    			'kubatura' => 'required',
    			'transmission' => 'required',
    			'car_type' => 'required',
    			'status' => 'required',
    			'position' => 'required',
    			'vt_number' => 'required',
    			'price' => 'required',
    		]);

    		if ($validator->fails()) {
	            return redirect('/admin/add-products')
	                ->withErrors($validator)
	                ->withInput();
	        }

	        $product = new Products;

	        $product->category = $request->input('category_id');
	        $product->sub_category = $request->input('subcategory_id');
	        $product->name = $request->input('name');
	        $product->brand = $request->input('brand_id');
	        $product->model = $request->input('model_id');
	        $product->weight = $request->input('weight');
	        $product->klimatik = $request->input('klimatik');
	        $product->count_doors = $request->input('count_doors');
	        $product->engine = $request->input('engine');
	        $product->kubatura = $request->input('kubatura');
	        $product->transmission = $request->input('transmission');
	        $product->car_type = $request->input('car_type');
	        $product->status = $request->input('status');
	        $product->position = $request->input('position');
	        $product->vt_number = $request->input('vt_number');
	        $product->price = $request->input('price');
            $product->price_count = $request->input('price_count');
	        $product->save();

	        return redirect()->back()->with($request->session()->flash('admin-success', 'Успешно създадохте продукт.'));

    	}

    	return redirect('/');
    }

    public function filterCategories()
    {
        $cat_id = Input::get('cat_id');

        $subcategories = SubProductCategories::where('in_category', '=', $cat_id)->get();

        return response()->json($subcategories);
    }

    public function filterModels()
    {
        $brand_id = Input::get('brand_id');

        $models = Models::where('in_brand', '=', $brand_id)->get();

        return response()->json($models);
    }

    public function listProducts(Request $request)
    {
        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            $query = $request->input('search');

            $products = '';

            if (empty($query)) {

                $products = Products::orderBy('id', 'desc')->paginate(15);

            } else {

                $products = Products::where(DB::raw("vt_number"), 
                'LIKE', "%{$query}%")
                ->orWhere(DB::raw("name"), 
                'LIKE', "%{$query}%")
                ->paginate(15);

                $products->setPath('/admin/list-products?search='.$query);

            }

            return view('admin.list-products')
                ->with('products', $products)
                ->with('query', $query);
        }

        return redirect('/');
    }

    public function editProducts($id)
    {
        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            $products = Products::findOrFail($id);
            $images = DB::select('select * from product_images where in_product = ?', [$id]);

            $productCategories = ProductCategories::all();
            $subProductCategories = subProductCategories::all();

            $brands = Brands::all();
            $models = Models::all();

            return view('admin.edit-products')
                ->with('products', $products)
                ->with('images', $images)
                ->with('productCategories', $productCategories)
                ->with('subProductCategories', $subProductCategories)
                ->with('brands', $brands)
                ->with('models', $models);

        }

        return redirect('/');
    }

    public function updateProducts(Request $request)
    {
        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            Products::where('id', $request->input('product_id'))
                ->update([
                    'category' => $request->input('category_id'),
                    'sub_category' => $request->input('subcategory_id'),
                    'name' => $request->input('name'),
                    'brand' => $request->input('brand_id'),
                    'model' => $request->input('model_id'),
                    'weight' => $request->input('weight'),
                    'klimatik' => $request->input('klimatik'),
                    'count_doors' => $request->input('count_doors'),
                    'engine' => $request->input('engine'),
                    'kubatura' => $request->input('kubatura'),
                    'transmission' => $request->input('transmission'),
                    'car_type' => $request->input('car_type'),
                    'status' => $request->input('status'),
                    'position' => $request->input('position'),
                    'vt_number' => $request->input('vt_number'),
                    'price' => $request->input('price'),
                    'price_count' =>$request->input('count_price'),
                ]);

                return redirect('/admin/list-products')->with($request->session()->flash('admin-success', 'Продукта беше обновен успешно.'));

        }

        return redirect('/');
    }

    public function deleteProducts(Request $request) {

        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            Products::where('id', $request->input('product_id'))->delete();

            return redirect('/admin/list-products')->with($request->session()->flash('admin-success', 'Успешно изтрихте продукта.'));

        }

    }

    public function uploadImage(Request $request) {

        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            $file = Input::file('file');
            $name = $file->getClientOriginalName();

            File::copy($file, public_path().'/uploads/'.$name);

            $image = new Images;
            $image->src = '/uploads/'.$name;
            $image->image_type = $request->input('image_type');
            $image->in_product = $request->input('product_id');
            $image->save();

            return redirect()->back()->with($request->session()->flash('admin-success', 'Успешно беше качена снимка.'));
        }

        return redirect('/');
    }

    public function deleteImage(Request $request) {

        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            Images::where('id', $request->input('image_id'))->delete();

            return redirect()->back()->with($request->session()->flash('admin-success', 'Успешно изтрихте снимка.'));

        }

    }

    public function getCategories()
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {
    		$categories = ProductCategories::all();

    		return view('admin.categories')
    			->with('categories', $categories);
    	}

    	return redirect('/');
    }

    public function createCategories(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

	    	$validator = Validator::make($request->all(), [
	    		'name' => 'required',
	    		'position' => 'required|integer',
	    	]);

	    	if ($validator->fails()) {
	            return redirect('/admin/categories')
	                ->withErrors($validator)
	                ->withInput();
	        }

	    	$category = new ProductCategories;

	    	$category->name = $request->input('name');
	    	$category->position = $request->input('position');
	    	$category->save();

	    	return redirect()->back()->with($request->session()->flash('admin-success', 'Успешно създадохте категория.'));

    	}

    	return redirect('/');
    }

    public function updateCategories(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		ProductCategories::where('id', $request->input('category-id'))
            	->update([
	                'name' => $request->input('name'),
	                'position' => $request->input('position'),
            	]);

            return redirect()->back()->with($request->session()->flash('admin-success', 'Категорията беше обновена успешно.'));
    	}
    }

    public function deleteCategories(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		ProductCategories::where('id', $request->input('category-id'))->delete();

        	return redirect()->back()->with($request->session()->flash('admin-success', 'Категорията беше успешно изтрита.'));
    	}
    }

    public function getSubCategories(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {
    		$categories = ProductCategories::all();

    		$sub_categories = DB::table('product_sub_categories')
    			->where('in_category', $request->input('category-id'))
    			->orderBy('position', 'asc')
    			->get();

    		return view('admin.sub-categories')
    			->with('categories', $categories)
    			->with('sub_categories', $sub_categories);
    	}

    	return redirect('/');
    }

    public function createSubCategories(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

	    	$validator = Validator::make($request->all(), [
	    		'name' => 'required',
	    		'category-id' => 'required|integer',
	    		'position' => 'required|integer',
	    	]);

	    	if ($validator->fails()) {
	            return redirect('/admin/sub-categories')
	                ->withErrors($validator)
	                ->withInput();
	        }

	    	$sub_category = new SubProductCategories;

	    	$sub_category->name = $request->input('name');
	    	$sub_category->in_category = $request->input('category-id');
	    	$sub_category->position = $request->input('position');
	    	$sub_category->save();

	    	return redirect()->back()->with($request->session()->flash('admin-success', 'Успешно създадохте подкатегория.'));

    	}

    	return redirect('/');
    }

    public function updateSubCategories(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		SubProductCategories::where('id', $request->input('subcategory_id'))
            	->update([
	                'name' => $request->input('name'),
	                'in_category' => $request->input('category-id'),
	                'position' => $request->input('position'),
            	]);

            return redirect()->back()->with($request->session()->flash('admin-success', 'Подкатегорията беше обновена успешно.'));
    	}
    }

    public function deleteSubCategories(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') { 

    		SubProductCategories::where('id', $request->input('subcategory_id'))->delete();

        	return redirect()->back()->with($request->session()->flash('admin-success', 'Подкатегорията беше успешно изтрита.'));

    	}
    }

    public function getBrands()
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		$brands = Brands::paginate(15);

    		return view('admin.brands')
    			->with('brands', $brands);

    	}

    	return redirect('/');
    }

    public function createBrands(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		$validator = Validator::make($request->all(), [
	    		'name' => 'required',
	    		'position' => 'required|integer',
	    	]);

	    	if ($validator->fails()) {
	            return redirect('/admin/brands')
	                ->withErrors($validator)
	                ->withInput();
	        }

	    	$brand = new Brands;

	    	$brand->name = $request->input('name');
	    	$brand->position = $request->input('position');
	    	$brand->save();

	    	return redirect()->back()->with($request->session()->flash('admin-success', 'Успешно създадохте марка АВТОМОБИЛИ.'));

    	}

    	return redirect('/');
    }

    public function updateBrands(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		Brands::where('id', $request->input('brand-id'))
            	->update([
	                'name' => $request->input('name'),
	                'position' => $request->input('position'),
            	]);

            return redirect()->back()->with($request->session()->flash('admin-success', 'Марка АВТОМОБИЛИ беше обновена успешно.'));
    	}
    }

    public function deleteBrands(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		Brands::where('id', $request->input('brand-id'))->delete();

        	return redirect()->back()->with($request->session()->flash('admin-success', 'Марка АВТОМОБИЛИ беше успешно изтрита.'));
    	}
    }

    public function getModels(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		$brands = Brands::all();

    		$models = DB::table('models')
    			->where('in_brand', $request->input('brand-id'))
    			->orderBy('position', 'asc')
    			->get();

    		return view('admin.models')
    			->with('brands', $brands)
    			->with('models', $models);
    	}

    	return redirect('/');
    }

    public function createModels(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

	    	$validator = Validator::make($request->all(), [
	    		'name' => 'required',
	    		'brand-id' => 'required|integer',
	    		'position' => 'required|integer',
	    	]);

	    	if ($validator->fails()) {
	            return redirect('/admin/models')
	                ->withErrors($validator)
	                ->withInput();
	        }

	    	$model = new Models;

	    	$model->name = $request->input('name');
	    	$model->in_brand = $request->input('brand-id');
	    	$model->position = $request->input('position');
	    	$model->save();

	    	return redirect()->back()->with($request->session()->flash('admin-success', 'Успешно създадохте модел АВТОМОБИЛ.'));

    	}

    	return redirect('/');
    }

    public function updateModels(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') {

    		Models::where('id', $request->input('model_id'))
            	->update([
	                'name' => $request->input('name'),
	                'in_brand' => $request->input('brand-id'),
	                'position' => $request->input('position'),
            	]);

            return redirect()->back()->with($request->session()->flash('admin-success', 'Модел АВТОМОБИЛ беше обновен успешно.'));
    	}
    }

    public function deleteModels(Request $request)
    {
    	if (Auth::user()->email == 'manchev@avtoparts.bg') { 

    		Models::where('id', $request->input('model_id'))->delete();

        	return redirect()->back()->with($request->session()->flash('admin-success', 'Модел АВТОМОБИЛ беше успешно изтрит.'));

    	}
    }

    public function getOrders(Request $request)
    {
        $orders = DB::table('orders')
            ->orderBy('id', 'desc')
            ->paginate(15);

        foreach ($orders as $order) {
            $user = User::where('id', $order->user_id);
        };


        return view('admin.view-orders')
            ->with('orders', $orders)
            ->with('user', $user);
    }

    public function confirmOrders(Request $request, $id)
    {
        Orders::where('id', $id)
            ->update([
                'status' => $request->input('shipment-office'),
            ]);

        return redirect()->back()->with($request->session()->flash('admin-success', 'Поръчката беше одобрена.'));
    }

    public function getCreatePost()
    {
        $blog_posts = DB::table('blog_posts')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.create_post')
            ->with('blog_posts', $blog_posts);
    }

    public function createPost(Request $request)
    {
        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            $file = Input::file('file');
            $name = $file->getClientOriginalName();

            File::copy($file, public_path().'/uploads/'.$name);

            $blog_post = new BlogPosts;

            $blog_post->post_title = $request->input('post_title');
            $blog_post->post_description = $request->input('post_description');
            $blog_post->post_image = '/uploads/'.$name;
            $blog_post->post_content = $request->input('post_content'); 
            $blog_post->save();

            return redirect()->back()->with($request->session()->flash('admin-success', 'Успешно създаден блог пост.'));

        }
    }

    public function deletePost(Request $request)
    {
        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            BlogPosts::where('id', $request->input('news_id'))->delete();

            return redirect()->back()->with($request->session()->flash('admin-success', 'Успешно изтрит блог пост.'));

        }
    }

    public function getContacts()
    {
        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            $contacts = Contacts::all();

            return view('admin.contacts')
                ->with('contacts', $contacts);

        }
    }

    public function updateContacts(Request $request, $id)
    {
        if (Auth::user()->email == 'manchev@avtoparts.bg') {

            Contacts::where('id', $request->input('contact_id'))
                ->update([
                    'text' => $request->input('text'),
                ]);

            return redirect()->back()->with($request->session()->flash('admin-success', 'Контакт беше обновен успешно.'));

        }
    }
}
