<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu; 
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\http\Services\Menu\MenuService;
class MenuController extends Controller
{   

    protected $menuService;

    public function __construct(MenuService $menuService) {
        $this->menuService = $menuService;
    }

    public function create() {
        return view('admin.menus.add', [
            'title' => 'Thêm danh mục mới',
            'menus' => $this->menuService->getParent(),
        ]);
    }   

    public function store(CreateFormRequest $request) {
        $this->menuService->create($request);

        return redirect()->back();
    }

    public function index() {
        return view('admin.menus.list', [
            'title' => 'Danh sách danh mục mới nhất',
            'menus' => $this->menuService->getAll(),
        ]);
    }

    public function show(Menu $menu) {
        return view('admin.menus.edit', [
            'title' => 'Chỉnh sữa danh sách danh mục: ' . $menu->name,
            'menus' => $this->menuService->getParent(),
            'menu' => $menu
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request) {
        $this->menuService->update($menu, $request);

        return redirect('/admin/menus/list');
    }

    public function destroy(Request $request):JsonResponse {
        $result = $this->menuService->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'remove successfully!',
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
