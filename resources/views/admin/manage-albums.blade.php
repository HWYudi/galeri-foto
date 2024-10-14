@extends('admin.template')
@section('content')
    <!-- Container for demo purpose -->
    <div class="container py-12 mx-auto px-4 md:px-6 lg:px-12">
        <!--Section: Design Block-->
        <section class="flex flex-col gap-5 text-gray-800">
            <div class="w-full flex justify-between items-center">
                <h1 class="text-xl font-bold text-[#686868]">Manajemen Album</h1>
                <form method="GET" class="flex items-center" action="{{ route('admin.manage.albums') }}">
                    <input type="text" name="search" placeholder="Search..." value="{{ $search ?? '' }}"
                        class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:border-blue-500">
                    <button type="submit"
                        class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Search</button>
                </form>
            </div>

            <!-- Create Album Form -->
            <div class="block rounded-lg shadow-lg bg-white p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Tambah Album Baru</h2>
                <form action="{{ route('admin.store.album') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="NamaAlbum" class="block text-sm font-medium text-gray-700">Nama Album</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" id="NamaAlbum" name="NamaAlbum" required>
                    </div>
                    <div class="mb-4">
                        <label for="Deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" id="Deskripsi" name="Deskripsi"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Tambah Album</button>
                </form>
            </div>

            <!-- Album List -->
            <div class="block rounded-lg shadow-lg bg-white">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead class="border-b rounded-t-lg text-left">
                                        <tr>
                                            <th scope="col" class="rounded-tl-lg text-sm font-medium px-6 py-4">ID</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">NAMA ALBUM</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">DESKRIPSI</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">TANGGAL DIBUAT</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">USER</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">JUMLAH FOTO</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{json_encode($albums)}} --}}
                                        @foreach ($albums as $album)
                                            <tr class="border-b even:bg-gray-100 odd:bg-white">
                                                <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ $album->AlbumID }}
                                                </td>
                                                <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ $album->NamaAlbum }}
                                                </td>
                                                <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ $album->Deskripsi }}
                                                </td>
                                                <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ $album->TanggalDibuat }}
                                                </td>
                                                <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ $album->user->Username }}
                                                </td>
                                                <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ count($album->post) }}
                                                </td>
                                                <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                                    <a href="{{ route('admin.edit.album', $album->AlbumID) }}"
                                                        class="text-blue-500 hover:text-blue-700">Edit</a>
                                                    <form action="{{ route('admin.destroy.album', $album->AlbumID) }}" method="POST"
                                                        class="inline-block ml-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-700"
                                                            onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Request::has('search'))
                <a href="{{ route('admin.manage.albums') }}" class="text-blue-500 hover:text-blue-600 hover:underline">Back To List?</a>
            @endif
            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $albums->links() }}
            </div>
        </section>
    </div>
@endsection
