@if ($crud->hasAccess('approve'))
    <a href="{{ url($crud->route . '/' . $entry->getKey() . '/reject') }}" class="btn btn-sm btn-link text-danger">
        <i class="la la-close"></i> Reject</a>
@endif
