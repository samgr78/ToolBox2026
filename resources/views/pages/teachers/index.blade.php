@extends('layouts.app-layout')

@section('content')

    <div class="max-w-6xl mx-auto space-y-8">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Enseignants
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Gérez les enseignants de votre école
                </p>
            </div>
        </div>
    </div>

    @can('create', App\entity\user\User::class)
        @include('pages.teachers.drawers.teacher-form')
    @endcan

@endsection
