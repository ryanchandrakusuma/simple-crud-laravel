<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Purchase Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <a href="{{ route('purchase-request.create') }}"
                                    class="text-indigo-600 hover:text-indigo-900"><x-primary-button class="mt-6"
                                        type="submit">
                                        {{ __('Create') }}
                                    </x-primary-button></a>
                                <div class="mb-4">
                                    <label for="statusFilter" class="block text-sm font-medium text-gray-700">Filter
                                        by
                                        Status:</label>
                                    <select id="statusFilter" name="statusFilter"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="Pending">
                                            Pending
                                        </option>
                                        <option value="Approved">
                                            Approved
                                        </option>
                                        <option value="Rejected">
                                            Rejected
                                        </option>
                                    </select>
                                </div>
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Vendor Name
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tax
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Total Price
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
        loadTableData("Pending");
        $('#statusFilter').on('change', function() {
            var selectedStatus = $(this).val();
            loadTableData(selectedStatus);
        });

        function loadTableData(selectedStatus) {
            $.ajax({
                url: '/purchase-request/filterByStatus',
                type: 'GET',
                data: {
                    status: selectedStatus
                },
                dataType: 'json',
                success: function(data) {
                    updateTable(data, selectedStatus);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function updateTable(data, selectedStatus) {
            var tableRows = '';
            $.each(data, function(index, row) {
                tableRows += '<tr>';
                tableRows += '<td class="px-6 py-4 text-sm text-gray-500">' + row
                    .vendor.name + '</td>';
                tableRows += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' + row
                    .tax.name + '</td>';
                tableRows += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' + row
                    .price_total + '</td>';
                tableRows += '<td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">';
                if (selectedStatus != "Approved") {
                    tableRows += '<a href="' + "{{ route('purchase-request.edit', ['id' => ':id']) }}"
                        .replace(
                            ':id', row.id) + '" class="text-indigo-600 hover:text-indigo-900">Edit</a>';
                }
                tableRows += '<form method="POST" action="' +
                    "{{ route('purchase-request.destroy', ['id' => ':id']) }}".replace(':id', row.id) +
                    '">';
                tableRows += '@csrf @method('DELETE')';
                tableRows +=
                    '<button type="submit" class="text-red-600 hover:text-red-900">Delete</button>';
                tableRows += '</form></td>';
                tableRows += '</tr>';
            });
            $('table tbody').html(tableRows);
        }
    });
</script>
