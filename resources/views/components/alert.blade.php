@props(['status'])

@if ($status)
    <div class="mt-5">

        <div {{ $attributes->merge(['class' => 'max-w-7xl mx-auto sm:px-6 lg:p-8 font-medium text-xl text-green-600 dark:text-green-400 border border-2 bg-green-500 rounded-lg']) }}
            role="">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">{{ $status['message'] }}</span>
            <div>
                <span class="font-medium">Success alert!</span> {{ $status['message'] }}
            </div>
        </div>
    </div>
@endif
