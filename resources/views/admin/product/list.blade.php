@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Name</th>
                <th>Images</th>
                <th>Categories</th>
                <th>Price</th>
                <th>Active</th>
                <th style="width: 100px">Operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>
                    <img width="100" height="100" src="{{ $product->thumb }}" />
                </td>
                <td>{{ $product->menu->name }}</td>
                <td>
                    {{ $product->price_sale }} <strike>{{ $product->price }}</strike>
                </td>
                <td>{{ $product->active }}</td>
                <td>
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info">Edit</a>
                    <a href="javascript:void(0)" data-action="{{ route('admin.product.delete', $product->id) }}" class="btn btn-danger js-show-form-delete">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
