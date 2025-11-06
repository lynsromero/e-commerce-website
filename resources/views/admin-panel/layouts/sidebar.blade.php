

          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a href="{{ route('users.list') }}"><i class="fa fa-users"></i> Users</a></li>
                <li><a><i class="fa-solid fa-cart-shopping"></i> Products <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('product.create') }}">Create</a></li>
                    <li><a href="{{ route('products.list') }}">List</a></li>
                  </ul>
                </li>
              </ul>
            </div>

          </div>