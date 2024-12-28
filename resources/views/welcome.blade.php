@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <!-- Logo -->
                <img src="{{ asset('images/logo.png') }}" alt="LawBuddy Logo" class="img-fluid mb-4" style="max-width: 200px;">
                
                <!-- Title -->
                <h1 class="display-4">Solve Your Problem with, <strong>LawBuddy.</strong></h1>

                <!-- Description -->
                <p class="lead">
                    Welcome to LawBuddy ChatBot App. Ask AI Questions & get instant answers.
                </p>

                <!-- Buttons -->
                <a href="{{ route('getStarted') }}" class="btn btn-success btn-lg">Get Started</a>
                <a href="{{ route('learnMore') }}" class="btn btn-outline-secondary btn-lg ml-3">Learn More</a>
            </div>
        </div>
    </div>
@endsection
