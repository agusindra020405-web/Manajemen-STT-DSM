@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        {{-- Tampilan Mobile (Sederhana) --}}
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-emerald-100/40 bg-emerald-950/20 border border-emerald-800/20 cursor-default rounded-xl">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-emerald-100/70 bg-transparent border border-emerald-800/30 rounded-xl hover:text-white hover:bg-emerald-800/50 transition duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2.5 ml-3 text-sm font-medium text-emerald-100/70 bg-transparent border border-emerald-800/30 rounded-xl hover:text-white hover:bg-emerald-800/50 transition duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2.5 ml-3 text-sm font-medium text-emerald-100/40 bg-emerald-950/20 border border-emerald-800/20 cursor-default rounded-xl">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- Tampilan Desktop (Lengkap dengan Angka) --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">

            <div>
                <span class="relative z-0 inline-flex gap-1.5">
                    {{-- Tombol Halaman Sebelumnya (Panah Kiri) --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="relative inline-flex items-center px-3 py-2.5 text-emerald-100/30 bg-emerald-950/10 border border-emerald-800/10 cursor-default rounded-xl"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="relative inline-flex items-center px-3 py-2.5 text-emerald-500 bg-transparent border border-emerald-800/30 rounded-xl hover:text-white hover:bg-emerald-800/50 transition-all duration-150"
                            aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    @endif

                    {{-- Elemen Angka Pagination --}}
                    @foreach ($elements as $element)
                        {{-- Pemisah Tiga Titik "..." --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-emerald-100/50 cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Link Angka --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    {{-- Tombol Aktif --}}
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-3 py-1.5 text-xs font-bold text-white bg-emerald-800 rounded-lg cursor-default shadow-sm">{{ $page }}</span>
                                    </span>
                                @else
                                    {{-- Tombol Tidak Aktif --}}
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center px-3 py-1.5 text-xs font-medium text-emerald-800/80 bg-transparent border border-emerald-800/20 rounded-lg hover:text-white hover:bg-emerald-800/80 transition-all duration-150"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Tombol Halaman Selanjutnya (Panah Kanan) --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="relative inline-flex items-center px-3 py-2.5 text-emerald-500 bg-transparent border border-emerald-800/30 rounded-xl hover:text-white hover:bg-emerald-800/50 transition-all duration-150"
                            aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="relative inline-flex items-center px-3 py-2.5 text-emerald-100/30 bg-emerald-950/10 border border-emerald-800/10 cursor-default rounded-xl"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
<input type="button" value="">