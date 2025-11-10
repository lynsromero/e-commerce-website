@extends('admin-panel.layouts.app')

@section('content')
    <div class>
        <div class="page-title">
            <div class="title_left">
                <h3>Product</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add <small>Product</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                            action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="title" value="{{ old('title') }}" class="form-control col-md-7 col-xs-12"
                                        name="title">
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="price" name="price" value="{{ old('price') }}"
                                        class="form-control col-md-7 col-xs-12">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount_price">Discount Price
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="discount_price" name="discount_price" value="{{ old('discount_price') }}"
                                        class="form-control col-md-7 col-xs-12">
                                    @error('discount_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id"> Category
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($cats as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_category_id"> Sub Category
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="sub_category_id" class="form-control">
                                        <option value="">Select Sub Category</option>
                                        @foreach ($Subcats as $subcat)
                                            <option value="{{ $subcat->id }}" class="sub_cat_options"
                                                data-category_id="{{ $subcat->category_id }}" style="display: none">
                                                {{ $subcat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="image" class="form-control col-md-7 col-xs-12">
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="description" cols="30" class="form-control" rows="10">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('select[name=category_id]').change(function() {
            var category_id = $(this).val();
            $('.sub_cat_options').hide();
            $('.sub_cat_options[data-category_id="' + category_id + '"]').show();
        });
    </script>
@endpush
