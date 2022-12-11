<x-app-layout>

    @if( session()->has( 'message' ) )

        {{ session( 'message' ) }}

    @endif

    <form action="{{ route('store.folder') }}" method="POST">
        @csrf

        <input type="text" name="folder_name" placeholder="Folder name" required >

        <button type="submit" class="p-4 bg-green-600 text-white" >Create</button>

    </form>



</x-app-layout>