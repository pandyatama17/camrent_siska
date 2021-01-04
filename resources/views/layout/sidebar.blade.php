<!-- Sidebar user (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="info">
    <a href="#" class="d-block">{{Auth::user()->first_name." ".Auth::user()->last_name}}</a>
  </div>
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    @if (Auth::user()->user_type == 'admin')
      <li class="nav-header">ORDERS</li>
      {{-- <li class="nav-item">
        <a href="#" class="nav-link text-info">
          <i class="fas fa-clipboard nav-icon vert-move"></i>
          <p>
            Accept Order
            <span class="right badge badge-info">New</span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link text-success">
          <i class="fas fa-clipboard-check nav-icon"></i>
          <p>
            Finish Order
          </p>
        </a>
      </li> --}}
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>
            Rents
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('show_orders')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Orders</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('show_unnacepted_orders')}}" class="nav-link">
              <i class="far fa-circle nav-icon text-warning"></i>
              <p>Unaccepted Orders</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('show_accepted_orders')}}" class="nav-link">
              <i class="far fa-circle nav-icon text-info"></i>
              <p>Accepted Orders</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{route('show_finished_orders')}}" class="nav-link">
          <i class="fas fa-history nav-icon"></i>
          <p>Rent History</p>
        </a>
      </li>
      <li class="nav-header">INVENTORY</li>
      <li class="nav-item">
        <a href="{{route('show_items')}}" class="nav-link">
          <i class="fas fa-warehouse nav-icon"></i>
          <p>Items</p>
        </a>
        @php
          $reqs = count(\App\Item::where('accepted',false)->get());
        @endphp
        <a href="{{route('show_unaccepted_items')}}" class="nav-link">
          <i class="fas fa-handshake nav-icon"></i>
          <p>Lease Request @if($reqs > 0)<span class="badge badge-warning">{{$reqs}}</span> @endif</p>
        </a>
        <a href="{{route('show_retract_requests')}}" class="nav-link">
          <i class="fas fa-dolly nav-icon"></i>
          <p>Retract Request @if($reqs > 1000)<span class="badge badge-warning">{{$reqs}}</span> @endif</p>
        </a>
      </li>
      <li class="nav-header">TENANTS</li>
      <li class="nav-item">
        <a href="{{route('show_unnacepted_commissions')}}" class="nav-link">
          <i class="fas fa-comment-dollar nav-icon"></i>
          <p>Commission Request</p>
        </a>
        <a href="{{route('show_commissions')}}" class="nav-link">
          <i class="fas fa-history nav-icon"></i>
          <p>Commissions</p>
        </a>
        <a href="{{route('show_clients')}}" class="nav-link">
          <i class="fas fa-users nav-icon"></i>
          <p>Tenant List</p>
        </a>
      </li>
      <li class="nav-header">CLIENTS</li>
      <li class="nav-item">
        <a href="{{route('show_clients')}}" class="nav-link">
          <i class="fas fa-users nav-icon"></i>
          <p>Client List</p>
        </a>
      </li>
    @elseif (Auth::user()->user_type == 'tenant')
      <li class="nav-header">ITEMS</li>
      <li class="nav-item">
        <a href="{{route('tenant_index')}}" class="nav-link">
          <i class="fas fa-box-open nav-icon"></i>
          <p>My Items</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('tenant_add_item')}}" class="nav-link">
          <i class="fas fa-plus nav-icon"></i>
          <p>Add Item</p>
        </a>
      </li>
      <li class="nav-header">COMMISIONS</li>
      <li class="nav-item">
        <a href="{{route('tenant_request_commission')}}" class="nav-link">
          <i class="fas fa-hand-holding-usd nav-icon"></i>
          <p>Request Commission</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('tenant_show_commissions',Auth::user()->id)}}" class="nav-link">
          <i class="fas fa-history nav-icon"></i>
          <p>My Commissions</p>
        </a>
      </li>
    @endif
  </ul>
</nav>
<!-- /.sidebar-menu -->
