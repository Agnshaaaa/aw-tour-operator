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
                // ── Website Color Palette (Earthy & Nature Tones) ──────────────
                // Digunakan untuk semua halaman website

                'aw-cream': {
                    DEFAULT: '#EEE8E2',   // Latar belakang terang / section putih
                    50:  '#FDFCFB',
                    100: '#F7F4F1',
                    200: '#EEE8E2',
                    300: '#DDD5CB',
                },
                'aw-gold': {
                    DEFAULT: '#D39252',   // Aksen hangat / CTA button / highlight
                    300: '#E8B98A',
                    400: '#DDA56A',
                    500: '#D39252',
                    600: '#B87A3A',
                    700: '#9A6228',
                },
                'aw-navy': {
                    DEFAULT: '#010818',   // Teks utama / background gelap (hero, footer)
                    800: '#010D28',
                    900: '#010818',
                },
                'aw-forest': {
                    DEFAULT: '#203027',   // Elemen gelap sekunder / card background
                    700: '#2A3D33',
                    800: '#203027',
                    900: '#162019',
                },
                'aw-sage': {
                    DEFAULT: '#5A8F78',   // Aksen hijau medium / ikon / border
                    400: '#7AB099',
                    500: '#5A8F78',
                    600: '#487361',
                    700: '#37584B',
                },
                'aw-mint': {
                    DEFAULT: '#9CC5A1',   // Aksen hijau muda / badge / tag
                    200: '#C5DFC9',
                    300: '#B4D5B9',
                    400: '#9CC5A1',
                    500: '#80AF87',
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
        },
    },
    plugins: [],
};

