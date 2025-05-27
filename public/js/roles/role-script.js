function roleData() {
    return {
        roles: [],
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
        roleIdToDelete: null,

        init() {
            this.fetchRoles();
        },

        async fetchRoles() {
            try {
                const query = `
                    query($search: String) {
                        roles(search: $search) {
                        role_id
                        role_name
                        code
                        description
                        }
                    }
                    `;

                const variables = {
                    page: this.pagination.current_page,
                    perPage: this.pagination.per_page,
                    search: this.search || null
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
                console.log('Fetched data:', result.data.roles);

                this.roles = result.data.roles || [];

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.roles = this.roles.filter(r =>
                        r.role_name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.roles.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.roles.length;
            } catch (error) {
                console.error('Error fetching Role types:', error);
            }
        },

        async changePage(page) {
            if (page === '...' || isNaN(page)) return;
            this.pagination.current_page = parseInt(page);
            await this.fetchRoles();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchRoles();
            }
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchRoles();
            }
        },

        async resetFilters() {
            this.search = '';
            this.status = '';
            this.pagination.current_page = 1;
            await this.fetchRoles();
        },

        confirmDelete(id) {
            this.roleIdToDelete = id;
            this.showDeleteModal = true;
        },

        async deleteVRole() {
            try {
                const mutation = `
                    mutation($role_id: ID!) {
                        deleteRole(role_id: $role_id) {
                            role_id
                        }
                    }
                `;

                const variables = {
                    role_id: this.roleIdToDelete
                };

                const response = await fetch('/graphql', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ query: mutation, variables })
                });

                const result = await response.json();

                if (result.data?.deleterole?.role_id) {
                    this.showDeleteModal = false;
                    this.roleIdToDelete = null;
                    await this.fetchRoles();
                } else {
                    console.error('Failed to delete role type.');
                }
            } catch (error) {
                console.error('Error deleting role type:', error);
            }
        }
    };
}