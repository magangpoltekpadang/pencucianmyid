function outletData() {
    return {
        outlets: [],
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
        outletIdToDelete: null,

        init() {
            this.fetchOutlets();
        },

        async fetchOutlets() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        outlets(search: $search, is_active: $is_active) {
                        outlet_id 
                        outlet_name 
                        address 
                        phone_number 
                        latitude
                        longitude
                        is_active
                        }}
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
                console.log('Fetched data:', result.data.outlets);

                this.outlets = result.data.outlets || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.outlets = this.outlets.filter(o => o.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.outlets = this.outlets.filter(o =>
                        o.outlet_name.toLowerCase().includes(lowerSearch)
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.outlets.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.outlets.length;
            } catch (error) {
                console.error('Error fetching outlets:', error);
            }
        },

        async changePage(page) {
            if (page === '...' || isNaN(page)) return;
            this.pagination.current_page = parseInt(page);
            await this.fetchOutlets();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchOutlets();
            }
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchOutlets();
            }
        },

        async resetFilters() {
            this.search = '';
            this.status = '';
            this.pagination.current_page = 1;
            await this.fetchOutlets();
        },

        confirmDelete(id) {
            this.outletIdToDelete = id;
            this.showDeleteModal = true;
        },

        async deleteOutlet() {
            try {
                const mutation = `
                    mutation($outlet_id: ID!) {
                        deleteOutlet(outlet_id: $outlet_id) {
                            outlet_id
                        }
                    }
                `;

                const variables = {
                    id_outelt: this.outletIdToDelete
                };

                const response = await fetch('/graphql', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ query: mutation, variables })
                });

                const result = await response.json();

                if (result.data?.deleteoutlet?.outlet_id) {
                    this.showDeleteModal = false;
                    this.outletIdToDelete = null;
                    await this.fetchOutlets();
                } else {
                    console.error('Failed to delete outlet.');
                }
            } catch (error) {
                console.error('Error deleting outlet:', error);
            }
        }
    };
}