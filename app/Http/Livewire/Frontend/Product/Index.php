<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $products, $category, $brandInputs = [];
    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
    ];

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $this->products = $this->category->products()
            ->join('brands', 'brand_id', '=', 'brands.id')
            ->select('brands.name as brand_name', 'products.*')
            ->when($this->brandInputs, function ($q) {
                $q->whereIn('brand_id', $this->brandInputs);
            })
            ->get();
        $this->brands = $this->category->brands()->distinct()->orderBy('name')->get();

        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category,
            'brands' => $this->brands
        ]);
    }
}
