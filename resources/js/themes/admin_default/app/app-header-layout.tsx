import type { PropsWithChildren } from 'react';
import React from 'react';
import { AppContent } from '@/components/layout/app-content';
import { AppHeader } from '@/components/layout/app-header';
import { AppShell } from '@/components/layout/app-shell';
import { ScrollToTopButton } from '@/components/ui/navigation/scroll-to-top-button';
import { type BreadcrumbItem } from '@/types';

export default function AppHeaderLayout({ children, breadcrumbs }: PropsWithChildren<{ breadcrumbs?: BreadcrumbItem[] }>) {
    return (
        <AppShell>
            <AppHeader breadcrumbs={breadcrumbs} />
            <AppContent>{children}</AppContent>
            <ScrollToTopButton variant="arrow" />
        </AppShell>
    );
}
