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
    
    //Payemnt Method Data Component
    Alpine.data('paymentMethodData', () => ({
        paymentMethodes: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0
        },
        search: '',
        status: '',
        showDeleteModal: false,
        paymentMethodIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchPaymentMethodes();
        },

        async fetchPaymentMethodes() {
            this.loading = true;
            this.error = null;

            const query =`query GetPaymentMethodes($page: Int, $perPage: Int, $search: String, $is_active: Boolean) { paymentMethodes (page: $page, perPage: $perPage, search: $search, is_active: $is_active) { 
            data {  
                payment_method_id 
                methode_name 
                code 
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
            this.paymentMethodes = result.data.paymentMethodes,data;
            this.pagination = {
                current_page: result.data.paymentMethodes.paginatorInfo.currentPage,
                last_page: result.data.paymentMethodes.paginatorInfo.lastPage,
                per_page: result.data.paymentMethodIdToDelete.paginatorInfo.perPage,
                total: result.data.paymentMethodes.paginatorInfo.total,
                has_more: result.data.paymentMethodes.paginatorInfo.hasMorePages
            };
        }
        this.loading = false;
        },


        async deletePaymentMethod() {
            if (!this.paymentMethodIdToDelete) return;

            const mutation = ` mutation DeletePaymentMethod($id: ID!) 
            { deletePaymentMethod(payment_method_id: $id) { 
             payment_method_id 
             methode_name 
             code
             }}`;

        const variables = {
            id: this.c=this.paymentMethodIdToDelete
        };

        const result = await executeGraphQL(mutation, variables);

        if (result.errors) {
            this.error = result.errors[0].message;
            console.error('GraphQl Errors:', result.errors);
        } else {
            this.showDeleteModal = false;
            await this.fetchPaymentMethodes();
        }
        },

        //Pagination methods
        async changePage(page) {
            if (page === '...') return;
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
        }
    }));

    Alpine.start();
});
