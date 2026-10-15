import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                // ── Altesa Design System Color Palette ──────────────────────
                // Warm luxury visual identity — peach, amber, cream, charcoal

                'aw-cream': {
                    DEFAULT: '#FCFAF7',   // Background Base: Soft Cream / Warm Off-White
                    50:  '#FFFFFF',
                    100: '#FEFDFB',
                    200: '#FCFAF7',
                    300: '#F5F0E8',
                    400: '#EDE5D8',
                },
                'aw-gold': {
                    DEFAULT: '#F5B990',   // Primary Accent / CTA Fill: Warm Pastel Peach
                    300: '#FBDCC4',
                    400: '#F8C8A4',
                    500: '#F5B990',
                    600: '#E89C62',       // Accent Highlight & Ratings: Warm Amber Gold
                    700: '#D4863E',
                },
                'aw-navy': {
                    DEFAULT: '#1C1C1C',   // Primary Text: Dark Charcoal
                    700: '#2D2D2D',
                    800: '#1C1C1C',
                    900: '#111111',
                },
                'aw-forest': {
                    DEFAULT: '#18181B',   // Dark Footer & Overlays: Deep Blackish Charcoal
                    700: '#27272A',
                    800: '#18181B',
                    900: '#09090B',
                },
                'aw-sage': {
                    DEFAULT: '#6B7280',   // Secondary Text: Muted Warm Gray
                    400: '#9CA3AF',
                    500: '#6B7280',
                    600: '#4B5563',
                    700: '#374151',
                },
                'aw-mint': {
                    DEFAULT: '#F5B990',   // Mapped to peach tints for badge/tag usage
                    200: '#FDE8D8',
                    300: '#FBDCC4',
                    400: '#F5B990',
                    500: '#E89C62',
                },

                // ── Logo Colors (hanya untuk elemen logo AW) ────────────────
                // Tidak digunakan sebagai warna utama website
                'logo-blue': '#00a3e0',
                'logo-lime': '#80ee11',
            },
            fontFamily: {
                // Font utama website
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                // Font aksen (judul, headline)
                display: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            borderRadius: {
                '4xl': '2rem',
            },
        },
    },
    plugins: [],
};
