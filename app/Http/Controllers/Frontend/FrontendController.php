<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Banner::where('status', '1')->get();
        $trendingProducts = Product::where('status', '1')->whereHas('categories', function ($query) {
            $query->where('status', '1');
        })->where('trending', '1')->latest()->take(20)->get();
        $newArrivalsProducts = Product::where('status', '1')->whereHas('categories', function ($query) {
            $query->where('status', '1');
        })->latest()->take(20)->get();
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivalsProducts'));
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
        })->latest()->take(16)->get();
        return view('frontend.pages.new-arrivals', compact('newArrivalsProducts'));
    }

    public function trendingProducts()
    {
        $trendingProducts = Product::where('status', '1')->whereHas('categories', function ($query) {
            $query->where('status', '1');
        })->where('trending', '1')->latest()->take(16)->get();
        return view('frontend.pages.trending-products', compact('trendingProducts'));
    }
    public function thankYou()
    {
        return view('frontend.thank-you');
    }
}
