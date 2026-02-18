@extends('layouts.app-layout')

@section('content')
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            @include('pages.cohorts.tables.cohorts-table')
        </div>
    </div>

    @include('pages.cohorts.drawers.cohort-form')
@endsection
