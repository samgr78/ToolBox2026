@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Header --}}
        <div class="lg:col-span-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('cohort.index') }}"
                       class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ $cohort->name }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $cohort->description }}
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                                {{ \Carbon\Carbon::parse($cohort->start_date)->format('Y') }}
                                –
                                {{ \Carbon\Carbon::parse($cohort->end_date)->format('Y') }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Teachers Table --}}
        <div class="lg:col-span-2">
            @include('pages.cohorts.partials.teachers-table')
        </div>

        {{-- Add Teacher Form --}}
        <div class="lg:col-span-1">
            @can('update', $cohort)
                @include('pages.cohorts.drawers.add-teacher-form')
            @endcan
        </div>

        {{-- Students Table --}}
        <div class="lg:col-span-2">
            @include('pages.cohorts.partials.students-table')
        </div>

        {{-- Add Student Form --}}
        <div class="lg:col-span-1">
            @can('update', $cohort)
                @include('pages.cohorts.drawers.add-student-form')
            @endcan
        </div>

    </div>

@endsection
