<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Purchase Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('purchase-request.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="vendor_id" class="block text-sm font-medium text-gray-700">Vendor
                                Name</label>
                            <select id="vendor_id" name="vendor_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($vendors as $v)
                                    <option value={{ $v->id }}>{{ $v->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="tax_id" class="block text-sm font-medium text-gray-700">Tax</label>
                            <select id="tax_id" name="tax_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($taxes as $t)
                                    <option value={{ $t->id }}>{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="product_id" class="block text-sm font-medium text-gray-700">Products</label>
                            <select id="product_id" name="product_id" multiple
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-secondary-button id="addProductsButton">Add Selected
                            Products</x-secondary-button>

                        <div id="selectedProductsContainer"></div>


                        <x-secondary-button class="mt-6" type="submit">
                            {{ __('Create') }}
                        </x-secondary-button>

                    </form>


                </div>


            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addProductsButton').on('click', function() {
            var selectedProducts = $('#product_id option:selected');
            var container = $('#selectedProductsContainer');

            selectedProducts.each(function() {
                var $selectedOption = $(this);
                var productId = $selectedOption.val();
                var productName = $selectedOption.text();

                var product = {
                    id: productId,
                    name: productName
                };

                var productDiv = $('<div class="product">' + product.id + ' - ' + product.name +
                    '</div>');
                var inputHiddenProduct = $('<input type="hidden" value=' + product.id +
                    ' id="products[]" name="products[]"/>');
                var inputPricePcs = $(
                    '<input type="number" class="input1" placeholder="Price pcs" id="pricePcs[]" name="pricePcs[]" required/>'
                );
                var inputPriceTotal = $(
                    '<input type="text" class="input1" placeholder="Total Price" id="priceTotal[]" name="priceTotal[]" required/>'
                );
                var inputAmount = $(
                    '<input type="text" class="input1" placeholder="Amount" id="amount[]" name="amount[]" required/>'
                );
                var cancelButton = $('<button class="cancelButton">Cancel</button>');

                cancelButton.on('click', function() {
                    $('#product_id').append($selectedOption);
                    productDiv.remove();
                });

                productDiv.append(inputHiddenProduct);
                productDiv.append(inputAmount);
                productDiv.append(inputPricePcs);
                productDiv.append(inputPriceTotal);
                productDiv.append(cancelButton);
                container.append(productDiv);

                $selectedOption.remove();
            });
        });
    });
</script>
