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
    
    //Outlet Data Component
    Alpine.data('outletData', () => ({
       outlets: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0
        },
        search: '',
        status: '',
        showDeleteModal: false,
        outletIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchOutletTypes();
        },

        async fetchOutletTypes() {
            this.loading = true;
            this.error = null;

            const query =`query GetOutletTypes($page: Int, $perPage: Int, $search: String, $is_active: Boolean) { outlets (page: $page, perPage: $perPage, search: $search, is_active: $is_active) { 
            data {  
                outlet_id 
                outlet_name 
                address 
                phone_number 
                latitude
                longitude
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
            this.outlets = result.data.outlets,data;
            this.pagination = {
                current_page: result.data.outlets.paginatorInfo.currentPage,
                last_page: result.data.outlets.paginatorInfo.lastPage,
                per_page: result.data.outletIdToDelete.paginatorInfo.perPage,
                total: result.data.outlets.paginatorInfo.total,
                has_more: result.data.outlets.paginatorInfo.hasMorePages
            };
        }
        this.loading = false;
        },


        async deleteOutlet() {
            if (!this.outletIdToDelete) return;

            const mutation = `mutation DeleteOutlet($id: ID!) { 
            deleteOutlet(outlet_id: $id) 
            { 
            outlet_id 
            otlet_name }}`;

        const variables = {
            id: this.c=this.outletIdToDelete
        };

        const result = await executeGraphQL(mutation, variables);

        if (result.errors) {
            this.error = result.errors[0].message;
            console.error('GraphQl Errors:', result.errors);
        } else {
            this.showDeleteModal = false;
            await this.fetchOutlets();
        }
        },

        //Pagination methods
        async changePage(page) {
            if (page === '...') return;
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
        }
    }));

    Alpine.start();
});
