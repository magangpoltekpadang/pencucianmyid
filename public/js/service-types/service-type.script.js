function serviceTypeData() {
    return {
        serviceTypes: [],
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
        serviceTypeIdToDelete: null,

        init() {
            this.fetchServiceTypes();
        },

        async fetchServiceTypes() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        serviceTypes(search: $search, is_active: $is_active) {
                        service_type_id
                        type_name
                        code
                        description
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
                console.log('Fetched data:', result.data.serviceTypes);

                this.serviceTypes = result.data.serviceTypes || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.serviceTypes = this.serviceTypes.filter(s => s.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.serviceTypes = this.serviceTypes.filter(s =>
                        s.type_name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.serviceTypes.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.serviceTypes.length;
            } catch (error) {
                console.error('Error fetching service types:', error);
            }
        },

        async changePage(page) {
            if (page === '...' || isNaN(page)) return;
            this.pagination.current_page = parseInt(page);
            await this.fetchServiceTypes();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchServiceTypes();
            }
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchServiceTypes();
            }
        },

        async resetFilters() {
            this.search = '';
            this.status = '';
            this.pagination.current_page = 1;
            await this.fetchServiceTypes();
        },

        confirmDelete(id) {
            this.serviceTypeIdToDelete = id;
            this.showDeleteModal = true;
        },

        async deleteVServiceType() {
            try {
                const mutation = `
                    mutation($service_type_id: ID!) {
                        deleteServiceType(service_type_id: $service_type_id) {
                            service_type_id
                        }
                    }
                `;

                const variables = {
                    service_type_id: this.serviceTypeIdToDelete
                };

                const response = await fetch('/graphql', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ query: mutation, variables })
                });

                const result = await response.json();

                if (result.data?.deleteserviceType?.service_type_id) {
                    this.showDeleteModal = false;
                    this.serviceTypeIdToDelete = null;
                    await this.fetchServiceTypes();
                } else {
                    console.error('Failed to delete service type.');
                }
            } catch (error) {
                console.error('Error deleting service type:', error);
            }
        }
    };
}