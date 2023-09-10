@extends('admin.main')
@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection
@section('content')
    <form role="form" action="{{ route('admin.product.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" id="name" placeholder="Enter name product">
            </div>
            <div class="form-group">
                <label for="menu_id">Danh mục</label>
                <select class="form-control" name="menu_id" id="menu_id">
                    <option value="0"> Danh mục cha </option>
                    @foreach ($menus as $menu)
                        <option
                            value="{{ $menu->id }}"
                            {{ old('menu_id', $product->menu_id) == $menu->id ? 'selected': '' }}
                        >{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô tả ngắn</label>
                <textarea type="text" name="description" class="form-control"  placeholder="Enter description">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Mô tả chi tiết</label>
                <textarea type="text" name="content" id="content" class="form-control"  placeholder="Enter content">{{ old('content', $product->content) }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" value="{{ old('price', $product->price) }}" class="form-control" id="price" placeholder="Enter Price ">
            </div>
            <div class="form-group">
                <label for="price_sale">Price sale</label>
                <input type="text" name="price_sale" value="{{ old('price_sale', $product->price_sale) }}" class="form-control" id="price_sale" placeholder="Enter Price Sale">
            </div>
            <div class="form-group">
                <label for="upload">Ảnh sản phẩm</label>
                <input type="file" name="thumb" class="form-control upload-file" />
                <div class="image-show">
                    <img src="{{ $product->thumb }}" alt="">
                </div>
{{--                <input type="file" class="form-control" id="upload">--}}
{{--                <div id="image_show"></div>--}}
{{--                <input type="hidden" name="file" id="file">--}}
            </div>
            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="radio custom-control">
                    <label for="active">
                        <input type="radio" name="active" id="active" value="1" checked="">
                        Active
                    </label>
                </div>
                <div class="radio custom-control">
                    <label for="no_active">
                        <input type="radio" name="active" id="no_active" value="0">
                        No active
                    </label>
                </div>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Create Product</button>
        </div>
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection
