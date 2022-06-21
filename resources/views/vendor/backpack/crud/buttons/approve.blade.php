@if ($crud->hasAccess('approve'))
    <a href="{{ url($crud->route . '/' . $entry->getKey() . '/approve') }}" class="btn btn-sm btn-link text-success">
        <i class="la la-check"></i> Approve</a>
@endif
