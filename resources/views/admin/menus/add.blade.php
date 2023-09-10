@extends('admin.main')
@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection
@section('content')
    <form role="form" action="" method="POST">
        <div class="box-body">
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name menu">
            </div>
            <div class="form-group">
                <label for="parent_id">Danh mục</label>
                <select class="form-control" name="parent_id" id="parent_id">
                    <option value="0"> Danh mục cha </option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô tả ngắn</label>
                <textarea
                    type="text"
                    name="description"
                    class="form-control"
                    placeholder="Enter description"
                ></textarea>
            </div>
            <div class="form-group">
                <label for="content">Mô tả chi tiết</label>
                <textarea type="text" name="content" id="content" class="form-control"  placeholder="Enter content">
                </textarea>
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
        <button type="submit" class="btn btn-primary">Create Category</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection
