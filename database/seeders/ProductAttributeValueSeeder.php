<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttributeValue;
use App\Models\Product;
use App\Models\AttributeValue;

class ProductAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy danh sách sản phẩm
        $products = Product::all();

        // Lấy danh sách giá trị thuộc tính
        $attributeValues = AttributeValue::all();

        // Tạo dữ liệu mẫu cho bảng product_attribute_values
        foreach ($products as $product) {
            // Chọn ngẫu nhiên từ 1 đến 5 giá trị thuộc tính cho sản phẩm
            $randomAttributeValues = $attributeValues->random(rand(1, 5));

            // Thêm các giá trị thuộc tính cho sản phẩm
            foreach ($randomAttributeValues as $attributeValue) {
                ProductAttributeValue::create([
                    'product_id' => $product->id,
                    'attribute_value_id' => $attributeValue->id,
                ]);
            }
        }
    }
}
