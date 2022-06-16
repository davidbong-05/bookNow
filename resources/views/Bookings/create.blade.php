@section('styles')
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' rel='stylesheet'>
    <style>
        main {
            background-color: #cbced1;
            font-family: inherit;
            min-height: 100%;
        }

        .card {
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
            z-index: 0;
            border: none;
            border-radius: 0.5rem;
            position: relative;
        }
    </style>
@endsection
<x-master>
    <!-- MultiStep Form -->
    <div class="container-fluid" id="wrapper">
        <div class="row justify-content-center mt-0">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-2 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2><strong>Submit Your Booking Request</strong></h2>
                    <p>Fill all form field to go to next step</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <booking-form :courts="{{ $facility->courts }}" :user="{{ current_user() }}">
                            </booking-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>
