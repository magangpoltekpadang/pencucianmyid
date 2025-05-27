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
    
    //Vehicle Type Data Component
    Alpine.data('vehicleTypeData', () => ({
        vehicleTypes: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0
        },
        search: '',
        status: '',
        showDeleteModal: false,
        vehicleTypeIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchVehicleTypes();
        },

        async fetchVehicleTypes() {
            this.loading = true;
            this.error = null;

            const query =`query GetVehicleTypes($page: Int, $perPage: Int, $search: String, $is_active: Boolean) { vehicleTypes (page: $page, perPage: $perPage, search: $search, is_active: $is_active) { 
            data {  
                vehicle_type_id 
                type_name 
                code 
                description 
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
            this.vehicleTypes = result.data.vehicleTypes,data;
            this.pagination = {
                current_page: result.data.vehicleTypes.paginatorInfo.currentPage,
                last_page: result.data.vehicleTypes.paginatorInfo.lastPage,
                per_page: result.data.vehicleTypeIdToDelete.paginatorInfo.perPage,
                total: result.data.vehicleTypes.paginatorInfo.total,
                has_more: result.data.vehicleTypes.paginatorInfo.hasMorePages
            };
        }
        this.loading = false;
        },


        async deleteVehicleType() {
            if (!this.vehicleTypeIdToDelete) return;

            const mutation = ` mutation DeleteVehicleType($id: ID!) 
            { deleteVehicleType(vehicle_type_id: $id) { 
             vehicle_type_id 
             type_name 
             code
             description}}`;

        const variables = {
            id: this.c=this.vehicleTypeIdToDelete
        };

        const result = await executeGraphQL(mutation, variables);

        if (result.errors) {
            this.error = result.errors[0].message;
            console.error('GraphQl Errors:', result.errors);
        } else {
            this.showDeleteModal = false;
            await this.fetchVehicleTypes();
        }
        },

        //Pagination methods
        async changePage(page) {
            if (page === '...') return;
            this.pagination.current_page = parseInt(page);
            await this.fetchVehicleTypes();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchVehicleTypes();
            }
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchVehicleTypes();
            }
        },

        async resetFilters() {
            this.search = '';
            this.status = '';
            this.pagination.current_page = 1;
            await this.fetchVehicleTypes();
        },

        confirmDelete(id) {
            this.vehicleTypeIdToDelete = id;
            this.showDeleteModal = true;
        }
    }));

    Alpine.start();
});
