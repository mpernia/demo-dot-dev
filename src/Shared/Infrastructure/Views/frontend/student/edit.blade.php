@extends('layouts.frontend')

@section('front_content')
    <section class="py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>
                    <div class="card-body">
                        @include('frontend.partials.reset')
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
