<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('announcements') }}'>
        <i class='nav-icon la la-bullhorn'></i> Announcements
    </a>
</li>
<li class='nav-item nav-dropdown'>
    <a class="nav-link nav-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
        aria-expanded="false">
        <i class='nav-icon la la-book'></i> Bookings
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class='nav-link' href='{{ backpack_url('bookings') }}'>
                <i class='nav-icon la la-calendar'></i> All
            </a>
        </li>
        <li class="nav-item">
            <a class='nav-link' href='{{ backpack_url('bookings/pending-request') }}'>
                <i class='nav-icon la la-list'></i> Pending Request
            </a>
        </li>
        <li class="nav-item">
            <a class='nav-link' href='{{ backpack_url('bookings/history') }}'>
                <i class='nav-icon la la-history'></i> History
            </a>
        </li>
    </ul>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('facilities') }}'>
        <i class='nav-icon la la-warehouse'></i> Facilities
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('courts') }}'>
        <i class='nav-icon la la-map-marker'></i> Courts
    </a>
</li>
{{-- <li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('reviews') }}'>
        <i class='nav-icon la la-comment'></i> Reviews
    </a>
</li> --}}
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('user') }}'>
        <i class='nav-icon la la-user'></i> Users
    </a>
</li>
{{-- <li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('black-list') }}'>
        <i class='nav-icon la la-ban'></i> Black lists
    </a>
</li> --}}
