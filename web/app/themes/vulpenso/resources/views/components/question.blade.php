@props([
    'question' => '',
    'answer' => '',
    'bg' => '',
    'isFirst' => false,
    'openFirst' => false,
    'iteration' => null,
    'backgroundColor' => '',
])

@php
    $hasVideo = str_contains($answer, '<video') || str_contains($answer, '<iframe') || str_contains($answer, 'wp-video');
@endphp

<div
    x-data="{ open: @js($isFirst && $openFirst) }"
    @click="
        if (!open) {
            $dispatch('close-others', { id: $id('faq') })
        }
        open = !open
    "
    @close-others.window="if ($event.detail.id !== $id('faq')) open = false"
    role="button"
    tabindex="0"
    :aria-pressed="open"
    @class([
      'faq__item text-base lg:text-lg p-4 md:px-8 flex items-start justify-between cursor-pointer group gap-4 md:gap-8 relative w-full border-b',
      'bg-white/3 border-white/7 text-white last:border-none', $bg === 'bg-dark',
      'bg-white border-light text-dark' => $bg === 'bg-light',
      'bg-light border-white text-dark' => $bg === 'bg-white',
    ])
>
    <div class="flex flex-col w-full">
        <div class="flex items-center justify-between gap-4 md:gap-6">
            <span class="question font-medium block list-none">
                {!! $question !!}
                @if($hasVideo)
                  <svg class="inline-block size-8 ml-2 -mt-0.5" fill="none" viewBox="0 0 430 430"><g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="18"><path d="M167.602 215.4v-77l58.1 38.5 58.1 38.5-58.1 38.6-58.1 38.5z"/><path d="M215.5 382.5c92.508 0 167.5-74.992 167.5-167.5S308.008 47.5 215.5 47.5 48 122.492 48 215s74.992 167.5 167.5 167.5"/></g></svg>
                @endif
            </span>
            <div
              class="flex-shrink-0 overflow-hidden faq-arrow transition-all duration-300 ease-in-out transform size-12 grid place-items-center rounded-xl"
              :class="open ? 'bg-primary text-white' : '{{ $bg === 'bg-dark' ? 'bg-primary/10 text-primary' : 'bg-light text-primary' }}'"
            >
                <svg class="relative z-10 size-4 transition-transform duration-300 ease-in-out group-hover:scale-110 text-current" :class="{ 'rotate-45': open }" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 1.5V16.5M17 9H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
        <div
            x-show="open"
            x-collapse.duration.300ms
        >
            <div
                @click.stop
                @class([
                  'prose max-w-full pt-4 prose-a:text-primary prose-a:!underline',
                  'text-white', $bg === 'bg-dark',
                  'text-dark' => $bg === 'bg-light' || $bg === 'bg-white',
                ])
            >
                {!! $answer !!}
            </div>
        </div>
    </div>
</div>
