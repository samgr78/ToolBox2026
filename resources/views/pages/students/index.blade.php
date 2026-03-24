@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-3">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        Etudiants
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Gérez les étudiants de votre école
                    </p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            @include('pages.students.partials.students-table')
        </div>

        <div class="lg:col-span-1">
            @can('create', App\Entity\user\User::class)
                @include('pages.students.drawers.student-form')
            @endcan
        </div>

    </div>

@endsection
