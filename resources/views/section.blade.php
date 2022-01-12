<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @livewireStyles
</head>
<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                         <!-- Datatables will be here -->
                         <a href="{{ route('create') }}" class="bg-blue-500 hover:bg-blue-700 text-bold font-bold py-2 px-4 rounded mt-10">Create New Company</a>

                         <livewire:sections-table />

        


                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>



  @livewireScripts
</body>
</html>

