{{-- <html class="scroll-smooth"> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    @inertiaHead
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideDown {
            from {
                transform: translateY(-10%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        #posting-popup .inline-block {
            animation: slideDown 0.3s ease-out;
        }
    </style>
</head>

<body>
    <main class="bg-black text-white">

        <!-- header page -->
        <!-- aside -->
        <aside
            class="search min-h-svh -translate-x-full bg-black duration-200 fixed z-30 left-0 w-full lg:w-1/4 border-r border-white">
            <div class="w-full px-4 relative h-16 gap-3 flex items-center justify-start lg:justify-center">
                <img src="https://i.pinimg.com/originals/ac/5f/81/ac5f8108ef3f742dc9389feaaead84c1.gif" alt=""
                    class="w-10 h-10 rounded-full object-cover">
                <h1 class="text-xl font-bold">GO GALLERY</h1>
                <div class="absolute right-4 top-0 bottom-0 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white"
                        class="bi bi-x-lg" viewBox="0 0 16 16" onclick="searchbar()">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                    </svg>
                </div>
            </div>
            <div class="px-4 mt-4">
                <form action="{{ route('posts.search') }}" method="GET">
                    <input type="text" placeholder="Search" name="q"
                        class="w-full bg-gray-800 text-white py-2 px-4 rounded-lg outline-none border-none">
                    <button type="submit"
                        class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-2 w-full">Search</button>
                </form>
            </div>
        </aside>


        <aside
            class="sidebar -translate-x-full duration-200 overflow-y-auto bg-black text-white fixed z-20 left-0 h-svh w-full lg:w-80 border-r border-white
              border-opacity-20">

            <div class="w-full px-4 relative h-16 gap-3 flex items-center justify-start lg:justify-center">
                <img src="https://i.pinimg.com/originals/ac/5f/81/ac5f8108ef3f742dc9389feaaead84c1.gif" alt=""
                    class="w-10 h-10 rounded-full object-cover">
                <h1 class="text-xl font-bold">GO GALLERY</h1>
                <div class="absolute right-4 top-0 bottom-0 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white"
                        class="bi bi-x-lg" viewBox="0 0 16 16" onclick="Openbar()">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col gap-3 p-4">
                <a href="/"
                    class="hover:bg-opacity-10 hover:bg-white @if (Route::currentRouteName() == 'home' || Route::currentRouteName() == 'detailpost') bg-white bg-opacity-10 @endif rounded-lg flex items-center gap-2 p-2">
                    <svg width="34" height="33" viewBox="0 0 30 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10.9728 28.4261V24.0816C10.9728 22.9766 11.8737 22.0787 12.9898 22.0712H17.0785C18.2 22.0712 19.1091 22.9713 19.1091 24.0816V28.4396C19.1089 29.3778 19.8653 30.1447 20.8127 30.1666H23.5385C26.2557 30.1666 28.4584 27.9859 28.4584 25.2959V12.9369C28.4439 11.8787 27.942 10.8849 27.0955 10.2384L17.7735 2.80416C16.1404 1.5097 13.8189 1.5097 12.1858 2.80416L2.90462 10.2519C2.05495 10.8958 1.55221 11.8912 1.54175 12.9504V25.2959C1.54175 27.9859 3.74449 30.1666 6.46171 30.1666H9.18744C10.1584 30.1666 10.9455 29.3874 10.9455 28.4261"
                            fill="white" />
                        <path
                            d="M10.9728 28.4261V24.0816C10.9728 22.9766 11.8737 22.0787 12.9898 22.0712H17.0785C18.2 22.0712 19.1091 22.9713 19.1091 24.0816V28.4396C19.1089 29.3778 19.8653 30.1447 20.8127 30.1666H23.5385C26.2557 30.1666 28.4584 27.9859 28.4584 25.2959V12.9369C28.4439 11.8787 27.942 10.8849 27.0955 10.2384L17.7735 2.80416C16.1404 1.5097 13.8189 1.5097 12.1858 2.80416L2.90462 10.2519C2.05495 10.8958 1.55221 11.8912 1.54175 12.9504V25.2959C1.54175 27.9859 3.74449 30.1666 6.46171 30.1666H9.18744C10.1584 30.1666 10.9455 29.3874 10.9455 28.4261"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <h1>Home</h1>
                </a>

                <button
                    class="hover:bg-opacity-10 hover:bg-white @if (Route::currentRouteName() == 'explore') bg-white bg-opacity-10 @endif rounded-lg flex items-center gap-2 p-2 "
                    onclick="searchbar()">
                    <svg width="34" height="33" viewBox="0 0 35 33" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.1168 27.2337C21.3611 27.2337 27.2337 21.3611 27.2337 14.1168C27.2337 6.87261 21.3611 1 14.1168 1C6.87261 1 1 6.87261 1 14.1168C1 21.3611 6.87261 27.2337 14.1168 27.2337Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M25.0193 23.3257L33.0193 31.3257" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <h1>Explore</h1>
                </button>
                <a href="/mylikes"
                    class="hover:bg-opacity-10 hover:bg-white @if (Route::currentRouteName() == 'likes') bg-white bg-opacity-10 @endif rounded-lg flex items-center gap-2 p-2">
                    <svg width="34" height="33" viewBox="0 0 32 29" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M24.362 9.86487L18.0673 14.9833C16.878 15.9268 15.2048 15.9268 14.0155 14.9833L7.66772 9.86487"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M22.9541 27.0757C27.2627 27.0876 30.1666 23.5476 30.1666 19.1968V9.4666C30.1666 5.11575 27.2627 1.57574 22.9541 1.57574H9.0457C4.73712 1.57574 1.83325 5.11575 1.83325 9.4666V19.1968C1.83325 23.5476 4.73712 27.0876 9.0457 27.0757H22.9541Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>


                    <h1>Likes</h1>
                </a>

                <a href="{{ auth()->check() ? '/profile/' . auth()->user()->Username : '/login' }}"
                    class="hover:bg-opacity-10 hover:bg-white @if (Route::currentRouteName() == 'profile') bg-white bg-opacity-20 @endif rounded-lg flex items-center gap-2 p-2">
                    <svg width="34" height="33" viewBox="0 0 34 35" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.9785 22.0662C11.4994 22.0662 6.82031 22.8946 6.82031 26.2123C6.82031 29.53 11.4697 30.3881 16.9785 30.3881C22.4576 30.3881 27.1353 29.5583 27.1353 26.242C27.1353 22.9256 22.4873 22.0662 16.9785 22.0662Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.9784 17.3341C20.574 17.3341 23.4883 14.4185 23.4883 10.8228C23.4883 7.22721 20.574 4.31293 16.9784 4.31293C13.3828 4.31293 10.4671 7.22721 10.4671 10.8228C10.455 14.4063 13.3504 17.322 16.9325 17.3341H16.9784Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <h1>Profile</h1>
                </a>

                <a href="/album"
                    class="hover:bg-opacity-10 hover:bg-white @if (Route::currentRouteName() == 'album') bg-white bg-opacity-10 @endif rounded-lg flex items-center gap-2 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor"
                        class="bi bi-journal-album" viewBox="0 0 16 16">
                        <path
                            d="M5.5 4a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5v-5a.5.5 0 0 0-.5-.5zm1 7a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                        <path
                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                        <path
                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                    </svg>
                    <h1>Album</h1>
                </a>

                @if (auth()->check() && Auth::user()->Level == 'Admin')
                    <a href="/admin"
                        class="hover:bg-opacity-10 hover:bg-white @if (Route::currentRouteName() == 'admin') bg-white bg-opacity-10 @endif rounded-lg flex items-center gap-2 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor"
                            class="bi bi-speedometer2" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z" />
                            <path fill-rule="evenodd"
                                d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3" />
                        </svg>
                        <h1>Admin Dashboard</h1>
                    </a>
                @endif
                {{-- <a href="#" class="hover:bg-opacity-10 hover:bg-white rounded-lg flex items-center gap-2 p-2">
                    <svg width="34" height="33" viewBox="0 0 30 29" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.0002 1.22171C22.2365 1.22171 28.1043 7.08813 28.1043 14.3259C28.1043 21.5622 22.2365 27.43 15.0002 27.43C7.76241 27.43 1.896 21.5622 1.896 14.3259C1.896 7.08954 7.76383 1.22171 15.0002 1.22171Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20.5808 14.3441H20.5936" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M14.9014 14.3441H14.9141" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.22192 14.3441H9.23467" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <h1>More</h1>
                </a> --}}
                <div class="w-full h-fit cursor-pointer bg-white rounded-full my-3">
                    @if (auth()->check())
                        <h1 class="text-center w-full text-xl text-black py-3 font-medium" onclick="togglePopup()">
                            Post</h1>
                    @else
                        <a href="/login">
                            <h1 class="text-center w-full text-xl text-black py-3 font-medium">Post</h1>
                        </a>
                    @endif
                </div>
                <div class="flex gap-2 items-center">
                    <div class="flex">
                        @if (auth()->check() && !empty(auth()->user()->Image))
                            <img src="{{ asset('storage/' . auth()->user()->Image) }}" alt=""
                                class="w-12 h-12 object-cover rounded-full">
                        @else
                            <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png"
                                alt="" class="w-12 h-12 object-cover rounded-full">
                        @endif

                    </div>
                    <div>
                        @if (auth()->check())
                            <p class="font-semibold text-base">{{ auth()->user()->NamaLengkap }}</p>
                            <p class="text-sm font-thin">@ {{ auth()->user()->Username }}</p>
                        @else
                            <a href="{{ route('login') }}"
                                class="flex items-center gap-1 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.59 13L10.29 15.29C10.1963 15.383 10.1219 15.4936 10.0711 15.6154C10.0203 15.7373 9.9942 15.868 9.9942 16C9.9942 16.132 10.0203 16.2627 10.0711 16.3846C10.1219 16.5064 10.1963 16.617 10.29 16.71C10.383 16.8037 10.4936 16.8781 10.6154 16.9289C10.7373 16.9797 10.868 17.0058 11 17.0058C11.132 17.0058 11.2627 16.9797 11.3846 16.9289C11.5064 16.8781 11.617 16.8037 11.71 16.71L15.71 12.71C15.801 12.6149 15.8724 12.5028 15.92 12.38C16.02 12.1365 16.02 11.8635 15.92 11.62C15.8724 11.4972 15.801 11.3851 15.71 11.29L11.71 7.29C11.6168 7.19676 11.5061 7.1228 11.3842 7.07234C11.2624 7.02188 11.1319 6.99591 11 6.99591C10.8681 6.99591 10.7376 7.02188 10.6158 7.07234C10.4939 7.1228 10.3832 7.19676 10.29 7.29C10.1968 7.38324 10.1228 7.49393 10.0723 7.61575C10.0219 7.73757 9.99591 7.86814 9.99591 8C9.99591 8.13186 10.0219 8.26243 10.0723 8.38425C10.1228 8.50607 10.1968 8.61676 10.29 8.71L12.59 11H3C2.73478 11 2.48043 11.1054 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 12.2652 2.10536 12.5196 2.29289 12.7071C2.48043 12.8946 2.73478 13 3 13H12.59ZM12 2C10.1311 1.99166 8.29724 2.50721 6.70647 3.48819C5.11569 4.46917 3.83165 5.87631 3 7.55C2.88065 7.7887 2.86101 8.06502 2.94541 8.3182C3.0298 8.57137 3.21131 8.78065 3.45 8.9C3.68869 9.01935 3.96502 9.03899 4.2182 8.9546C4.47137 8.8702 4.68065 8.6887 4.8 8.45C5.43219 7.17332 6.39383 6.08862 7.58555 5.30799C8.77727 4.52736 10.1558 4.07912 11.5788 4.00959C13.0017 3.94007 14.4174 4.25178 15.6795 4.91251C16.9417 5.57324 18.0045 6.55903 18.7581 7.768C19.5118 8.97696 19.9289 10.3652 19.9664 11.7894C20.0039 13.2135 19.6605 14.6218 18.9715 15.8688C18.2826 17.1158 17.2731 18.1562 16.0475 18.8824C14.8219 19.6087 13.4246 19.9945 12 20C10.5089 20.0065 9.04615 19.5924 7.77969 18.8052C6.51323 18.0181 5.49435 16.8899 4.84 15.55C4.72065 15.3113 4.51137 15.1298 4.2582 15.0454C4.00502 14.961 3.72869 14.9807 3.49 15.1C3.25131 15.2193 3.0698 15.4286 2.98541 15.6818C2.90101 15.935 2.92065 16.2113 3.04 16.45C3.83283 18.0455 5.03752 19.4002 6.52947 20.374C8.02142 21.3479 9.74645 21.9054 11.5261 21.989C13.3058 22.0726 15.0755 21.6792 16.6521 20.8495C18.2288 20.0198 19.5552 18.784 20.4941 17.2698C21.433 15.7557 21.9503 14.0181 21.9925 12.237C22.0347 10.4559 21.6003 8.69579 20.7342 7.13883C19.8682 5.58187 18.6018 4.28457 17.0663 3.38111C15.5307 2.47765 13.7816 2.00084 12 2V2Z"
                                        fill="white" />
                                </svg>
                                Login
                            </a>
                        @endif

                    </div>
                </div>

                @if (auth()->check())
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4 12C4 12.2652 4.10536 12.5196 4.29289 12.7071C4.48043 12.8946 4.73478 13 5 13H12.59L10.29 15.29C10.1963 15.383 10.1219 15.4936 10.0711 15.6154C10.0203 15.7373 9.9942 15.868 9.9942 16C9.9942 16.132 10.0203 16.2627 10.0711 16.3846C10.1219 16.5064 10.1963 16.617 10.29 16.71C10.383 16.8037 10.4936 16.8781 10.6154 16.9289C10.7373 16.9797 10.868 17.0058 11 17.0058C11.132 17.0058 11.2627 16.9797 11.3846 16.9289C11.5064 16.8781 11.617 16.8037 11.71 16.71L15.71 12.71C15.801 12.6149 15.8724 12.5028 15.92 12.38C16.02 12.1365 16.02 11.8635 15.92 11.62C15.8724 11.4972 15.801 11.3851 15.71 11.29L11.71 7.29C11.6168 7.19676 11.5061 7.1228 11.3842 7.07234C11.2624 7.02188 11.1319 6.99591 11 6.99591C10.8681 6.99591 10.7376 7.02188 10.6158 7.07234C10.4939 7.1228 10.3832 7.19676 10.29 7.29C10.1968 7.38324 10.1228 7.49393 10.0723 7.61575C10.0219 7.73757 9.99591 7.86814 9.99591 8C9.99591 8.13186 10.0219 8.26243 10.0723 8.38425C10.1228 8.50607 10.1968 8.61676 10.29 8.71L12.59 11H5C4.73478 11 4.48043 11.1054 4.29289 11.2929C4.10536 11.4804 4 11.7348 4 12V12ZM17 2H7C6.20435 2 5.44129 2.31607 4.87868 2.87868C4.31607 3.44129 4 4.20435 4 5V8C4 8.26522 4.10536 8.51957 4.29289 8.70711C4.48043 8.89464 4.73478 9 5 9C5.26522 9 5.51957 8.89464 5.70711 8.70711C5.89464 8.51957 6 8.26522 6 8V5C6 4.73478 6.10536 4.48043 6.29289 4.29289C6.48043 4.10536 6.73478 4 7 4H17C17.2652 4 17.5196 4.10536 17.7071 4.29289C17.8946 4.48043 18 4.73478 18 5V19C18 19.2652 17.8946 19.5196 17.7071 19.7071C17.5196 19.8946 17.2652 20 17 20H7C6.73478 20 6.48043 19.8946 6.29289 19.7071C6.10536 19.5196 6 19.2652 6 19V16C6 15.7348 5.89464 15.4804 5.70711 15.2929C5.51957 15.1054 5.26522 15 5 15C4.73478 15 4.48043 15.1054 4.29289 15.2929C4.10536 15.4804 4 15.7348 4 16V19C4 19.7956 4.31607 20.5587 4.87868 21.1213C5.44129 21.6839 6.20435 22 7 22H17C17.7956 22 18.5587 21.6839 19.1213 21.1213C19.6839 20.5587 20 19.7956 20 19V5C20 4.20435 19.6839 3.44129 19.1213 2.87868C18.5587 2.31607 17.7956 2 17 2Z"
                                    fill="white" />
                            </svg>
                            Logout
                        </button>
                    </form>
                @endif

            </div>
        </aside>



        <!-- main content page -->
        <div class="fixed top-4 left-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="white" class="bi bi-list"
                viewBox="0 0 16 16" onclick="Openbar()">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
        </div>
        <div id="posting-popup" class="popup fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-black rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">
                            Create a New Post
                        </h3>
                    </div>
                    <form method="POST" id="postform" action="{{ route('posts.store') }}" class="bg-black"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center space-x-4 mb-4">
                                @if (auth()->check() && !empty(auth()->user()->Image))
                                    <img src="{{ asset('storage/' . auth()->user()->Image) }}" alt=""
                                        class="w-12 h-12 object-cover rounded-full ring-2 ring-blue-500">
                                @else
                                    <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png"
                                        alt=""
                                        class="w-12 h-12 object-cover rounded-full ring-2 ring-blue-500">
                                @endif
                                <div class="flex-grow">
                                    <input type="text" id="JudulFoto" name="JudulFoto" placeholder="Judul Foto"
                                        class="w-full px-3 py-2 text-white bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-blue-500"
                                        required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <input type="text" name="DeskripsiFoto" id="DeskripsiFoto"
                                    placeholder="Deskripsi Foto"
                                    class="w-full px-3 py-2 text-white bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-blue-500"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="image"
                                    class="flex items-center justify-center w-full h-32 px-4 transition bg-gray-800 border-2 border-gray-700 border-dashed rounded-md appearance-none cursor-pointer hover:border-blue-400 focus:outline-none">
                                    <span class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <span class="font-medium text-gray-400">
                                            <span class="text-blue-400 underline">browse File</span>
                                        </span>
                                    </span>
                                    <input id="image" name="LokasiFile" type="file" accept="image/*"
                                        class="hidden" onchange="previewImage(event)">
                                </label>
                            </div>
                            <div id="preview-container" class="mt-4 hidden">
                                <img id="image-preview" class="w-full h-64 object-cover rounded-lg" />
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-900 text-right sm:px-6">
                            <button type="button" onclick="togglePopup()"
                                class="inline-flex justify-center py-2 px-4 border border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-3">
                                Cancel
                            </button>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Post
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="flex bg-black text-white justify-end">
            <div id="div" class="w-full min-h-screen">
                <div class="h-16 lg:hidden sticky top-0 z-10 border-b bg-black flex items-center justify-between px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                        class="bi bi-list lg:hidden" viewBox="0 0 16 16" onclick="Openbar()">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg>
                    <div>
                        <a href="/inertia" class="w-full flex gap-2 items-center">
                            <img src="https://i.pinimg.com/originals/ac/5f/81/ac5f8108ef3f742dc9389feaaead84c1.gif"
                                alt="" class="w-10 h-10 rounded-full object-cover">
                            <h1 class="text-xl font-bold">GO GALLERY</h1>
                        </a>
                    </div>
                    @if (auth()->check())
                        {{-- {{auth()->user()->Username}} --}}
                        <a href="/profile/{{ auth()->user()->Username }}">
                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                                class="w-10 h-10 object-cover rounded-full">
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png"
                                alt="" class="w-10 h-10 object-cover rounded-full">
                        </a>
                    @endif
                </div>
                @inertia
            </div>
        </div>

        {{-- @if (Route::currentRouteName() == 'home')
            <aside
                class="searchbar hidden z-30 bg-black lg:block fixed right-0 min-h-svh w-full lg:w-1/4 border-l border-white border-opacity-20  overflow-y-auto">
                <div class="h-16 w-full flex-1 border-b border-white border-opacity-25 px-4 py-2 items-center">
                    <form action="{{ route('posts.search') }}" method="GET">
                        <div class="flex items-center">
                            <div class="flex items-center border w-full border-gray-300 py-1 rounded-lg">
                                <button type="submit" class="w-20 flex items-center justify-center">
                                    <svg width="35" height="33" viewBox="0 0 35 33" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.1168 27.2337C21.3611 27.2337 27.2337 21.3611 27.2337 14.1168C27.2337 6.87261 21.3611 1 14.1168 1C6.87261 1 1 6.87261 1 14.1168C1 21.3611 6.87261 27.2337 14.1168 27.2337Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M25.0194 23.3258L33.0194 31.3258" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <input type="text" name="q"
                                    class="bg-black text-white py-2 pr-3 w-full rounded-lg focus:outline-none"
                                    placeholder="Search posts...">
                            </div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="lg:hidden"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 6L6 18" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                    </form>
                </div>

                <div class="bg-white bg-opacity-10 rounded-lg p-4">
                    <h1 class="font-bold text-xl">Trend For You</h1>
                    <div class="flex text-sm font-thin gap-4">
                        <p>Entertainment</p>
                        <p>Trending</p>
                    </div>
                    <div>
                        <h1>Bitcoin</h1>
                        <p>1 post</p>
                    </div>
                </div>
            </aside>
        @endif --}}
    </main>

</body>
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('preview-container');

        // Jika ada file yang diunggah
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Set gambar ke preview
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden'); // Tampilkan preview gambar
            };

            reader.readAsDataURL(input.files[0]); // Baca file sebagai URL Data
        } else {
            preview.src = '';
            preview.classList.add('hidden'); // Sembunyikan preview jika tidak ada file
        }
    }

    function Openbar() {
        document.querySelector('.sidebar').classList.toggle('-translate-x-full');
        document.getElementById('div').classList.toggle('ml-80')
        const elements = document.querySelectorAll('#gridcard');

        // Loop melalui setiap elemen dan hapus kelas 'xl:grid-cols-4'
        elements.forEach((element) => {
            element.classList.toggle('xl:grid-cols-4');
        });
    }

    function searchbar() {
        document.querySelector('.search').classList.toggle('-translate-x-full');
    }

    function togglePopup() {
        document.querySelector('.popup').classList.toggle('hidden');
        document.getElementById('title').focus();
    }

    function togglePopupEdit() {
        document.querySelector('.popupEdit').classList.toggle('hidden');
    }

    function togglePopupDelete() {
        document.querySelector('.popupDelete').classList.toggle('hidden');
    }

    function dropdownpost(id) {
        document.getElementById('dropdown-post-' + id).classList.toggle('hidden')
    }

    function dropdown(id) {
        document.getElementById('dropdown-' + id).classList.toggle('hidden')
    }

    function dropdowncomment(id) {
        document.getElementById('dropdown-comment-' + id).classList.toggle('hidden')
    }

    function formfocus() {
        document.getElementById('comment-input').focus();
    }

    function toggleReply(id) {
        const reply = document.getElementById('replyComment-' + id);
        reply.classList.toggle('hidden');
        document.getElementById('comment-' + id).focus();
    }

    function toggleSeeReply(id) {
        const reply = document.getElementById('seeReplyComment-' + id);
        reply.classList.toggle('hidden');
    }
</script>

</html>
