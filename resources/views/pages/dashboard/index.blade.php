@extends('layouts.app')

@section('content')
  <div class="grid grid-cols-12 gap-4 md:gap-6">
      <div class="col-span-12 xl:col-span-10 ">
          @include('pages.dashboard.partials.cohort-table')
      </div>

      <div class="col-span-12 xl:col-span-10 ">
          @include('pages.dashboard.partials.teacher-table')
      </div>

      <div class="col-span-12 xl:col-span-10 ">
          @include('pages.dashboard.partials.student-table')
      </div>

  </div>
@endsection
