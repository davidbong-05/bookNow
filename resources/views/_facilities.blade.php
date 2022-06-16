<div class="container px-5 py-4">

    <h4 class="text-center">OUR FACILITIES</h4>
    <div class="container d-flex flex-wrap justify-content-center">
        @forelse ($facilities as $facility)
            <a href="{{ route('facility.show', $facility->name) }}">
                <facility-card :facility="{{ $facility }}"></facility-card>
            </a>
        @empty
            <p class="text-gray">No facility yet...</p>
        @endforelse
    </div>
</div>
