@if ($products->count() >0)
  

@foreach ($products as $product)

  <div class="col-md-6 col-lg-4 col-xl-3">
    <div class="rounded position-relative fruite-item">
      <div class="fruite-img">
        <img src="{{ asset($product->image) }}" class="img-fluid w-77 rounded-top" style="height: 350px " alt="">
      </div>
      <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
        {{ $product->subcategory->name }}
      </div>
      <div class="p-4 border border-secondary border-top-0 rounded-bottom">
        <h4 style="font-size: 20px; font-weight: 400; width: 100%;
                            white-space: nowrap; 
                            overflow: hidden;      
                            text-overflow: ellipsis;">{{ $product->title }}</h4>
        <p>{{ $product->description }}</p>
        <div class="d-flex justify-content-between flex-lg-wrap" style="display: flex !important; flex-direction: column;}">
          <div>
            <p class="text-dark fs-5 fw-bold mb-0">{{ $product->price }}$</p>
          </div>
          <div>
            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach

@else

<h5>Products Not Available</h5>

@endif