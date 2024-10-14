@extends('admin.template')
@section('content')
    <div class="container py-12 mx-auto px-4 md:px-6 lg:px-12">
        <section class="flex flex-col gap-5 text-gray-800">
            <h2 class="text-2xl font-bold mb-4">Edit Post</h2>
            <div class="block rounded-lg shadow-lg bg-white p-6">
                {{-- {{ json_encode($post) }} --}}
                <form action="{{ url('/admin/foto/' . $post['FotoID']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="JudulFoto" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="JudulFoto" id="JudulFoto" value="{{ $post['JudulFoto'] }}"
                            class="mt-1 px-3 py-2 block w-full shadow-sm sm:text-sm focus:outline-gray-500 outline-none outline-gray-400 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="DeskripsiFoto" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" name="DeskripsiFoto" id="DeskripsiFoto" value="{{ $post['DeskripsiFoto'] }}"
                            class="mt-1 px-3 py-2 block w-full shadow-sm sm:text-sm focus:outline-gray-500 outline-none outline-gray-400 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="LokasiFile" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="LokasiFile" id="LokasiFile"
                            class="my-1 px-3 py-2 focus:outline-gray-500 outline-none outline-gray-400 block w-full shadow-sm sm:text-sm rounded-md">
                        <img src="{{ asset('storage/' . $post['LokasiFile']) }}" alt="{{ $post['JudulFoto'] }}"
                            class="mt-2 w-32 h-32 object-cover rounded-lg">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
