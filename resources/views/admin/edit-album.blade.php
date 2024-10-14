@extends('admin.template')
@section('content')
    <!-- Container for demo purpose -->
    <div class="container py-12 mx-auto px-4 md:px-6 lg:px-12">
        <!--Section: Design Block-->
        <section class="flex flex-col gap-5 text-gray-800">
            <div class="w-full">
                <h1 class="text-xl font-bold text-[#686868]">Edit Album</h1>
            </div>

            <div class="block rounded-lg shadow-lg bg-white p-6">
                <form action="{{ route('admin.update.album', $album->AlbumID) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="NamaAlbum" class="block text-sm font-medium text-gray-700">Nama Album</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" id="NamaAlbum" name="NamaAlbum" value="{{ $album->NamaAlbum }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="Deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" id="Deskripsi" name="Deskripsi">{{ $album->Deskripsi }}</textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update Album</button>
                </form>
            </div>
        </section>
    </div>
@endsection
