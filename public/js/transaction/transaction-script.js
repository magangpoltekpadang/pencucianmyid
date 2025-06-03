function transactionData() {
    return {
        transactions: [],
        pagination: {
            current_page: 1,
            last_page: 1,
            per_page: 10,
            total: 0,
            from: 0,
            to: 0,
            links: [],
        },
        search: '',
        gateStatus: '',
        printStatus: '',
        waStatus: '',
        showDeleteModal: false,
        transactionIdToDelete: null,

        init() {
            this.fetchTransactions();
        },

        async fetchTransactions() {
            try {
                const query = `
                    query($search: String, $gate_opened: Boolean, $receipt_printed: Boolean, $whatsapp_sent: Boolean) {
                        transactions(search: $search, gate_opened: $gate_opened, receipt_printed: $receipt_printed, whatsapp_sent: $whatsapp_sent) {
                        transaction_id
                        transaction_code
                        customer_id
                        outlet_id
                        transaction_date
                        subtotal
                        discount
                        tax
                        final_price
                        payment_status_id
                        gate_opened
                        staff_id
                        shift_id
                        receipt_printed
                        whatsapp_sent
                        notes
                        }
                    }
                    `;

                const variables = {
                    page: this.pagination.current_page,
                    perPage: this.pagination.per_page,
                    search: this.search || null,
                    gate_opened: this.gateStatus === '' ? null : this.gateStatus === '1',
                    receipt_printed: this.printStatus === '' ? null : this.printStatus === '1',
                    whatsapp_sent: this.waStatus === '' ? null : this.waStatus === '1'
                };

                const response = await fetch('/graphql', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ query, variables })
                });

                const result = await response.json();
                if (result.errors) {
                    console.error('GraphQL errors:', result.errors);
                    return;
                }
                console.log('Fetched data:', result.data.transactions);

                this.transactions = result.data.transactions || [];

                if (this.gateStatus !== '') {
                    const gateBool = this.gateStatus === '1';
                    this.transactions = this.transactions(s => s.gate_opened === gateBool);
                }

                if (this.printStatus !== '') {
                    const printBool = this.printStatus === '1';
                    this.transactions = this.transactions(s => s.receipt_printed === printBool);
                }

                if (this.waStatus !== '') {
                    const waBool = this.waStatus === '1';
                    this.transactions = this.transactions(s => s.whatsapp_sent === waBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.transactions = this.transactions.filter(s =>
                        s.transaction_code.toLowerCase().includes(lowerSearch)
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.transactions.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.transactions.length;
            } catch (error) {
                console.error('Error fetching transactions:', error);
            }
        },

        async changePage(page) {
            if (page === '...' || isNaN(page)) return;
            this.pagination.current_page = parseInt(page);
            await this.fetchTransactions();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchTransactions();
            }
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchTransactions();
            }
        },

        async resetFilters() {
            this.search = '';
            this.gateStatus = '';
            this.printStatus = '';
            this.waStatus = '';
            this.pagination.current_page = 1;
            await this.fetchTransactions();
        },

        confirmDelete(id) {
            this.transactionIdToDelete = id;
            this.showDeleteModal = true;
        },

        async deleteTransaction() {
            try {
                const mutation = `
            mutation($transaction_id: ID!) {
                deleteTransaction(transaction_id: $transaction_id) {
                    transaction_id
                }
            }
        `;

                const variables = {
                    transaction_id: this.transactionIdToDelete
                };

                const response = await fetch('/graphql', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ query: mutation, variables })
                });

                const result = await response.json();
                console.log("Delete response:", result); // Tambahkan ini

                if (result.errors) {
                    console.error("GraphQL Errors:", result.errors);
                }

                if (result.data?.deleteTransaction?.transaction_id) {
                    this.showDeleteModal = false;
                    this.transactionIdToDelete = null;
                    await this.fetchTransactions();
                } else {
                    console.error('Failed to delete transaction.');
                }
            } catch (error) {
                console.error('Error deleting transaction:', error);
            }
        }

    };
}