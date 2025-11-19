@if ($products->count() > 0) 

@foreach ($products as $product)

  <div class="col-md-6 col-lg-6 col-xl-4">
    
    <div class="rounded position-relative fruite-item">
      <div class="fruite-img">
        <img src="{{ asset($product->image) }}" class="img-fluid w-100 rounded-top" style="height: 400px; width: 306px;"
          alt="">
      </div>
      <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
        {{ $product->subcategory->name }}</div>
      <div class="p-4 border border-secondary border-top-0 rounded-bottom">
        <h4 style="font-size: 20px; font-weight: 400; width: 100%;
                                  white-space: nowrap; 
                                  overflow: hidden;      
                                  text-overflow: ellipsis;">{{ $product->title }}</h4>
        <p style="font-size: 15px; font-weight: 400; width: 100%;
                                  white-space: nowrap; 
                                  overflow: hidden;      
                                  text-overflow: ellipsis;">{{ $product->description }}</p>
        <div class="d-flex justify-content-between flex-lg-wrap">
          <p class="text-dark fs-5 fw-bold mb-0">{{ $product->price }}$</p>
          <a href="{{route('product-detail' , $product->id)}}" class="btn border border-secondary rounded-pill px-3 text-primaryadd_to_cart" data-product_id="{{ $product->id }}"><i
              class="fa fa-shopping-bag me-2 text-primary"></i> Details </a>
        </div>
      </div>
    </div>
  </div>
@endforeach

@else

<div class="d-flex justify-content-center">
  <img src="{{ asset('storage/images/product-not-found-illustration-in-pastel-flat-style-great-for-empty-state-ui-online-store-errors-or-inventory-pages-fully-editable-with-soft-tones-and-clean-layout-free-vector.jpg  ') }}" alt="">
</div>

@endif

@if ($products->lastPage() > 1)
    <div class="col-12">
        <div class="pagination d-flex justify-content-center mt-5">

            @php
                $current = $products->currentPage();
                $last = $products->lastPage();

                // Group pages in blocks of 5
                $blockStart = floor(($current - 1) / 5) * 5 + 1;
                $blockEnd = min($blockStart + 4, $last);
            @endphp

            {{-- Previous Page --}}
            @if ($products->onFirstPage())
                <span class="rounded">&laquo;</span>
            @else
                <a href="{{ $products->appends(request()->query())->previousPageUrl() }}" class="rounded">&laquo;</a>
            @endif

            {{-- Page Numbers --}}
            @for ($i = $blockStart; $i <= $blockEnd; $i++)
                @if ($i == $current)
                    <a class="active rounded">{{ $i }}</a>
                @else
                    <a href="{{ $products->appends(request()->query())->url($i) }}" class="rounded">{{ $i }}</a>
                @endif
            @endfor

            {{-- Next Page --}}
            @if ($products->hasMorePages())
                <a href="{{ $products->appends(request()->query())->nextPageUrl() }}" class="rounded">&raquo;</a>
            @else
                <span class="rounded">&raquo;</span>
            @endif

        </div>
    </div>
@endif
