@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto space-y-8">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Etudiants
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Gérez les étudiants de votre école
                </p>
            </div>
        </div>
    </div>

    @can('create', App\entity\user\User::class)
        @include('pages.students.drawers.student-form')
    @endcan

@endsection
