@php
    $type = $notification->data['type'] ?? 'unknown';

    $iconClass = match ($type) {
        'low_temperature' => 'bg-blue-50 text-blue-500',
        'temperature'     => 'bg-red-50 text-red-500',
        'low_humidity'    => 'bg-cyan-50 text-cyan-500',
        'humidity'        => 'bg-indigo-50 text-indigo-500',
        'tilt'            => 'bg-orange-50 text-orange-500',
        'light'           => 'bg-yellow-50 text-yellow-500',
        default           => 'bg-gray-50 text-gray-500',
    };
@endphp

<li>

    <form
        action="/notifications/{{$notification->id}}/read"
        method="POST"
    >
        @csrf
        @method('PATCH')

        <button
            type="submit"
            class="flex cursor-pointer w-full gap-2.5 px-3 py-2.5 text-left transition hover:bg-gray-50
            {{ $notification->read_at ? 'opacity-60' : '' }}"
        >

            {{-- ICON --}}
            <div
                class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full {{ $iconClass }}"
            >

                @if($type === 'low_temperature')

                    {{-- Low Temperature --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-3.5 w-3.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v18M8 6l4 3 4-3M8 18l4-3 4 3M5 12h14"
                        />
                    </svg>

                @elseif($type === 'temperature')

                    {{-- High Temperature --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-3.5 w-3.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v11"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.5 14.5a3.5 3.5 0 1 0 7 0c0-1.4-.8-2.6-2-3.2V6a1.5 1.5 0 0 0-3 0v5.3c-1.2.6-2 1.8-2 3.2Z"
                        />
                    </svg>

                @elseif($type === 'low_humidity')

                    {{-- Low Humidity --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-3.5 w-3.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4S7 10 7 14a5 5 0 0 0 10 0c0-4-5-10-5-10Z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9.5 17.5a3 3 0 0 0 2.5 1.5"
                        />
                    </svg>

                @elseif($type === 'humidity')

                    {{-- High Humidity --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-3.5 w-3.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3.5S6 10.2 6 14a6 6 0 0 0 12 0c0-3.8-6-10.5-6-10.5Z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 14.5a3.5 3.5 0 0 0 3 3"
                        />
                    </svg>

                @elseif($type === 'tilt')

                    {{-- Tilt --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-3.5 w-3.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                        />
                    </svg>

                @elseif($type === 'light')

                    {{-- Light --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-3.5 w-3.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v1m6.36 1.64-.71.71M21 12h-1m-1.64 6.36-.71-.71M12 20v1m-6.36-2.64.71-.71M3 12h1m1.64-6.36.71.71"
                        />
                        <circle
                            cx="12"
                            cy="12"
                            r="3"
                        />
                    </svg>

                @else

                    {{-- Default --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-3.5 w-3.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9a6 6 0 1 0-12 0v.75a8.967 8.967 0 0 1-2.31 6.022c1.733.64 3.56 1.082 5.454 1.31"
                        />
                    </svg>

                @endif

            </div>


            {{-- CONTENT --}}
            <div class="min-w-0 flex-1">

                {{-- TITLE + TIME --}}
                <div class="flex items-center justify-between gap-2">

                    <p class="truncate text-[11px] font-semibold text-gray-800">
                        {{ $notification->data['title'] ?? 'Notification' }}
                    </p>

                    <p class="shrink-0 text-[9px] text-gray-400">
                        {{ $notification->created_at->diffForHumans() }}
                    </p>

                </div>


                {{-- MESSAGE --}}
                <p class="mt-0.5 text-[10px] leading-4 text-gray-500">

                    {{ $notification->data['message'] ?? '' }}

                    @if(isset($notification->data['value']))

                        <span class="font-semibold text-gray-700">

                            @if(
                                $type === 'low_temperature' ||
                                $type === 'temperature'
                            )

                                ({{ $notification->data['value'] }}°C)

                            @elseif(
                                $type === 'low_humidity' ||
                                $type === 'humidity'
                            )

                                ({{ $notification->data['value'] }}%)

                            @elseif($type === 'light')

                                ({{ $notification->data['value'] }})

                            @elseif($type === 'tilt')

                                (Tilt detected)

                            @else

                                ({{ $notification->data['value'] }})

                            @endif

                        </span>

                    @endif

                </p>

            </div>

        </button>

    </form>

</li>