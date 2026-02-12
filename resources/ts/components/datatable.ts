import swal, { jqueryErrorSwal } from "@utils/swal";
import DataTable, { Config, InstSelector, ConfigColumns } from "datatables.net"; // Use the base package
import "datatables.net-responsive";
import jQuery from "jquery";
import { merge } from "lodash";

// fix css issue where sort icon is not aligned properly
DataTable.type("num", "className", "");
DataTable.type("num-fmt", "className", "");
DataTable.type("date", "className", "");

// Default config for the datatable
const defaultConfig: Config = {
    processing: true,
    serverSide: true,
    responsive: true,
    // The "layout" property is the modern way to position search/pagination in DT 2.0
    // If you are on an older version, use: dom: '<"flex justify-between"fl>rt<"flex justify-between"ip>'
    layout: {
        topStart: "pageLength",
        topEnd: "search",
        bottomStart: "info",
        bottomEnd: "paging",
    },
    // This ensures all injected text is black
    language: {
        search: "Search:",
        lengthMenu: "_MENU_ entries per page",
    },
    columnDefs: [
        {
            className: "px-6 py-4 text-black border-b border-gray-100",
            targets: "_all",
        },
    ],
    // Apply Tailwind classes to the library-generated elements
    initComplete: function () {
        // Search Input
        jQuery(".dt-search input").addClass(
            "ml-2 px-3 py-1 border border-gray-300 rounded-md bg-white text-black outline-none focus:ring-2 focus:ring-black",
        );

        // Length Dropdown
        jQuery(".dt-length select").addClass(
            "mx-2 px-3 py-1 border border-gray-300 rounded-md bg-white text-black",
        );
    },
    drawCallback: function () {
        // Pagination Buttons Styling
        const paginateBtn = jQuery(".dt-paging-button");
        paginateBtn.addClass(
            "px-3 py-1 border border-gray-200 ml-1 rounded hover:bg-black hover:text-white transition-colors text-black",
        );

        // Active page styling
        jQuery(".dt-paging-button.current").addClass(
            "bg-gray-100 font-bold border-black text-black",
        );
    },
};

Object.freeze(defaultConfig);

/**
 * Creates and returns a new DataTable instance with a customized configuration.
 *
 * @param selector - The selector for the HTML element(s) to be initialized as DataTables.
 * @param opts - An optional configuration object to override the default settings.
 * @returns  A new DataTable instance with the specified configuration.
 *
 */
export default function <T>(selector: InstSelector, opts: DTConfig<T> = {}) {
    // Create a copy of the default config to prevent mutation
    const config: Config = { ...defaultConfig };

    // Merge opts with default config
    merge(config, opts);

    // Return the DataTable instance with the customized config
    return new DataTable(selector, config);
}

// Define a type that overrides just the `render` function for columns
// @ts-ignore
interface CustomConfigColumn<T> extends ConfigColumns {
    render?: (data: any, type: "display" | "type", row: T, meta: any) => any;
}

// Extend the original Config type to use the custom column definition
export interface DTConfig<T> extends Omit<Config, "columns"> {
    columns?: CustomConfigColumn<T>[];
}

// OVERWRITE ERROR HANDLING
// @ts-ignore
jQuery.fn.dataTable.ext.errMode = function ({ jqXHR, api }, errCode, dtError) {
    const is_dev = import.meta.env.VITE_APP_ENV === "local";
    console.log("All loaded env vars:", import.meta.env);
    console.log(is_dev, import.meta.env.VITE_APP_ENV);
    const { responseJSON, status, statusText } = jqXHR as JQueryXHR;
    let title = `${status} - ${statusText}`;
    let text: string = dtError;

    if (is_dev) {
        jqueryErrorSwal(jqXHR);
        console.error(
            `status: ${status} - ${statusText}. \nSee error details below:`,
        );
        console.table(responseJSON ?? "No json response");
        console.error(dtError);
    } else {
        // error to show in production
        const msg: Record<number, string> = {
            503: "Service Unavailable",
            500: "Server Error",
            404: "404: Not Found",
            403: "Forbidden",
            401: "Unauthorized",
            419: "Page Expired",
        };
        title = msg[status] ?? "Error";

        text =
            {
                503: "Sorry, we are doing some maintenance. Please check back soon.",
                500: "Whoops, something went wrong on our servers.",
                404: "Sorry, the resource you are looking for could not be found.",
                403: "Sorry, you are forbidden from accessing this data.",
                401: "Sorry, you need to login to access this data.",
                419: "The page expired, please try again.",
            }[status] ||
            "Sorry, there was an issue fetching the data. Please try again later.";

        swal({
            title,
            text,
            icon: "error",
        }).then(() => {
            if (status === 401 || status === 419) {
                window.location.reload();
            }
        });
    }

    // hide loading after error
    jQuery(".dt-processing").css("display", "none");
    jQuery(api.table().body()).find(".dt-empty").text(text);
};
