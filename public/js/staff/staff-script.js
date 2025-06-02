function staffData() {
    return {
        staffs: [],
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
        staffIdToDelete: null,

        init() {
            this.fetchStaffs();
        },

        async fetchStaffs() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        staffs(search: $search, is_active: $is_active) {
                        staff_id
                        name
                        email
                        phone_number
                        password_hash
                        outlet_id
                        role_id
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
                console.log('Fetched data:', result.data.staffs);

                this.staffs = result.data.staffs || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.staffs = this.staffs.filter(s => s.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.staffs = this.staffs.filter(s =>
                        s.name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.staffs.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.staffs.length;
            } catch (error) {
                console.error('Error fetching staffs:', error);
            }
        },

        async changePage(page) {
            if (page === '...' || isNaN(page)) return;
            this.pagination.current_page = parseInt(page);
            await this.fetchStaffs();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchStaffs();
            }
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchSraffs();
            }
        },

        async resetFilters() {
            this.search = '';
            this.status = '';
            this.pagination.current_page = 1;
            await this.fetchStaffs();
        },

        confirmDelete(id) {
            this.staffIdToDelete = id;
            this.showDeleteModal = true;
        },

      async deleteStaff() {
    try {
        const mutation = `
            mutation($staff_id: ID!) {
                deleteStaff(staff_id: $staff_id) {
                    staff_id
                }
            }
        `;

        const variables = {
            staff_id: this.staffIdToDelete
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

        if (result.data?.deleteStaff?.staff_id) {
            this.showDeleteModal = false;
            this.staffIdToDelete = null;
            await this.fetchStaffs();
        } else {
            console.error('Failed to delete staff.');
        }
    } catch (error) {
        console.error('Error deleting staff:', error);
    }
}

    };
}