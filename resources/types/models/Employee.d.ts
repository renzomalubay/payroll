type Employee = {
    // Database Fields from Migration
    id: number;
    user_id: number;
    first_name: string;
    last_name: string;
    middle_name: string | null;
    ext_name: string | null;
    birth_date: string; // ISO Date string
    contact_number: string;
    address: string;
    position: string;
    employment_type: string;
    start_date: string;
    leave_credit: number;
    sss_no: string | null;
    hdmf_no: string | null;
    philhealth_no: string | null;
    bank_account_number: string | null;
    department_id: number;
    branch_id: number;
    salary_id: number;

    // Timestamps
    created_at: string | null;
    updated_at: string | null;
    deleted_at: string | null;

    // Relationships (If you use ->with('user'))
    user?: User;
};

// This matches your previous snippet - likely the 'User' account
export type User = {
    id: number;
    name: string;
    email: string;
    role: string | null;
    email_verified_at: string | null;
    password_text?: string; // Usually hidden in production
    created_at: string | null;
    updated_at: string | null;
};
