function expenseData() {
    return {
        expenses: [],
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
        expenseIdToDelete: null,

        init() {
            this.fetchExpenses();
        },

        async fetchExpenses() {
            try {
                const query = `
                    query($search: String) {
                        expenses(search: $search) {
                        expense_id
                        expense_code
                        outlet_id
                        expense_date
                        amount
                        category
                        description
                        staff_id
                        shift_id
                        }
                    }
                    `;

                const variables = {
                    page: this.pagination.current_page,
                    perPage: this.pagination.per_page,
                    search: this.search || null,
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
                console.log('Fetched data:', result.data.expenses);

                this.expenses = result.data.expenses || [];

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.expenses = this.expenses.filter(s =>
                        s.expense_code.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.expenses.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.expenses.length;
            } catch (error) {
                console.error('Error fetching expenses:', error);
            }
        },

        async changePage(page) {
            if (page === '...' || isNaN(page)) return;
            this.pagination.current_page = parseInt(page);
            await this.fetchExpenses();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchExpenses();
            }
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchExpenses();
            }
        },

        async resetFilters() {
            this.search = '';
            this.status = '';
            this.pagination.current_page = 1;
            await this.fetchExpenses();
        },

        confirmDelete(id) {
            this.expenseIdToDelete = id;
            this.showDeleteModal = true;
        },

      async deleteExpense() {
    try {
        const mutation = `
            mutation($expense_id: ID!) {
                deleteExpense(expense_id: $expense_id) {
                    expense_id
                }
            }
        `;

        const variables = {
            expense_id: this.expenseIdToDelete
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

        if (result.data?.deleteExpense?.expense_id) {
            this.showDeleteModal = false;
            this.expenseIdToDelete = null;
            await this.fetchExpenses();
        } else {
            console.error('Failed to delete expense.');
        }
    } catch (error) {
        console.error('Error deleting expense:', error);
    }
}

    };
}