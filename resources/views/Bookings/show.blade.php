<x-master>
    <div class="container px-4 py-4">
        @forelse ($bookings as $booking)
            <booking-card :booking="{{ $booking }}" :facility='"{{ $booking->courts->facilities->name }}"'
                :court='"{{ $booking->courts->name }}"'> </booking-card>
        @empty
            <p class="text-gray-500 p-4">No booking yet...</p>
        @endforelse
    </div>
</x-master>
