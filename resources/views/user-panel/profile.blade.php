@extends('layouts.app')
@section('content')

<div class="container py-5">
  <div class="row g-4" style="padding-top: 150px">

    <!-- Left Column -->
    <div class="col-lg-4">
      <div class="card p-3 text-center">
        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=600" class="rounded-circle mb-3" width="140" height="140" style="object-fit:cover" id="avatarImg">
        <h5 id="userName">{{ $user->name }}</h5>
        <p class="text-muted" id="userEmail">{{ $user->email }}</p>

        <div class="d-flex justify-content-center gap-2 mt-2">
          <button class="btn btn-outline-primary btn-sm" id="editBtn">Edit Profile</button>
          <a href="{{ route('user.logout') }}" class="btn btn-primary btn-sm">Logout</a>
        </div>

        <div class="row text-center mt-4">
          <div class="col">
            <h5 id="numOrders">8</h5>
            <small class="text-muted">Orders</small>
          </div>
          <div class="col">
            <h5 id="spent">$1,240</h5>
            <small class="text-muted">Total Spent</small>
          </div>
        </div>

        <p class="text-muted mt-3">Member since: Jan 2023</p>
      </div>
    </div>

    <!-- Right Column -->
    <div class="col-lg-8">
      <div class="card p-3 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="m-0">Purchased Products</h5>
          <small class="text-muted">Latest purchases</small>
        </div>

        <div class="row g-3" id="productsList">

          <!-- Product Item -->
          <div class="col-md-4">
            <div class="card h-100">
              <img src="https://images.unsplash.com/photo-1606813902842-6b3b0f2f9f3b?q=80&w=800" class="card-img-top" height="150" style="object-fit:cover">
              <div class="card-body">
                <h6 class="card-title">Wireless Headphones Model X</h6>
                <div class="d-flex justify-content-between">
                  <span class="fw-bold">$89</span>
                  <small class="text-muted">Aug 2025</small>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100">
              <img src="https://images.unsplash.com/photo-1512496015851-a90fb38ba796?q=80&w=800" class="card-img-top" height="150" style="object-fit:cover">
              <div class="card-body">
                <h6 class="card-title">Classic Leather Wallet</h6>
                <div class="d-flex justify-content-between">
                  <span class="fw-bold">$35</span>
                  <small class="text-muted">Jul 2025</small>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100">
              <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800" class="card-img-top" height="150" style="object-fit:cover">
              <div class="card-body">
                <h6 class="card-title">Smartwatch Series 4</h6>
                <div class="d-flex justify-content-between">
                  <span class="fw-bold">$199</span>
                  <small class="text-muted">Jun 2025</small>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="text-center mt-3">
          <button class="btn btn-outline-primary btn-sm" id="viewAllBtn">View All</button>
        </div>
      </div>

      <div class="card p-3">
        <h5>Account</h5>
        <p class="text-muted">Manage your account details, addresses, and payment methods.</p>
      </div>
    </div>

  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Photo URL</label>
          <input type="text" id="inpPhoto" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" id="inpName" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" id="inpEmail" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveEdit">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection


@push('scripts')
  <script>
    const editBtn = document.getElementById('editBtn');
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));


    const avatarImg = document.getElementById('avatarImg');
    const userName = document.getElementById('userName');
    const userEmail = document.getElementById('userEmail');


    const inpPhoto = document.getElementById('inpPhoto');
    const inpName = document.getElementById('inpName');
    const inpEmail = document.getElementById('inpEmail');


    editBtn.addEventListener('click', () => {
      inpPhoto.value = avatarImg.src;
      inpName.value = userName.textContent;
      inpEmail.value = userEmail.textContent;
      editModal.show();
    });


    document.getElementById('saveEdit').addEventListener('click', () => {
      if (inpPhoto.value) avatarImg.src = inpPhoto.value;
      if (inpName.value) userName.textContent = inpName.value;
      if (inpEmail.value) userEmail.textContent = inpEmail.value;
      editModal.hide();
    });


    document.getElementById('viewAllBtn').addEventListener('click', () => {
      const wrapper = document.getElementById('productsList');
      if (document.getElementById('emptyState')) return;


      const div = document.createElement('div');
      div.id = 'emptyState';
      div.className = 'col-12';
      div.innerHTML = `<div class="border rounded p-4 text-center text-muted">No more items to show.</div>`;
      wrapper.appendChild(div);
    });
  </script>

@endpush