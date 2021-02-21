<nav class="border-b-2 border-gray-600 bg-green-200">
    <div class="flex flex-row">


        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 pt-4">

            <ul class="hidden sm:flex sm:flex-col items-stretch md:flex-row md:items-center">

                <li class="ml-0 md:ml-5 lg:ml-10 mt-2 md:mt-0">
                    {{-- <a href="{{ route('movies') }}" class="hover:text-gray-300">Movies</a> --}}
                    <a href="{{ route('welcome') }}" class="hover:text-gray-300 whitespace-no-wrap text-xl font-bold" >Welcome page</a>
    
                </li>
                <li class="ml-0 md:ml-5 lg:ml-10 mt-2 md:mt-0">
                    <a href="{{ route('employes') }}" class="hover:text-gray-300 whitespace-no-wrap text-xl font-bold" >Employes</a>
                </li>

    
            </ul>
        


        </div>
    </div>
</nav>