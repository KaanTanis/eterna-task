<template>
    <nav class="bg-gray-800">
        <div class="container mx-auto py-4">
            <ul class="flex items-center gap-x-6 [&>li>a]:text-white">
                <li>
                    <router-link to="/" class="block py-2 px-4 hover:bg-gray-700 rounded-2xl">Ana Sayfa</router-link>
                </li>
                <li>
                    <router-link to="/categories" class="block py-2 px-4 hover:bg-gray-700 rounded-2xl">Kategoriler</router-link>
                </li>
                <li>
                    <router-link to="/products" class="block py-2 px-4 hover:bg-gray-700 rounded-2xl">Ürünler</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Header',
};
</script>