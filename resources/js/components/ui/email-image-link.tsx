import React, { type ReactNode } from "react";
import { EmailLink } from "@/components/ui/email-link";
import { cn } from "@/lib/utils";

type Variant = "pill" | "plain";

type Props = {
  email?: string | null;
  variant?: Variant;
  color?: string; // hex like "#fff" / "#ffffff" / "fff" / "ffffff"
  /** When set (valid hex), a second image is rendered and shown only in dark mode (Tailwind `dark:`). */
  darkColor?: string;
  fontSize?: number; // px
  fontWeight?: number; // 100..900
  /** Label or icon before the email image (e.g. `"Email: "` or `<Mail className="h-4 w-4" aria-hidden />`). */
  prefix?: ReactNode;
  /** Classes for the wrapper around `prefix` (e.g. optical alignment with the email image). */
  prefixClassName?: string;
  subject?: string;
  className?: string;
  imgClassName?: string;
  alt?: string;
};

function normalizeHex(input: string | undefined) {
  if (!input) return undefined;
  const hex = input.trim().replace(/^#/, "");
  return /^[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/.test(hex) ? hex.toLowerCase() : undefined;
}

function clampFontSize(n: number | undefined) {
  if (!n || Number.isNaN(n)) return undefined;
  return Math.min(22, Math.max(12, Math.round(n)));
}

function clampFontWeight(n: number | undefined) {
  if (!n || Number.isNaN(n)) return undefined;
  const rounded = Math.round(n / 100) * 100;
  return Math.min(900, Math.max(100, rounded));
}

function buildEmailSvgSrc(
  variant: Variant,
  hex: string | undefined,
  fontSize: number | undefined,
  fontWeight: number | undefined,
) {
  const params = new URLSearchParams();
  params.set("v", variant);
  if (hex) params.set("c", hex);
  if (fontSize) params.set("s", String(fontSize));
  if (fontWeight) params.set("w", String(fontWeight));
  return `${route("public.email.svg")}?${params.toString()}`;
}

export function EmailImageLink({
  email,
  variant = "pill",
  color,
  darkColor,
  fontSize,
  fontWeight,
  prefix,
  prefixClassName,
  subject,
  className,
  imgClassName,
  alt = "Email address",
}: Props) {
  const value = (email ?? "").trim();
  const [user, domain] = value.split("@");
  const ok = Boolean(user && domain);

  const c = normalizeHex(color);
  const cDark = normalizeHex(darkColor);
  const s = clampFontSize(fontSize);
  const w = clampFontWeight(fontWeight);

  if (!ok) return null;

  const dualTone = Boolean(c && cDark);

  const emailImages = dualTone ? (
    <span className="inline-flex shrink-0 items-center leading-none">
      <img
        src={buildEmailSvgSrc(variant, c, s, w)}
        alt={alt}
        className={cn("block", imgClassName, "dark:hidden")}
        loading="lazy"
      />
      <img
        src={buildEmailSvgSrc(variant, cDark, s, w)}
        alt={alt}
        className={cn("block", imgClassName, "hidden dark:block")}
        loading="lazy"
      />
    </span>
  ) : (
    <img
      src={buildEmailSvgSrc(variant, c, s, w)}
      alt={alt}
      className={cn("block", imgClassName)}
      loading="lazy"
    />
  );

  return (
    <EmailLink user={user} domain={domain} subject={subject} className={className}>
      {prefix != null && prefix !== false ? (
        <span
          className={cn(
            // Lucide (and similar) glyphs often sit high in the viewBox; nudge down to align with the email image cap height.
            "inline-flex shrink-0 items-center overflow-visible leading-none [&_svg]:block [&_svg]:translate-y-0.5",
            prefixClassName,
          )}
        >
          {prefix}
        </span>
      ) : null}
      {emailImages}
    </EmailLink>
  );
}

