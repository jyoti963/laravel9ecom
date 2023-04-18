<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo('App\Models\Section' , 'section_id')->select('id','name');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category' , 'category_id')->select('id','category_name');
    }

    public function attribute()
    {
        return $this->hasMany('App\Models\Attribute');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public static function getDiscountPrice($product_id)
    {
        $productDtls = Product::select('product_price', 'product_discount','category_id')
                                ->where('id',$product_id)
                                ->first();

        $productDtls = json_decode(json_encode($productDtls) , true);

        $categoryDtls = Category::select('category_discount')
                                 ->where('id',$productDtls['category_id'])
                                 ->first();

        $categoryDtls = json_decode(json_encode($categoryDtls) , true);

        if ($productDtls['product_discount'] > 0) {

            $discount_price = $productDtls['product_price'] - ($productDtls['product_price'] * $productDtls['product_discount'] / 100);

        }elseif ($categoryDtls['category_discount'] > 0) {

            $discount_price = $productDtls['product_price'] - ($productDtls['product_price'] * $categoryDtls['category_discount'] / 100);


        }else {
            $discount_price = 0;
        }

        return $discount_price;
    }
}
