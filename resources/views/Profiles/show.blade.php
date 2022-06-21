<x-master>
    <div class="container p-4">
        {{-- <div class="relative">
            <img src="{{ $user->banner }}" alt="" class="rounded-md mb-2">

            <img src="{{ $user->avatar }}" alt="your avatar"
                class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                style="width:150px;left:50%;">
        </div> --}}

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center mb-6">

                <div>
                    <h2 class="font-bold text-xl mb-0">{{ $user->name }}</h2>
                    <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
                </div>
                @can('edit', $user)
                    <change-password-button :user_id="{{ $user->id }}" />
                @endcan
            </div>

            <div class="card-body">
                <ul>
                    <li>Faculty:{{ $user->faculty }}</li>
                    <li>Role:{{ $user->role }}</li>
                    <li>Matric No.:{{ $user->id }}</li>
                    <li>Email:{{ $user->email }}</li>
                    <li>Mobile:{{ $user->mobileNum }}</li>
                </ul>
            </div>
        </div>

        <div>

        </div>

    </div>
</x-master>
