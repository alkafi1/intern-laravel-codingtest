<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <form method="GET" action="{{ route('products.searchProduct') }}" class="w-1/2"
                        style="width: 30%; margin: auto;">
                        <div class="flex items-center justify-between space-x-3">
                            <label for="search" class="text-gray-700">Search:</label>
                            <input type="text" name="search" id="search"
                                data-route="{{ route('products.searchProduct') }}" value="{{ request('search') }}"
                                class="border rounded py-2 px-3 focus:outline-none focus:ring focus:border-blue-300">
                            <x-primary-button id="filterButton">
                                {{ __('Filter') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <div id="product-wrapper">
                        @include('product.producttable')
                    </div>
                </div>
            </div>
        </div>
        <script type="module">
            $(document).ready(function() {
                // Function to fetch and display data

                // function fetchData(searchTerm, route) {
                //     $.ajax({
                //         type: "GET",
                //         url: route,
                //     });
                // }
                function filterProducts(searchTerm) {
                    $.ajax({
                        type: "Get", // Replace with your server endpoint
                        url: "/products/search/dynamic", // Replace with your server endpoint
                        data: {
                            search: searchTerm
                        },
                        success: function(response) {
                            // Update the product list with the filtered data
                            $('#products').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
                // Handle input change event
                $('#search').on('input', function() {
                    var searchTerm = $(this).val();
                    console.log(searchTerm);
                    filterProducts(searchTerm);
                });

                // Handle button click event
                $('#filterButton').on('click', function() {
                    var searchTerm = $('#search').val();
                    console.log(searchTerm);
                    filterProducts(searchTerm);
                });

                // Initial filter (you can call this with an empty string to load all products)
                // filterProducts('');
            });
        </script>
    </div>
</x-app-layout>
