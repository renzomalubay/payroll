import { route as routeFn } from "ziggy-js";

declare global {
    interface ImportMeta {
        env: Env;
    }

    const route: typeof routeFn;
}
