@extends('layouts.app')

@section('content')

    <div>{{ __('Dashboard') }}</div>

    <div>
        @if (session('status'))
            <div role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

@endsection
