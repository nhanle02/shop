<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductAdminService;
use App\Http\Services\Menu\MenuService;
use App\Http\Requests\Product\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $ProductAdminService;
    protected $menuService;

    public function __construct(ProductAdminService $ProductAdminService, MenuService $menuService) {
        $this->ProductAdminService = $ProductAdminService;
        $this->menuService = $menuService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = $this->ProductAdminService->getAll();
        return view('admin.product.list', [
            'title' => 'Danh sách danh mục sản phẩm',
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Thêm sản phẩm mới',
            'menus' => $this->menuService->getAllForSelect(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->ProductAdminService->insert($request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $menus = $this->menuService->getAllForSelect();
        $product = $this->ProductAdminService->getProductById($id);
        return view('admin.product.edit', [
            'title' => 'Edit sản phẩm',
            'menus' => $menus,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->ProductAdminService->destroy($id);
        return back()->with('success', 'Delete record successfully!!');
    }
}
