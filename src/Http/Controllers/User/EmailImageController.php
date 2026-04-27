<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailImageController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $email = (string) optional(Setting::find(1))->email;
        if ($email === '') {
            $email = (string) config('app.email', '');
        }

        $safe = htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        $variant = (string) $request->query('v', 'pill'); // "pill" | "plain"
        $color = (string) $request->query('c', '');
        $size = (int) $request->query('s', 0);
        $weight = (int) $request->query('w', 0);

        $hex = preg_match('/^[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/', $color) ? strtolower($color) : null;
        $fontSize = ($size >= 12 && $size <= 22) ? $size : null;
        $fontWeight = ($weight >= 100 && $weight <= 900) ? (int) (round($weight / 100) * 100) : null;

        if ($variant === 'plain') {
            $fill = $hex ? '#'.$hex : 'currentColor';
            $fs = $fontSize ?? 14;
            $fw = $fontWeight ?? 700;
            $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="360" height="24" viewBox="0 0 360 24" role="img" aria-label="Email address">
  <style>
    text {
      font: {$fw} {$fs}px ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
      fill: {$fill};
    }
  </style>
  <rect width="100%" height="100%" fill="transparent"/>
  <text x="0" y="12" dominant-baseline="central" text-anchor="start">$safe</text>
</svg>
SVG;
        } else {
            $fill = $hex ? '#'.$hex : '#ffffff';
            $fs = $fontSize ?? 15;
            $fw = $fontWeight ?? 800;
            $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="440" height="28" viewBox="0 0 440 28" role="img" aria-label="Email address">
  <style>
    text {
      font: {$fw} {$fs}px ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
      fill: {$fill};
      stroke: rgba(0,0,0,0.55);
      stroke-width: 2;
      stroke-linejoin: round;
      paint-order: stroke fill;
    }
  </style>
  <rect width="100%" height="100%" fill="transparent"/>
  <rect x="0" y="3" width="438" height="22" rx="9" fill="rgba(0,0,0,0.35)"/>
  <text x="10" y="19">$safe</text>
</svg>
SVG;
        }

        return response($svg, 200)
            ->header('Content-Type', 'image/svg+xml; charset=UTF-8')
            ->header('Cache-Control', 'no-store, max-age=0');
    }
}

