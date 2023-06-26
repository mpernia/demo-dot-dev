@extends('layouts.frontend')

@section('front_content')

    <div class="container py-5">
        <div class="row justify-content-evenly">
            <div class="col-md-4">
                @include('frontend.partials.signin')
            </div>

            <div class="col-md-4">
                @include('frontend.partials.login')
            </div>
        </div>
    </div>
@endsection

@section('front_scripts')
    <script type="text/javascript">
        function setType(type) {
            let selected = document.getElementById(type + '_select_type');
            document.getElementById(type + '_type').value = selected.options[selected.selectedIndex].value;
        }
    </script>
@endsection