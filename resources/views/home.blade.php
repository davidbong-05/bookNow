<x-master>
    <div class="container-fluid">
        <div class="row">
            <announcements-big bg-img-url="{{ asset('/img/background.jpg') }}"></announcements-big>
        </div>
        <div class="row" id="facilities">
            @include('_facilities')
        </div>
    </div>
    <contact-us></contact-us>

</x-master>
