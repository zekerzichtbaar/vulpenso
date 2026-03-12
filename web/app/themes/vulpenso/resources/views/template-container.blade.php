{{--
  Template Name: Container Template
--}}

@extends('layouts.app')

@section('content')

@php
  global $post;
  wp_reset_postdata()
@endphp

<x-section class="relative text-white">
  <div class="container ">
    <div class="relative z-30">
        <div class="max-w-5xl mx-auto">
          <div class="md:col-span-2 prose lg:prose-lg prose-invert prose-strong:text-white prose-headings:text-white prose-headings:font-medium prose-em:text-sm prose-em:leading-[1] text-white prose-h1:text-6xl">
            <h1 class="mb-0">{!! get_the_title() !!}</h1>
            @php the_content() @endphp
          </div>
        </div>
    </div>
  </div>
</x-section>

@endsection
