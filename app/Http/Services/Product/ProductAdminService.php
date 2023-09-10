<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    protected function isValidPrice($request) {

        if ($request->input('price') !== 0 && $request->input('price_sale') !== 0
                && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'price_sale must be less than price');
            return false;
        }

        if ($request->input('price') == 0 && $request->input('price_sale') == 0) {
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
            $attributes = $request->except('_token');
            $attributes['thumb'] = '';
            $product = Product::create($attributes);

            $thumbPath = $this->uploadFile($request, $product);

            if ($thumbPath) {
                Product::where('id', $product->id)->update([
                    'thumb' => $thumbPath,
                ]);
            }

            Session::flash('success', 'Product created successfully');
        } catch (\Exception $err) {
            Session::flash('error', 'Product created failed');
            \Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    /**
     * @param $request
     * @return false|string|void
     */
    public function uploadFile($request, $product)
    {
        if ($request->hasFile('thumb')) {
            try {
                $productId = $product->id;
                $pathFull = 'uploads/products/' . $productId;

                $name = $request->file('thumb')->getClientOriginalName();
                $name = time() . '-' . $name;

                $request->file('thumb')->storeAs(
                    'public/' . $pathFull, $name
                );

                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $error) {
                return false;
            }

        }
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
//        $products = Product::join('menus', 'products.menu_id', '=', 'menus.id')
//            ->select('products.*', 'menus.name as name_menu')
//            ->paginate(10);
//        return $products;
        return Product::with('menu')->paginate(10); //load()
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        return Product::where('id', $id)->delete();
    }

    public function getProductById($id)
    {
//        return Product::where('id', $id)->first();
        return Product::find($id);
    }
}
