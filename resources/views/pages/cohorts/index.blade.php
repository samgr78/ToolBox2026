@extends('layouts.app-layout')

@section('content')

    <div class="max-w-6xl mx-auto space-y-8">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Promotions
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Gérez les promotions de votre école
                </p>
            </div>

        </div>

        {{-- Table --}}
        @include('pages.cohorts.tables.cohorts-table')

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </div>
    @can('create', App\entity\cohort\Cohort::class)
        @include('pages.cohorts.drawers.update-cohort-form')
    @endcan

    @can('create', App\entity\cohort\Cohort::class)
        @include('pages.cohorts.drawers.cohort-form')
    @endcan

@endsection
