@extends('layout.main')

@section('content')
    <div x-data="transactionData()" x-init="init()" class="space-y-6">

        <!-- Header and Create Button -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Transaction</h1>
            <a href="/transactions/create"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Add New Transaction
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Total Transaction -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Transaction</p>
                        <p class="mt-1 text-3xl font-semibold text-gray-900" x-text="pagination.total"></p>
                    </div>
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-car text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Gate Opened -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Gate Opened</p>
                        <p class="mt-1 text-3xl font-semibold text-gray-900"
                            x-text="transactions.filter(s => s.gate_opened).length">
                        </p>
                    </div>
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-door-open text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Gate Opened (IN)-->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Gate Opened</p>
                        <p class="mt-1 text-3xl font-semibold text-gray-900"
                            x-text="transactions.filter(s => !s.gate_opened).length">
                        </p>
                    </div>
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-door-open text-xl"></i>
                    </div>
                </div>
            </div>


            <!-- Receipt Printed -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Receipt Printed</p>
                        <p class="mt-1 text-3xl font-semibold text-gray-900"
                            x-text="transactions.filter(s => s.receipt_printed).length">
                        </p>
                    </div>
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-print text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Receipt Printed (IN)-->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Receipt Printed</p>
                        <p class="mt-1 text-3xl font-semibold text-gray-900"
                            x-text="transactions.filter(s => !s.receipt_printed).length">
                        </p>
                    </div>
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-print text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- WhatsApp Sent -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">WhatsApp Sent</p>
                        <p class="mt-1 text-3xl font-semibold text-gray-900"
                            x-text="transactions.filter(s => s.whatsapp_sent).length">
                        </p>
                    </div>
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </div>
                </div>
            </div>


            <!-- WhatsApp Sent -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">WhatsApp Sent</p>
                        <p class="mt-1 text-3xl font-semibold text-gray-900"
                            x-text="transactions.filter(s => !s.whatsapp_sent).length">
                        </p>
                    </div>
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Field -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" id="search" x-model="search" @change="fetchTransactions()"
                        @input="fetchTransactions()" placeholder="Type to search..."
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Gate Status Filter -->
                <div>
                    <label for="gateStatus" class="block text-sm font-medium text-gray-700">Gate Status</label>
                    <select id="gateStatus" x-model="gateStatus"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All</option>
                        <option value="1">Opened</option>
                        <option value="0">Closed</option>
                    </select>
                </div>

                <!-- Receipt Status Filter -->
                <div>
                    <label for="receiptStatus" class="block text-sm font-medium text-gray-700">Receipt Status</label>
                    <select id="receiptStatus" x-model="receiptStatus"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All</option>
                        <option value="1">Printed</option>
                        <option value="0">Not Printed</option>
                    </select>
                </div>

                <!-- WhatsApp Status Filter -->
                <div>
                    <label for="waStatus" class="block text-sm font-medium text-gray-700">WhatsApp Status</label>
                    <select id="waStatus" x-model="waStatus"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All</option>
                        <option value="1">Sent</option>
                        <option value="0">Not Sent</option>
                    </select>
                </div>


                <div class ="flex items-end">
                    <button @click="fetchTransactions()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    <button @click="resetFilters()"
                        class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        <i class="fas fa-times mr-2"></i> Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Vehicle Types Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Outlet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subtotal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Discount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tax
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Final
                                Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gate
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Staff
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Shift
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Receipt</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                WhatsApp</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Notes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="transaction in transactions" :key="transaction.transaction_id">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                    x-text="transaction.transaction_code"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.customer_id"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.outlet_id">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.transaction_date">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.subtotal">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.discount">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="transaction.tax">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.final_price">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.role_id">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.payment_status_id">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        x-bind:class="transaction.gate_opened ? 'bg-green-100 text-green-800' :
                                            'bg-red-100 text-red-800'"
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        x-text="transaction.gate_opened ? 'Opened' : 'Closed'">
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.staff_id">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    x-text="transaction.shift_id">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        x-bind:class="transaction.receipt_printed ? 'bg-blue-100 text-blue-800' :
                                            'bg-gray-100 text-gray-800'"
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        x-text="transaction.receipt_printed ? 'Printed' : 'Not Printed'">
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        x-bind:class="transaction.whatsapp_sent ? 'bg-green-100 text-green-800' :
                                            'bg-yellow-100 text-yellow-800'"
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        x-text="transaction.whatsapp_sent ? 'Sent' : 'Not Sent'">
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="transaction.notes">
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a :href="`/transactions/${transaction.transaction_id}/edit`"
                                        class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button @click="confirmDelete(transaction.transaction_id)"
                                        class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="transactions.length === 0">
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No Transaction Found
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                x-show="pagination.last_page > 1">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button @click="previousPage()" :disabled="pagination.current_page === 1"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button @click="nextPage()" :disabled="pagination.current_page === pagination.last_page"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class= "text-sm text-gray-700">
                            Showing <span class="font-medium" x-text="pagination.from"></span> to
                            <span class="font-medium" x-text="pagination.to"></span> of
                            <span class="font-medium" x-text="pagination.total"></span>
                            Results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button @click="changePage(1)" :disabled="pagination.current_page === 1"
                                class="relative inline-flex items-center px-2 py-2 rounded-1-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-angle-left"></i>
                            </button>

                            <template x-for="page in pagination.links" :key="page.label">
                                <button @click="changePage(page.label)"
                                    :disabled="!Number.isInteger(Number(page.label)) || page.active"
                                    :class="page.active ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' :
                                        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'"
                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                    x-text="page.label">
                                </button>
                            </template>


                            <button @click="nextPage()" :disabled="pagination.current_page === pagination.last_page"
                                class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <i class="fas fa-angle-right"></i>
                            </button>
                            <button @click="changePage(pagination.last_page)"
                                :disabled="pagination.current_page === pagination.last_page"
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Last</span>
                                <i class="fas fa-angle-double-right"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this Transaction?</p>
                <div class="flex justify-end space-x-3">
                    <button @click="showDeleteModal = false"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                    <button @click="deleteTransaction()"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js\transaction\transaction-script.js') }}"></script>
    @endpush
@endsection
