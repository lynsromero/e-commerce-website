@extends('admin-panel.layouts.app')

@section('content')
  <div class>
    @include('message')
    <div class="page-title">
      <div class="title_left">
        <h3>Products</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Products <small>List</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Discount Price</th>
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>image</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($products as $key => $product)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->discount_price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->subcategory->name }}</td>
                    <td>
                      {!! $product->img() !!}
                    </td>
                    <td>
                      <a href="{{ route('product.delete', $product->id) }}"><i class="fa fa-trash"></i></a> |||
                      <a href="{{ route('product.edit' , $product->id) }}"><i class="fa fa-edit"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>

            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection