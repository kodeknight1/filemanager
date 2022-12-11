<x-app-layout>


    <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file" >

        <button type="submit" class="p-4 bg-green-600 text-white" >Upload</button>

    </form>

    @if( session()->has( 'message' ) )

        {{ session( 'message' ) }}

    @endif

</x-app-layout>