import "./bootstrap";
import "../css/app.css";
import "./app.css";

import { createInertiaApp, router } from "@inertiajs/react";
import { createRoot } from "react-dom/client";

import AuthenticatedFacultyLayout from "@/Layouts/AuthenticatedFacultyLayout";
import { AuthenticatedAdminLayout } from "@/Layouts/AuthenticatedAdminLayout";

router.on('progress', (event) => {
    event.detail.progress.percentage
  })

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.jsx", { eager: true });
        let page = pages[`./Pages/${name}.jsx`];

        if (name.startsWith("Faculty/")) {
            page.default.layout = (page) => (
                <AuthenticatedFacultyLayout children={page} />
            );
        } else if (name.startsWith("Admin/")) {
            page.default.layout = (page) => (
                <AuthenticatedAdminLayout children={page} />
            );
        } else {
            undefined; // Optional: Add a fallback layout
        }

        return page;
    },

    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});
