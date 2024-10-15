@extends('admin.template')
@section('content')
    <!-- Container for demo purpose -->
    <div class="container py-12 mx-auto px-4 md:px-6 lg:px-12">
        <!--Section: Design Block-->
        <section class="flex flex-col gap-5 text-gray-800">
            <div class="w-full flex justify-between items-center">
                <h1 class="text-xl font-bold text-[#686868]">Data Foto</h1>
                <form method="GET" class="flex items-center" action="{{ url('/admin/foto/search') }}">
                    <input type="text" name="search" placeholder="Search..."
                        class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:border-blue-500">
                    <button type="submit"
                        class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Search</button>
                </form>
            </div>
            <div class="block rounded-lg shadow-lg bg-white">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead class="border-b rounded-t-lg text-left">
                                        <tr>
                                            <th class="rounded-tl-lg text-sm font-medium px-6 py-4">NO</th>
                                            <th class="text-sm font-medium px-6 py-4">USER</th>
                                            <th class="text-sm font-medium px-6 py-4">TITLE</th>
                                            <th class="text-sm font-medium px-6 py-4">DESCRIPTION</th>
                                            <th class="text-sm font-medium px-6 py-4">IMAGE</th>
                                            <th class="text-sm font-medium px-6 py-4">UPLOADED DATE</th>
                                            <th class="text-sm font-medium px-6 py-4">ACTION</th>
                                        </tr>
                                    </thead>
                                    {{-- {{json_encode($posts)}} --}}
                                    @foreach ($posts as $index => $post)
                                    <tbody>
                                        <tr class="border-b even:bg-gray-100 odd:bg-white">
                                            <td class="text-sm font-medium px-6 py-4 whitespace-nowrap text-left">
                                                {{ ($posts->currentPage() - 1) * $posts->perPage() + $index + 1 }}
                                            </td>
                                            <td class="text-sm font-medium px-6 py-4 whitespace-nowrap text-left">
                                                <div class="flex items-center gap-2">
                                                    @if ($post['user']['Image'])
                                                        <img src="{{ asset('storage/' . $post['user']['Image']) }}"
                                                            alt="{{ $post['user']['NamaLengkap'] }}"
                                                            class="w-10 h-10 object-cover rounded-full">
                                                    @endif
                                                    <h1>
                                                        {{ $post['user']['NamaLengkap'] }}
                                                    </h1>
                                                </div>
                                            </td>
                                            <td class="text-sm font-medium px-6 py-4 whitespace-nowrap text-left" scope="row">
                                                {{ $post['JudulFoto'] }}
                                            </td>
                                            <td class="text-sm font-medium px-6 py-4 whitespace-nowrap text-left">
                                                {{ $post['DeskripsiFoto'] }}
                                            </td>
                                            <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                                <img src="{{ asset('storage/' . $post['LokasiFile']) }}"
                                                    alt="{{ $post['JudulFoto'] }}"
                                                    class="w-20 h-20 object-cover rounded-lg">
                                            </td>
                                            <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                {{ \Carbon\Carbon::parse($post['TanggalUnggah'])->format('Y-m-d') }}
                                            </td>
                                            <td class="text-sm font-normal py-4 whitespace-nowrap text-left">
                                                <div class="flex items-center gap-2">
                                                    <a href="/admin/foto/{{ $post['FotoID'] }}/edit"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg px-4 py-2">
                                                        Edit
                                                    </a>
                                                    <form action="/admin/foto/{{ $post['FotoID'] }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="delete-btn bg-red-500 hover:bg-red-700 text-white rounded-lg px-4 py-2">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (request()->has('search'))
                <a href="/admin/foto" class="text-blue-500 hover:text-blue-600 hover:underline">Back To List?</a>
            @endif

            <!-- Pagination -->
            {{ $posts->links() }}
        </section>
    </div>
    <!-- Container for demo purpose -->

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Delete Post
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this post? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmDelete"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                    <button type="button" id="cancelDelete"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteModal = document.getElementById('deleteModal');
            const confirmDeleteBtn = document.getElementById('confirmDelete');
            const cancelDeleteBtn = document.getElementById('cancelDelete');
            let currentForm;

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentForm = this.closest('form');
                    deleteModal.classList.remove('hidden');
                });
            });

            confirmDeleteBtn.addEventListener('click', function() {
                if (currentForm) {
                    currentForm.submit();
                }
            });

            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
            });
        });
    </script>
@endsection
