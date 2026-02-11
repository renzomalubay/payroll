import swal, { jqueryErrorSwal } from "@utils/swal";
import DataTable, {
    Config,
    InstSelector,
    ConfigColumns,
} from "datatables.net-bs5";
import "datatables.net-responsive-bs5";
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
    columnDefs: [{ className: "text-start align-middle", targets: "_all" }],
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
