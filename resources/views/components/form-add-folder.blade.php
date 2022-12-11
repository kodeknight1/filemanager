
@props( ['parent' => 0 ] )

 <form action="{{ route('store.folder') }}" method="POST" class="p-4 flex">
    @csrf

    <input class="dark:bg-gray-800" type="text" name="folder_name" placeholder="Folder name" required autofocus >
    <input type="hidden" name="parent" value="{{ $parent }}">

    <button type="submit" class="px-4 py-2 bg-green-600 text-white" >Add</button>

</form>