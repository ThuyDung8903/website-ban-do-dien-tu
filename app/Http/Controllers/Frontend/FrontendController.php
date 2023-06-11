<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Banner::where('status', '1')->get();
        $categories = Category::where('status', '1')->get();
        $trendingProducts = Product::where('status', '1')->whereHas('categories', function ($query) {
            $query->where('status', '1');
        })->where('trending', '1')->latest()->take(20)->get();
        $newArrivalsProducts = Product::where('status', '1')->whereHas('categories', function ($query) {
            $query->where('status', '1');
        })->latest()->take(20)->get();
        View::share('categories', $categories);
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivalsProducts', 'categories'));
    }

    public function searchProducts(Request $request)
    {
        if($request->keyword)
        {
            $keyword = $request->keyword;
            $searchProducts = Product::where('status', '1')
                ->whereHas('category', function ($query) {
                $query->where('status', '1');})
                ->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('short_description', 'like', '%' . $keyword . '%')
                ->orWhere('detail_description', 'like', '%' . $keyword . '%')
                ->paginate(10);
            return view('frontend.pages.search', compact('searchProducts', 'keyword'));
        } else {
            return redirect()->back()->with('message', 'Please enter a keyword to search');
        }

    }

    public function categories()
    {
        $categories = Category::where('status', '1')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->where('status', '1')->first();
        if ($category) {
            return view('frontend.collections.products.index', compact('category'));
        } else {
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->where('status', '1')->first();
        if ($category) {
            $product = $category->products()->where('slug', $product_slug)->where('status', '1')->first();
            if ($product) {
                return view('frontend.collections.products.view', compact('category', 'product'));
            } else {
                return redirect()->back();
            }
            return view('frontend.collections.product.view', compact('category', 'product'));
        } else {
            return redirect()->back();
        }
    }

    public function newArrivals()
    {
        $newArrivalsProducts = Product::where('status', '1')->whereHas('categories', function ($query) {
            $query->where('status', '1');
        })->latest()->take(36)->paginate(12);
        return view('frontend.pages.new-arrivals', compact('newArrivalsProducts'));
    }

    public function trendingProducts()
    {
        $trendingProducts = Product::where('status', '1')->whereHas('categories', function ($query) {
            $query->where('status', '1');
        })->where('trending', '1')->latest()->take(36)->paginate(12);
        return view('frontend.pages.trending-products', compact('trendingProducts'));
    }
    public function thankYou()
    {
        return view('frontend.thank-you');
    }

    public function aboutUs()
    {
        return view('frontend.about-us');
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }
}
