<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>
    <div class="bg-white dark:bg-gray-800 shadow dark:text-white border-t border-gray-700">
        <div class="flex flex-row gap-4 max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
            <x-dropdown align="left" width="auto" contentClick="keepOpen">
                <x-slot name="trigger">
                    <span class="cursor-pointer">+ Folder</span>
                </x-slot>
                <x-slot name="content"><x-form-add-folder :parent="0"/></x-slot>
            </x-dropdown>

            <x-dropdown align="left" width="auto" contentClick="keepOpen">
                <x-slot name="trigger">
                    <span class="cursor-pointer">+ File</span>   
                </x-slot>
                <x-slot name="content"><x-form-upload-file :folder="0"/></x-slot>
            </x-dropdown>

        </div>
    </div>
    <div class="py-12 dark:text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        

        <div class="flex flex-row gap-4">
            @foreach( $folders as $folder )

                <div class="basis-32 grow-0 text-center">
                    <a href="{{ route('folder.view', $folder)}}">
                        <span class="folder-icon"></span>
                        <p>{{ $folder->name }}</p>
                    </a>
                </div>

            @endforeach

            @foreach( $files as $file )

                <div class="basis-32 grow-0 text-center">
                    <a href="">
                        <span class="file-icon"></span>
                        <p>{{ $file->original_name }}</p>
                    </a>
                </div>

            @endforeach

        </div>

           
        </div>
    </div>
</x-app-layout>