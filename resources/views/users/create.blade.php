@extends('layouts.app')

@section('content')

    <h3>Create An Employee</h3>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div>
            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
        </div>
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <input type="hidden" value="{{$userId}}" name="manager"/>

        <input type="hidden" value="{{\App\Models\User::ROLE_EMPLOYEE}}" name="role"/>

        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@endsection
