<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-red-400 dark:text-red-400 rounded">
                    {{-- {{ __("You're logged in!") }} --}}
                    <h2>Start Chating with</h2>
                    @foreach ($users as $user)
                        <p><a href="{{ route('chatApp',$user->id) }}">{{ $user->name }}</a></p>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
