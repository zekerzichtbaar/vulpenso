@extends('layouts.app')

@section('content')

<x-section class="grid place-items-center">
  <div class="container">
    <div class="text-center mx-auto max-w-3xl text-white flex flex-col gap-4 justify-center items-center">
      <lord-icon
        src="https://cdn.lordicon.com/fvoudkri.json"
        trigger="loop"
        stroke="bold"
        class="size-8 md:size-16 lg:size-24 flex-shrink-0 flex-grow-0 current-color"
      >
      </lord-icon>
      <x-content.title title="404" heading="h1" />
      <x-content.text content="Deze pagina was blijkbaar toe aan onderhoud… maar we hebben ’m niet meer kunnen vinden. Ga terug naar de homepage, daar staat alles nog netjes afgesteld." />
      <x-content.button href="{{ home_url('/') }}" title="Terug naar home">Terug naar home</x-content.button>
    </div>
  </div>
</x-section>

@endsection
