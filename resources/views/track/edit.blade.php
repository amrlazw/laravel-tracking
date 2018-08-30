@extends('layouts.app')

@section('title', 'Edit track')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.1/flatpickr.min.css"
          integrity="sha256-TV6wP5ef/UY4bNFdA1h2i8ASc9HHcnl8ufwk94/HP4M=" crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.1/flatpickr.min.js"
            integrity="sha256-xYW0mVKSgKFu1yJ15BrY8JesOJIMcGv9tLU6PZJ1W7Q=" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <form action="{{ route('tracks.update', ['track' => $track]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="btn-group d-flex" role="group">
                        <a href="{{ route('tracks.index') }}" class="btn btn-warning w-100">Back</a>
                        <button type="submit" class="btn btn-info w-100">Save</button>
                    </div>
                    <div class="btn-group btn-group-justified">
                    </div>
                    <h4 class="text-info">Load Information</h4>
                    {{-- code --}}
                    <div class="form-group">
                        <label for="">Tracking</label>
                        <input type="text" name="code" class="form-control form-control-lg" placeholder="Tracking"
                               required value="{{ $track->code }}">
                    </div>
                    {{-- from --}}
                    <div class="form-group">
                        <label for="">From</label>
                        <input type="text" name="from" class="form-control form-control-lg autocomplete"
                               placeholder="From" required
                               id="from" value="{{ $track->from }}">
                    </div>
                    {{-- to --}}
                    <div class="form-group" id="locationField">
                        <label for="">To</label>
                        <input type="text" name="to" class="form-control form-control-lg autocomplete" placeholder="To"
                               required
                               id="to" value="{{ $track->to }}">
                    </div>
                    {{-- dims --}}
                    <div class="form-group">
                        <label for="">Dimensions (LxWxH)</label>
                        <input type="text" name="dims"
                               class="form-control form-control-lg"
                               placeholder="Dimensions (LxWxH)" value="{{ $track->dims }}">
                    </div>
                    {{-- load --}}
                    <div class="form-group">
                        <label for="">Load</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="load_pc" placeholder="pc(s)"
                                       value="{{ $track->load_pc }}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="load_lbs" placeholder="lbs"
                                       value="{{ $track->load_lbs }}">
                            </div>
                        </div>
                    </div>
                    <h4 class="text-info">Load Status</h4>
                    {{-- at_origin --}}
                    <div class="form-group">
                        <label for="">Origin</label>
                        <input type="text" name="at_origin"
                               class="form-control form-control-lg autocomplete"
                               placeholder="Origin" value="{{ $track->at_origin }}">
                    </div>
                    {{-- at_origin_date --}}
                    <div class="form-group">
                        <label for="">Origin date</label>
                        <input type="text" name="at_origin_date"
                               class="form-control form-control-lg js-date-picker"
                               placeholder="Origin date"
                               value="{{ $track->at_origin_date ? $track->at_origin_date->format('m-d-Y H:i') : '' }}">
                    </div>
                    {{-- freight_loaded list--}}
                    <div id="freight_loaded_container">
                        <h3>Freight loaded </h3>
                        <button type="button" class="btn btn-success btn-block" id="add_freight_loaded_btn">Add freight
                            loaded
                        </button>
                        @foreach($track->locations as $location)
                            @if($location->type == "freight_loaded")
                                <div class="card card-body">
                                    {{-- freight_loaded--}}
                                    <div class="form-group">
                                        <label>Freight loaded</label>
                                        <input type="text" name="freight_loads[]"
                                               class="form-control form-control-lg autocomplete"
                                               placeholder="Freight loaded" value="{{ $location->value }}">
                                    </div>
                                    {{-- freight_loaded_date --}}
                                    <div class="form-group">
                                        <label>Freight loaded date</label>
                                        <input type="text" name="freight_loaded_dates[]"
                                               class="form-control form-control-lg js-date-picker"
                                               placeholder="Freight loaded date"
                                               value="{{ $location->date ? $location->date->format('m-d-Y H:i') : '' }}">
                                    </div>
                                    <button type="button" class="btn btn-danger delete_btn">DELETE</button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{-- current_location --}}
                    <div class="form-group">
                        <label for="">Current location</label>
                        <input type="text" name="current_location"
                               class="form-control form-control-lg autocomplete"
                               placeholder="Current location" value="{{ $track->current_location }}">
                    </div>
                    {{-- current_location_date --}}
                    <div class="form-group">
                        <label for="">Current location date</label>
                        <input type="text" name="current_location_date"
                               class="form-control form-control-lg js-date-picker"
                               placeholder="Current location date"
                               value="{{ $track->current_location_date ? $track->current_location_date->format('m-d-Y H:i') : '' }}">
                    </div>
                    {{-- at_distination --}}
                    <div class="form-group">
                        <label for="">Distination</label>
                        <input type="text" name="at_distination"
                               class="form-control form-control-lg autocomplete"
                               placeholder="Distination" value="{{ $track->at_distination }}">
                    </div>
                    {{-- at_distination_date --}}
                    <div class="form-group">
                        <label for="">Distination date</label>
                        <input type="text" name="at_distination_date"
                               class="form-control form-control-lg js-date-picker"
                               placeholder="Distination date"
                               value="{{ $track->at_distination_date ? $track->at_distination_date->format('m-d-Y H:i') : '' }}">
                    </div>
                    {{-- delivered --}}
                    <div class="form-group">
                        <label for="">Delivered</label>
                        <input type="text" name="delivered"
                               class="form-control form-control-lg js-date-picker"
                               placeholder="Delivered" value="{{ $track->delivered }}">
                    </div>
                    <h4 class="text-info">Load Summary</h4>
                    {{-- status --}}
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control form-control-lg">
                            <option value="0" {{ $track->status == 0 ? 'selected' : '' }}>On away a pick up</option>
                            <option value="1" {{ $track->status == 1 ? 'selected' : '' }}>At pick up</option>
                            <option value="2" {{ $track->status == 2 ? 'selected' : '' }}>At transit</option>
                            <option value="3" {{ $track->status == 3 ? 'selected' : '' }}>At delivery</option>
                            <option value="4" {{ $track->status == 4 ? 'selected' : '' }}>Delivered</option>
                        </select>
                    </div>
                    {{-- status --}}
                    <div class="form-group">
                        <label for="">Signed by</label>
                        <input type="text" name="pod"
                               class="form-control form-control-lg"
                               placeholder="Signed by" value="{{ $track->pod }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-info btn-lg btn-block" value="Edit">
                    </div>
                </form>
            </div>
            <!--<div class="col-md-6">
                111
            </div>-->
        </div>
    </div>

    <script src="{{ asset('js/zepto.min.js') }}"></script>
    <script>
        initDatePicker(".js-date-picker");

        $('button#add_freight_loaded_btn').on('click', function () {
            $('div#freight_loaded_container').append(
                '                       <div class="card card-body">\n' +
                '                            <div class="form-group">\n' +
                '                                <label>Freight loaded</label>\n' +
                '                                <input type="text" name="freight_loads[]"\n' +
                '                                       class="form-control form-control-lg autocomplete"\n' +
                '                                       placeholder="Freight loaded">\n' +
                '                            </div>\n' +
                '                            <div class="form-group">\n' +
                '                                <label>Freight loaded date</label>\n' +
                '                                <input type="text" name="freight_loaded_dates[]"\n' +
                '                                       class="form-control form-control-lg js-date-picker2"\n' +
                '                                       placeholder="Freight loaded date">\n' +
                '                            </div>\n' +
                '                            <button type="button" class="btn btn-danger delete_btn">DELETE</button>\n' +
                '                        </div>');
            initAutocomplete();
            initDatePicker(".js-date-picker2");
        });

        $(document).on('click', 'button.delete_btn', function () {
            $(this).parent().remove();
        });


        function initAutocomplete() {
            var options = {
                types: ['geocode'],
                componentRestrictions: {country: "us"}
            };

            var input = document.getElementsByClassName('autocomplete');

            for (i = 0; i < input.length; i++) {
                autocomplete = new google.maps.places.Autocomplete(input[i], options);
            }
        }

        function initDatePicker(element) {
            var date = new Date();
            flatpickr(element, {
                enableTime: true,
                dateFormat: "m-d-Y H:i",
                defaultHour: date.getHours(),
                defaultMinute: date.getMinutes(),
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&language=en&callback=initAutocomplete"
            async defer></script>
@endsection
