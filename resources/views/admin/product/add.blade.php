@extends('admin.main')
@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection 
@section('content')
    <form role="form" action="" method="POST">
        <div class="box-body">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name product">
            </div>
            <div class="form-group">
                <label for="menu_id">Danh mục</label>
                <select class="form-control" name="menu_id" id="menu_id">
                    <option value="0"> Danh mục cha </option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>  
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô tả ngắn</label>
                <textarea type="text" name="description" class="form-control"  placeholder="Enter description">
                </textarea>
            </div>
            <div class="form-group">
                <label for="content">Mô tả chi tiết</label>
                <textarea type="text" name="content" id="content" class="form-control"  placeholder="Enter content">
                </textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" class="form-control" id="price" placeholder="Enter Price ">
            </div>
            <div class="form-group">
                <label for="price_sale">Price sale</label>
                <input type="text" name="price_sale" class="form-control" id="price_sale" placeholder="Enter Price Sale">
            </div>
            <div class="form-group">
                <label for="upload">Ảnh sản phẩm</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show"></div>
                <input type="hidden" name="file" id="file">
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
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection