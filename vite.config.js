import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/reviews.js',
                'resources/js/welcome.js',
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/menu.css',
                'resources/css/about-us.css',
                'resources/css/contact-us.css',
                'resources/css/bachelor.css',
                'resources/css/event.css',
                'resources/css/navbar.css',
                'resources/css/footer.css',
                'resources/css/login.css',
                'resources/css/register.css',
                'resources/css/admin-nav.css',
                'resources/css/categorycreate.css',
                'resources/css/categoryedit.css',
                'resources/css/categoryindex.css',
                'resources/css/product-create.css',
                'resources/css/product-edit.css',
                'resources/css/order-now.css',
                'resources/css/welcome.css',
                'resources/css/dashboard.css',
                'resources/css/account-details.css',
                'resources/css/address.css',
                'resources/css/order-tracking.css',
                'resources/css/sales-chart.css',
                'resources/css/reviews.css',
                'resources/css/career.css',
                'resources/css/value.css',
                'resources/css/mission.css',
                'resources/css/privacy-terms.css',
              
            ],
            refresh: true,
        }),
    ],
});
