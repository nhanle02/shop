<?php

namespace App\Http\Services\Product;

use App\Models\Product; 
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    protected function isValidPrice($request) {
        if ($request->input('price')!== 0 && $request->input('price_sale')!== 0
                && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'price_sale must be less than price');
            return false;
        }

        if ($request->input('price')!= 0 && $request->input('price_sale')== 0) {
            Session::flash('error', 'please enter price');
            return false;
        }   

        return true;
    }

    public function insert($request) {
        $isValidPrice = $this->isValidPrice($request);

        if ($isValidPrice === false) {
            return false;
        }
        try {
            $request->except('_token');
            Product::create($request->all());

            Session::flash('success', 'Product created successfully');
        } catch (\Exception $err) { 
            Session::flash('error', 'Product created failed');
            \Log::info($err->getMessage());
            return false;
        }

        return true;
    }
}
