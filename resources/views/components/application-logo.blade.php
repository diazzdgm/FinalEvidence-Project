<svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:var(--primary-color, #2C3E50); stop-opacity:1" />
            <stop offset="100%" style="stop-color:var(--accent-color, #1ABC9C); stop-opacity:1" />
        </linearGradient>
    </defs>
    <g fill="none" stroke-width="2">
        <!-- Larger background rectangle - Primary Color -->
        <rect x="8" y="12" width="28" height="18" rx="2" fill="var(--primary-color, #2C3E50)"/>
        <!-- Smaller foreground rectangle - Accent Color, slightly offset -->
        <rect x="12" y="18" width="28" height="18" rx="2" fill="var(--accent-color, #1ABC9C)"/>
         <!-- Optional: A subtle line or element to hint at 'F' or 'E' if desired -->
        <path d="M12 24 H18 M12 30 H16" stroke="var(--white-color, #FFFFFF)" stroke-width="1.5" />
    </g>
    <!-- Fallback if CSS variables are not defined in SVG context (some renderers) -->
    <style>
        rect[fill="var(--primary-color, #2C3E50)"] { fill: #2C3E50; }
        rect[fill="var(--accent-color, #1ABC9C)"] { fill: #1ABC9C; }
        path[stroke="var(--white-color, #FFFFFF)"] { stroke: #FFFFFF; }
    </style>
</svg>
