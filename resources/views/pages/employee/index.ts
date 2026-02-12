import Swal from "sweetalert2";
import { route } from "ziggy-js";
import jQuery from "jquery";
import datatable from "@components/datatable";
import axios from "axios";
import { Employee } from "../../../types/models/Employee";

const dt = datatable<Employee>("#employeeTable", {
    ajax: route("employee.datatable"),
    columns: [
        {
            data: "id",
        },
        {
            data: "first_name",
        },
        {
            data: "last_name",
        },
        {
            data: "id",
        },
    ],
});
