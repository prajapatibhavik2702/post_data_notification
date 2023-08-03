<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <button style="background-color: rebeccapurple">
                        <a href="/users" style="color: white">Show User Table Data</a>

                </button><br><br>

                    {{ __("You're logged in!") }} <br><br>

                {{-- <button style="background-color:blanchedalmond">
                    <a href="{{ route('message.create') }}" style="color: white">Message Create</a>
                </button> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
