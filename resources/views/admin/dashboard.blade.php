@extends('admin.template')
@section('content')
    <!-- Container for demo purpose -->
    <div class="container py-12 mx-auto px-4 md:px-6 lg:px-12">
        <!--Section: Design Block-->
        <section class="flex flex-col gap-5 text-gray-800">
            <div class="w-full flex justify-between items-center">
                <h1 class="text-xl font-bold text-[#686868]">Data User</h1>
                <form method="GET" class="flex items-center" action="{{ url('/dashboard/search') }}">
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
                                            <th scope="col" class="rounded-tl-lg text-sm font-medium px-6 py-4">NAMA LENGKAP</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">USERNAME</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">EMAIL</th>
                                            <th scope="col" class="text-sm font-medium px-6 py-4">LEVEL</th>
                                        </tr>
                                    </thead>
                                    @foreach ($users as $user)
                                        <tbody>
                                            <tr class="border-b even:bg-gray-100 odd:bg-white">
                                                <th class="text-sm flex items-center gap-2 font-medium px-6 py-4 whitespace-nowrap text-left"
                                                    scope="row">
                                                    @if (!empty($user['Image']))
                                                        <img src="{{ asset('storage/' . $user['Image']) }}"
                                                            alt="" class="w-12 h-12 object-cover rounded-full">
                                                    @else
                                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png"
                                                            alt="" class="w-12 h-12 object-cover rounded-full">
                                                    @endif
                                                    <p class="font-bold">
                                                        {{ $user['NamaLengkap'] }}
                                                    </p>
                                                </th>
                                                <td
                                                    class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ $user['Username'] }}</td>
                                                <td
                                                    class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left text-gray-500">
                                                    {{ $user['Email'] }} </td>
                                                <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                                    <h1 class="font-bold capitalize">
                                                        {{ $user['Level'] }}
                                                    </h1>
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
            @if (Request::has('search'))
                <a href="{{ url('/admin') }}" class="text-blue-500 hover:text-blue-600 hover:underline">Back To List?</a>
            @endif
            <!-- Pagination Links -->
            {{ $users->links() }}
        </section>
    </div>
    <!-- Container for demo purpose -->
@endsection
