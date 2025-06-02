function paymentMethodData() {
    return {
        paymentMetodes: [],
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
        status: '',
        showDeleteModal: false,
        paymentMethodIdToDelete: null,

        init() {
            this.fetchPaymentMethodes();
        },

        async fetchPaymentMethodes() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        paymentMethodes(search: $search, is_active: $is_active) {
                        payment_method_id
                        methode_name
                        code
                        is_active
                        }
                    }
                    `;

                const variables = {
                    page: this.pagination.current_page,
                    perPage: this.pagination.per_page,
                    search: this.search || null,
                    is_active: this.status === '' ? null : this.status === '1'
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
                console.log('Fetched data:', result.data.paymentMethodes);

                this.paymentMethodes = result.data.paymentMethodes || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.paymentMethodes = this.paymentMethodes.filter(p => p.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.paymentMethodes = this.paymentMethodes.filter(p =>
                        p.methode_name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.paymentMethodes.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.paymentMethodes.length;
            } catch (error) {
                console.error('Error fetching payment methodes:', error);
            }
        },

        async changePage(page) {
            if (page === '...' || isNaN(page)) return;
            this.pagination.current_page = parseInt(page);
            await this.fetchPaymentMethodes();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchPaymentMethodes();
            }
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchPaymentMethodes();
            }
        },

        async resetFilters() {
            this.search = '';
            this.status = '';
            this.pagination.current_page = 1;
            await this.fetchPaymentMethodes();
        },

        confirmDelete(id) {
            this.paymentMethodIdToDelete = id;
            this.showDeleteModal = true;
        },

        async deletePaymentMethod() {
            try {
                const mutation = `
                    mutation($payment_method_id: ID!) {
                        deletePaymentMethod(payment_method_id: $payment_method_id) {
                            payment_method_id
                        }
                    }
                `;

                const variables = {
                    payment_method_id: this.paymentMethodIdToDelete
                };

                const response = await fetch('/graphql', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ query: mutation, variables })
                });

                const result = await response.json();

                if (result.data?.deletePaymentMethod?.payment_method_id) {
                    this.showDeleteModal = false;
                    this.paymentMethodIdToDelete = null;
                    await this.fetchPaymentMethodes();
                } else {
                    console.error('Failed to delete payment method.');
                }
            } catch (error) {
                console.error('Error deleting payment method:', error);
            }
        }
    };
}