@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto space-y-8">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    Promotions
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Gérez les promotions de votre école
                </p>
            </div>

        </div>

        @can('create', App\Entity\Cohort\Cohort::class)
            @include('pages.cohorts.drawers.cohort-form')
        @endcan

        {{-- Table --}}
        @include('pages.cohorts.partials.cohorts-table')


    </div>

@endsection
