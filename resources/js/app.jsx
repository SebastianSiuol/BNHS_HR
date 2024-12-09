import "./bootstrap";
import "../css/app.css";
import "./app.module.css";

import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";

import { AuthenticatedAdminLayout } from '@/Layouts/AuthenticatedAdminLayout.jsx';

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.jsx", { eager: true });
        let page = pages[`./Pages/${name}.jsx`];
        page.default.layout = name.startsWith('Admin/') ? page => <AuthenticatedAdminLayout children={page} /> : undefined;
        return page
    },


    setup({ el, App, props, }) {
        createRoot(el).render(
                <App {...props} />
        );
    },
});
