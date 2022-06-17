<x-master>
    <div class="py-4">
        <!-- ======= Breadcrumbs ======= -->
        <section aria-label="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('home') }}/#facilities">Facilities</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $facility->name }}</li>
                </ol>
            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Portfolio Details Section ======= -->

        <section id="portfolio-details" class="portfolio-details">
            <div class="container px-4">
                <div class="row">
                    <div class="col-lg-8">
                        <h2 class="display-6">{{ $facility->name }}</h2>
                    </div>
                    <div class="col-lg-4">
                        {{-- use 2 if cuz some court shoult not have button by default --}}

                        @if ($facility->courts->count() != 0)
                            @guest
                                <book-button :status='1'></book-button>
                            @endguest
                            @auth
                                @can('submit-booking')
                                    <book-button :status='0' :facility-id="{{ $facility->id }}"></book-button>
                                @else
                                    @if (current_user()->freshBooking()->isNotEmpty())
                                        <book-button :status='2'></book-button>
                                    @elseif (Carbon\Carbon::now()->format('D') == 'Fri' || Carbon\Carbon::now()->format('D') == 'Sat' || Carbon\Carbon::now()->format('D') == 'Sun')
                                        <book-button :status='3'></book-button>
                                    @endif
                                @endcan
                            @endauth
                        @endif
                    </div>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="my-3 text-center">
                            <img src="{{ $facility->image }}" class="card-img" alt="facility_photo"
                                style="width: 35rem; height :20rem">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h3 class="my-3">Facility Description</h3>

                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida
                        pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus.
                        Mauris ultricies, justo eu convallis placerat, felis enim.


                        <h3 class="my-3">Facility Details</h3>
                        <ul>
                            <li>Lorem Ipsum</li>
                            <li>Dolor Sit Amet</li>
                            <li>Consectetur</li>
                            <li>Adipiscing Elit</li>
                        </ul>
                    </div>

                </div>

            </div>
        </section><!-- End Portfolio Details Section -->
    </div>
    {{-- @include('_reviews') --}}
    <announcements-small></announcements-small>
</x-master>
