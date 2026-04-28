import { Head, usePage } from "@inertiajs/react";
import { type ReactNode } from "react";
import { type BreadcrumbItem, type SharedData } from "@/types";
import { menuItems, profileItems, loginRoute } from "../../../data/js/header_user";
import AppLayoutTemplate from "../../themes/guest_default/app/app-header-layout";

interface AppLayoutProps {
    children: ReactNode;
    breadcrumbs?: BreadcrumbItem[];
    title: string;
    description?: string;
    canonicalUrl?: string;
    ogImageUrl?: string;
}

export default ({ children, breadcrumbs, title, description, canonicalUrl, ogImageUrl, ...props }: AppLayoutProps) => {
    const page = usePage<SharedData>();
    const { user } = page.props as unknown as { user?: { name: string; email: string } };
    const appData = (page.props as unknown as { appData?: { name?: string } }).appData;
    const appName = appData?.name ?? page.props.name ?? "App";
    const fullTitle = `${title} - ${appName}`;

    return (
        <AppLayoutTemplate
            authUser={user}
            menuItems={menuItems as any}
            profileItems={profileItems as any}
            loginRoute={loginRoute}
            breadcrumbs={breadcrumbs}
            {...props}
        >
            {children}
        </AppLayoutTemplate>
    );
};
