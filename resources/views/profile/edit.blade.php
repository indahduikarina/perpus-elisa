{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4 text-pink-600">{{ __('Profile') }}</h2>

    @if (session('status') === 'profile-updated')
        <div class="mb-4 text-green-600">
            {{ __('Profile updated successfully.') }}
        </div>
    @endif

    <div class="mb-6 bg-pink-50 dark:bg-pink-600 shadow sm:rounded-lg p-6">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="mb-6 bg-pink-50 dark:bg-pink-600 shadow sm:rounded-lg p-6">
        @include('profile.partials.update-password-form')
    </div>

    <div class="bg-pink-50 dark:bg-pink-600 shadow sm:rounded-lg p-6">
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection
