@props([
    'title',
    'id'
 ])

 @php
    $statusKey = strtolower(str_replace(' ', '_', $title));

    // Plain CSS (below) instead of dynamic Tailwind class strings — this is
    // what fixes the "no colors at all" issue for good. Tailwind's JIT
    // scanner only compiles classes it can find as literal text in your
    // source; anything built at runtime (e.g. "bg-{$color}-50") is invisible
    // to it and gets dropped from the CSS build no matter how the config is
    // set up. A scoped <style> block sidesteps that entirely.
    $colors = match ($statusKey) {
        'in_transit', 'delivered' => ['bg' => '#DCFCE7', 'bgDark' => '#0B3B24', 'fg' => '#15803D', 'fgDark' => '#4ADE80'],
        'approved' => ['bg' => '#DBEAFE', 'bgDark' => '#0C3766', 'fg' => '#1D4ED8', 'fgDark' => '#60A5FA'],
        'alert', 'alerts' => ['bg' => '#FEE2E2', 'bgDark' => '#5C1414', 'fg' => '#B91C1C', 'fgDark' => '#F87171'],
        'rejected', 'rejected' => ['bg' => '#FEE2E2', 'bgDark' => '#5C1414', 'fg' => '#B91C1C', 'fgDark' => '#F87171'],
        'pending' => ['bg' => '#FEF9C3', 'bgDark' => '#4D3B05', 'fg' => '#A16207', 'fgDark' => '#FACC15'],
        default => ['bg' => '#F3F4F6', 'bgDark' => '#1F2937', 'fg' => '#374151', 'fgDark' => '#F9FAFB'],
    };

    $iconWrapId = 'card-icon-' . $id;
 @endphp

<style>
    #{{ $iconWrapId }} {
        background-color: {{ $colors['bg'] }};
        color: {{ $colors['fg'] }};
    }
    .dark #{{ $iconWrapId }} {
        background-color: {{ $colors['bgDark'] }};
        color: {{ $colors['fgDark'] }};
    }
</style>

 <div class="rounded-lg border border-gray-200 bg-white p-3 dark:border-gray-800 dark:bg-white/[0.03]">
    <div id="{{ $iconWrapId }}" class="flex h-9 w-9 items-center justify-center rounded-md">
        @if ($title == 'Customers')
            {{-- two people --}}
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
        @elseif ($statusKey == 'in_transit')
            {{-- truck --}}
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 3h13v13H1z" />
                <path d="M14 8h4l4 4v4h-8V8z" />
                <circle cx="6" cy="18.5" r="2" />
                <circle cx="18" cy="18.5" r="2" />
            </svg>
        @elseif ($statusKey == 'delivered')
            {{-- package with check --}}
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 8v10a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 18V8" />
                <path d="M3.27 6.96 12 12l8.73-5.04" />
                <path d="M12 22V12" />
                <path d="M7 3.5 17 9" />
                <path d="M9.5 15.5 11 17l3.5-3.5" />
            </svg>
        @elseif ($statusKey == 'approved')
            {{-- check circle --}}
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9" />
                <path d="m8.5 12.5 2.5 2.5 5-5" />
            </svg>
        @elseif ($statusKey == 'alert' || $statusKey == 'alerts')
            {{-- triangle exclamation --}}
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3 2 20h20L12 3Z" />
                <path d="M12 10v4" />
                <circle cx="12" cy="17" r="0.75" fill="currentColor" stroke="none" />
            </svg>
        @elseif ($statusKey == 'pending')
            {{-- clock --}}
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9" />
                <path d="M12 7v5l3.5 2" />
            </svg>
        @elseif ($statusKey == 'rejected')
            {{-- clock --}}
            X
        @else
            {{-- default: shipment box --}}
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 8v10a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 18V8" />
                <path d="M3.27 6.96 12 12l8.73-5.04" />
                <path d="M12 22V12" />
                <path d="M7 3.5 17 9" />
            </svg>
        @endif
    </div>

    <div class="mt-2">
        <span class="text-[11px] font-medium text-gray-500 dark:text-gray-400">
            {{ $title }}
        </span>

        <h4 id="{{ $id }}" class="mt-0.5 text-lg font-semibold text-gray-800 dark:text-white/90">
            0
        </h4>
    </div>
</div>