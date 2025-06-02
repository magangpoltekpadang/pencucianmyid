document.addEventListener('DOMContentLoaded', function () {
    //GraphQL endpoint
    const graphqlEndpoint = '/graphql';


    //Function to excute GraphQl queries
    async function executeGraphQL(query, variables = {}) {
        try {
            const response = await fetch(graphqlEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'appliv=cation/json',
                },
                body: JSON.stringify({
                    query: query,
                    variables: variables
                })

            });
            return await response.json();
        } catch (error) {
            console.error('GrapQl Error:', error);
            return { errors: [error] };
        }
    }
    
    //Staff Data Component
    Alpine.data('staffData', () => ({
        staffs: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0
        },
        search: '',
        status: '',
        showDeleteModal: false,
        staffIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchStaffs();
        },

        async fetchStaffs() {
            this.loading = true;
            this.error = null;

            const query =`query GetStaffs($page: Int, $perPage: Int, $search: String, $is_active: Boolean) { staffs (page: $page, perPage: $perPage, search: $search, is_active: $is_active) { 
            data {  
                staff_id
                name
                email
                phone_number
                password_hash
                outlet_id
                role_id
                is_active
                created_at 
                updated_at } 
                paginatorInfo { 
                curretPage 
                lastPage 
                peraPage 
                total 
                hasMorePages }}}`;

        const variables = {
            page: this.pagination.current_page,
            perPage: this.pagination.per_page,
            search: this.search,
            is_active: this.status ? this.status === '1' : null
        };

        const result = await executeGraphQL(query, variable);

        if (result.error) {
            this.error = result.error[0].message;
            console.error('GraphQL Errors:', result.errors);
        } else {
            this.staffs = result.data.staffs,data;
            this.pagination = {
                current_page: result.data.staffs.paginatorInfo.currentPage,
                last_page: result.data.staffs.paginatorInfo.lastPage,
                per_page: result.data.staffIdToDelete.paginatorInfo.perPage,
                total: result.data.staffs.paginatorInfo.total,
                has_more: result.data.staffs.paginatorInfo.hasMorePages
            };
        }
        this.loading = false;
        },


        async deleteStaff() {
            if (!this.staffIdToDelete) return;

            const mutation = ` mutation DeleteStaff($id: ID!) 
            { deleteStaff(staff_id: $id) { 
             staff_id 
             name
             email
             phone_number
             password_hash
             outlet_id
             role_id
                }}`;

        const variables = {
            id: this.c=this.staffIdToDelete
        };

        const result = await executeGraphQL(mutation, variables);

        if (result.errors) {
            this.error = result.errors[0].message;
            console.error('GraphQl Errors:', result.errors);
        } else {
            this.showDeleteModal = false;
            await this.fetchStaffs();
        }
        },

        //Pagination methods
        async changePage(page) {
            if (page === '...') return;
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
                await this.fetchStaffs();
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
        }
    }));

    Alpine.start();
});
