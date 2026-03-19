import './bootstrap';

import Alpine from 'alpinejs';

Alpine.store('theme', {
	theme: 'light',
	init() {
		const savedTheme = localStorage.getItem('theme');
		const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
		this.theme = savedTheme || systemTheme;
		this.updateTheme();
	},
	toggle() {
		this.theme = this.theme === 'light' ? 'dark' : 'light';
		localStorage.setItem('theme', this.theme);
		this.updateTheme();
	},
	updateTheme() {
		const html = document.documentElement;
		if (this.theme === 'dark') {
			html.classList.add('dark');
		} else {
			html.classList.remove('dark');
		}
	}
});

Alpine.store('sidebar', {
	isExpanded: window.innerWidth >= 1280,
	isMobileOpen: false,
	isHovered: false,
	toggleExpanded() {
		this.isExpanded = !this.isExpanded;
		this.isMobileOpen = false;
	},
	toggleMobileOpen() {
		this.isMobileOpen = !this.isMobileOpen;
	},
	setHovered(value) {
		if (window.innerWidth >= 1280 && !this.isExpanded) {
			this.isHovered = value;
		}
	}
});

window.Alpine = Alpine;

Alpine.start();
