<div
  x-data="{ hidden: false }"
  x-init="
    const footer = document.querySelector('footer');
    if (footer) {
      const observer = new IntersectionObserver(([entry]) => {
        hidden = entry.isIntersecting;
      }, { threshold: 0.5 });
      observer.observe(footer);
    }
  "
  :class="hidden ? 'translate-y-24 opacity-0 pointer-events-none' : 'translate-y-0 opacity-100'"
  class="fixed bottom-4 left-1/2 -translate-x-1/2 z-50 hidden md:block transition-all duration-500">
  <div class="animate-slide-up-delayed flex items-center gap-8 bg-dark/80 backdrop-blur-lg border border-white/5 rounded-xl py-3 px-8 isolate will-change-transform">
    <div
      data-whatsapp-modal-toggle
      class="whatsapp-modal__trigger flex items-center gap-4 cursor-pointer group"
    >
      <div class="size-10 bg-primary/10 rounded-lg grid place-items-center">
        <x-lordicon
          src="wired-outline-2543-logo-whatsapp-hover-pinch"
          trigger="hover"
          target=".group"
          stroke="bold"
          class="icon-lottie size-6"
          primary="#C38E66"
          secondary="#C38E66"
        />
      </div>
      <span class="font-medium text-white text-sm md:text-base whitespace-nowrap transition-all duration-300 group-hover:text-primary">
        Whatsapp ons
      </span>
    </div>
    <div class="bg-white/10 w-px h-4"></div>
    <a href="{!! get_permalink(275) !!}" class="group flex items-center gap-4">
      <div class="size-10 bg-primary/10 rounded-lg grid place-items-center">
        <x-lordicon
          src="wired-outline-1140-error-hover-enlarge"
          trigger="hover"
          target=".group"
          stroke="bold"
          class="icon-lottie size-6"
          primary="#C38E66"
          secondary="#C38E66"
        />
      </div>
      <span class="font-medium text-white text-sm md:text-base whitespace-nowrap transition-all duration-300 group-hover:text-primary">
        Storing melden
      </span>
    </a>
  </div>
</div>
