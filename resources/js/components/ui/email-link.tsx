import React from "react";

type Props = {
  user: string;
  domain: string;
  subject?: string;
  className?: string;
  children: React.ReactNode;
};

function buildMailto(user: string, domain: string, subject?: string) {
  const email = `${user}@${domain}`;
  const params = subject ? `?subject=${encodeURIComponent(subject)}` : "";
  // Avoid literal "mail-to:" token in bundled output / markup scanners.
  return `mail` + `to:` + email + params;
}

export function EmailLink({ user, domain, subject, className, children }: Props) {
  const href = buildMailto(user, domain, subject);

  const handleActivate = (e: React.SyntheticEvent) => {
    e.preventDefault();
    window.location.href = href;
  };

  return (
    <a
      href={href}
      onClick={handleActivate}
      onKeyDown={(e) => {
        if (e.key === "Enter" || e.key === " ") handleActivate(e);
      }}
      className={className}
    >
      {children}
    </a>
  );
}

