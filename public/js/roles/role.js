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
    
    //Role Type Data Component
    Alpine.data('roleData', () => ({
       roles: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0
        },
        search: '',
        status: '',
        showDeleteModal: false,
        roleIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchRoles();
        },

        async fetchRoles() {
            this.loading = true;
            this.error = null;

            const query =`query GetRoles($page: Int, $perPage: Int, $search: String) { roles (page: $page, perPage: $perPage, search: $search) { 
            data {  
                role_id 
                role_name 
                code 
                description 
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
            search: this.search
        };

        const result = await executeGraphQL(query, variable);

        if (result.error) {
            this.error = result.error[0].message;
            console.error('GraphQL Errors:', result.errors);
        } else {
            this.roles = result.data.roles,data;
            this.pagination = {
                current_page: result.data.roles.paginatorInfo.currentPage,
                last_page: result.data.roles.paginatorInfo.lastPage,
                per_page: result.data.roleIdToDelete.paginatorInfo.perPage,
                total: result.data.roles.paginatorInfo.total,
                has_more: result.data.roles.paginatorInfo.hasMorePages
            };
        }
        this.loading = false;
        },


        async deleteRole() {
            if (!this.roleIdToDelete) return;

            const mutation = `mutation DeleteRole($id: ID!) { 
            deleteRole(role_id: $id) 
            { 
            role 
            role_name }}`;

        const variables = {
            id: this.c=this.roleIdToDelete
        };

        const result = await executeGraphQL(mutation, variables);

        if (result.errors) {
            this.error = result.errors[0].message;
            console.error('GraphQl Errors:', result.errors);
        } else {
            this.showDeleteModal = false;
            await this.fetchRoles();
        }
        },

        //Pagination methods
        async changePage(page) {
            if (page === '...') return;
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
        }
    }));

    Alpine.start();
});
