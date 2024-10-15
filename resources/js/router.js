import { createRouter, createWebHistory } from 'vue-router';
import TradeMark from './trademark/Trademark.vue';
import Product from './product/Product.vue';

const routes = [
    { path: '/admin', name: 'Dashboard' },
    { path: '/admin/trademark/list', component: TradeMark, name: 'TradeMark' },
    { path: '/admin/product/list', component: Product, name: 'Product' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
