<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stok Gudang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <a href="" class="text-indigo-600 hover:text-indigo-900"><x-primary-button
                                        class="mt-6" type="submit">
                                        {{ __('Create') }}
                                    </x-primary-button></a>
                                <div class="mb-4">
                                    <label for="warehouseFilter" class="block text-sm font-medium text-gray-700">Filter
                                        by
                                        Warehouse:</label>
                                    <select id="warehouseFilter" name="warehouseFilter"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Warehouse Name
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Product Name
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Stock
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        loadTableData(1);
        $('#warehouseFilter').on('change', function() {
            var selectedWarehouseId = $(this).val();
            loadTableData(selectedWarehouseId);
        });

        function loadTableData(selectedWarehouseId) {
            $.ajax({
                url: '/stok-gudang/filterByWarehouse',
                type: 'GET',
                data: {
                    warehouse_id: selectedWarehouseId
                },
                dataType: 'json',
                success: function(data) {
                    updateTable(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function updateTable(data) {
            var tableRows = '';
            $.each(data, function(index, row) {
                tableRows += '<tr>';
                tableRows += '<td class="px-6 py-4 text-sm text-gray-500">' + row
                    .warehouse.name + '</td>';
                tableRows += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' + row
                    .product.name + '</td>';
                tableRows += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' + row
                    .stock + '</td>';
                tableRows += '<a href="' + "{{ route('stok-gudang.edit', ['id' => ':id']) }}".replace(
                    ':id', row.id) + '" class="text-indigo-600 hover:text-indigo-900">Edit</a>';
                tableRows += '</td>';
                tableRows += '</tr>';
            });
            $('table tbody').html(tableRows);
        }
    });
</script>
