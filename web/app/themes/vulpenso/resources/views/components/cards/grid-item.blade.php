@props([
    'item',
    'background_color' => 'bg-white',
])

@php
  $colSpan = match($item['width']) {
    '1/3' => 'col-span-6 md:col-span-3 lg:col-span-2',
    '1/2' => 'col-span-6 md:col-span-3',
    '2/3' => 'col-span-6 md:col-span-6 lg:col-span-4',
    default => 'col-span-6 md:col-span-3 lg:col-span-2',
  };
  $hasImage = !empty($item['image']);
  $iconSrc = $item['icon_url'] ?? null;
  $isLarge = in_array($item['width'], ['1/2', '2/3']);
@endphp

<a
  href="{{ $item['link'] }}"
  @if(isset($item['link_target']) && $item['link_target']) target="{{ $item['link_target'] }}" @endif
  @class([
    $colSpan,
    'group rounded-xl md:rounded-3xl flex flex-col border overflow-hidden relative',
    'md:min-h-[14rem] lg:min-h-[24rem]' => $isLarge,
    'bg-dark/3 border-dark/7 text-dark' => $background_color === 'bg-white',
    'bg-white/3 border-white/7 text-white' => $background_color !== 'bg-white',
  ])
>
  @if($hasImage)
    {{-- Afbeelding als strip bovenaan (mobiel altijd, desktop alleen bij kleine items) --}}
    <div @class([
      'relative w-full flex-shrink-0 h-48 md:h-64 overflow-hidden',
      'md:hidden' => $isLarge,
    ])>
      <div class="absolute left-8 top-8 z-20 flex items-center">
        @if($iconSrc)
          <div class="size-12 bg-dark/50 backdrop-blur-sm rounded-lg grid place-items-center relative overflow-clip">
            <x-lordicon
              :src="$iconSrc"
              trigger="hover"
              target=".group"
              stroke=""
              data-icon-mobile-loop
              class="icon-lottie size-6 flex-shrink-0 flex-grow-0"
              colors="primary:#FFFFFF,secondary:#FFFFFF">
            </x-lordicon>
          </div>
        @endif
        <div class="bg-dark/50 backdrop-blur-sm rounded-lg px-4 py-2 h-12 flex items-center">
          <p class="font-semibold text-base text-white">
            {!! $item['title'] !!}
          </p>
        </div>
      </div>
      <div class="absolute inset-0 w-full h-full overflow-clip transition-transform duration-300 group-hover:scale-105">
        @if(is_array($item['image']))
          {!! wp_get_attachment_image($item['image']['ID'], 'large', false, ['class' => 'absolute inset-0 w-full h-full object-cover']) !!}
        @else
          {!! wp_get_attachment_image($item['image'], 'large', false, ['class' => 'absolute inset-0 w-full h-full object-cover']) !!}
        @endif
      </div>
      <div class="bg-black/50 absolute inset-0 z-10"></div>
    </div>

    @if($isLarge)
      {{-- Grote items desktop: afbeelding volledige hoogte als achtergrond --}}
      <div class="absolute inset-0 w-full h-full overflow-hidden hidden md:block">
        <div class="absolute inset-0 w-full h-full overflow-clip transition-transform duration-300 group-hover:scale-105">
          @if(is_array($item['image']))
            {!! wp_get_attachment_image($item['image']['ID'], 'large', false, ['class' => 'absolute inset-0 w-full h-full object-cover']) !!}
          @else
            {!! wp_get_attachment_image($item['image'], 'large', false, ['class' => 'absolute inset-0 w-full h-full object-cover']) !!}
          @endif
        </div>
        <div class="bg-black/40 absolute inset-0 z-10"></div>
        <div class="bg-gradient-to-t from-black/80 to-transparent absolute inset-0"></div>
        <div class="absolute left-8 top-8 z-10 flex items-center">
          @if($iconSrc)
            <div class="size-12 bg-dark/50 backdrop-blur-sm rounded-lg grid place-items-center relative overflow-clip">
              <x-lordicon
                :src="$iconSrc"
                trigger="hover"
                target=".group"
                stroke=""
                class="icon-lottie size-6 flex-shrink-0 flex-grow-0"
                colors="primary:#FFFFFF,secondary:#FFFFFF">
              </x-lordicon>
            </div>
          @endif
          <div class="bg-dark/50 backdrop-blur-sm rounded-lg px-4 py-2 h-12 flex items-center">
            <p class="font-semibold text-base text-white">
              {!! $item['title'] !!}
            </p>
          </div>
        </div>
      </div>
    @endif
  @endif

  {{-- Content --}}
  <div class="relative z-20 p-8 md:p-10 gap-4 lg:gap-8 flex flex-col h-full">
    @if($isLarge)
      {{-- Mobiel: gestapeld zoals kleine items --}}
      @if($item['short_description'])
        <h3 class="font-medium text-xl pr-8 line-clamp-3 transition-colors duration-300 text-white md:hidden">
          {!! $item['short_description'] !!}
        </h3>
      @endif
      <div class="mt-auto flex items-end md:hidden">
        <x-arrow-button type="outline-to-white" class="flex-shrink-0" />
      </div>
      {{-- Desktop: naast elkaar --}}
      <div class="mt-auto hidden md:flex items-end justify-between gap-4">
        @if($item['short_description'])
          <h3 class="font-normal text-xl md:text-2xl lg:text-3xl max-w-sm line-clamp-3 transition-colors duration-300 text-white">
            {!! $item['short_description'] !!}
          </h3>
        @endif
        <x-arrow-button type="outline-to-white" class="flex-shrink-0" />
      </div>
    @else
      {{-- Kleine items: altijd gestapeld --}}
      @if($item['short_description'])
        <h3 class="font-medium text-xl lg:text-2xl pr-8 line-clamp-3 transition-colors duration-300 text-white">
          {!! $item['short_description'] !!}
        </h3>
      @endif
      <div class="mt-auto flex items-end">
        <x-arrow-button type="outline-to-white" class="flex-shrink-0" />
      </div>
    @endif
  </div>
</a>
