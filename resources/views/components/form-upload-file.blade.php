
@props( ['folder' => 0 ] )


<form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data" class="p-4 flex">
    @csrf

    <input type="file" name="file" >
    <input type="hidden" name="folder" value="{{ $folder }}">
    <button type="submit" class="px-4 py-2 bg-green-600 text-white" >Upload</button>

</form>