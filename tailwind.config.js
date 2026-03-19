import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                outfit: ['Outfit', ...defaultTheme.fontFamily.sans],
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    25: '#f6f7ff',
                    50: '#eef1ff',
                    100: '#dfe4ff',
                    200: '#c6cdff',
                    300: '#a3acfe',
                    400: '#7e81fb',
                    500: '#465fff',
                    600: '#4745ec',
                    700: '#3b35d1',
                    800: '#302da8',
                    900: '#2c2c85',
                    950: '#1b194d',
                },
                success: {
                    50: '#ecfdf5',
                    100: '#d1fae5',
                    200: '#a7f3d0',
                    300: '#6ee7b7',
                    400: '#34d399',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
                error: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#f04438',
                    600: '#d92d20',
                    700: '#b42318',
                    800: '#912018',
                    900: '#7a271a',
                },
                warning: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
                gray: {
                    25: '#fcfcfd',
                    50: '#f9fafb',
                    100: '#f3f4f6',
                    200: '#e5e7eb',
                    300: '#d1d5db',
                    400: '#9ca3af',
                    500: '#6b7280',
                    600: '#4b5563',
                    700: '#374151',
                    800: '#1f2937',
                    900: '#111827',
                    950: '#030712',
                },
            },
            boxShadow: {
                'theme-xs': '0px 1px 2px 0px rgba(0, 0, 0, 0.05)',
                'theme-sm': '0px 1px 2px 0px rgba(0, 0, 0, 0.06), 0px 1px 3px 0px rgba(0, 0, 0, 0.1)',
                'theme-md': '0px 2px 4px -2px rgba(0, 0, 0, 0.06), 0px 4px 8px -2px rgba(0, 0, 0, 0.1)',
                'theme-lg': '0px 4px 6px -2px rgba(0, 0, 0, 0.03), 0px 12px 16px -4px rgba(0, 0, 0, 0.08)',
                'theme-xl': '0px 8px 8px -4px rgba(0, 0, 0, 0.03), 0px 20px 24px -4px rgba(0, 0, 0, 0.08)',
                'theme-2xl': '0px 24px 48px -12px rgba(0, 0, 0, 0.18)',
            },
            spacing: {
                '4.5': '1.125rem',
                '5.5': '1.375rem',
                '6.5': '1.625rem',
            },
            zIndex: {
                1: '1',
                99: '99',
                999: '999',
                9999: '9999',
                99999: '99999',
            },
        },
    },

    plugins: [forms],
};
