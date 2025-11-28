<template>
    <div class="admin-layout">
        <AdminSidebar />
        <div class="admin-main">
        <router-view />
        </div>
    </div>
</template>

<script>
import AdminSidebar from '@/components/AdminSidebar.vue'

export default {
    name: 'AdminLayout',
    components: {
        AdminSidebar
    }
}
</script>

<style scoped>
    .admin-layout {
        display: flex;
        min-height: 100vh;
        background: #f8f9fa;
    }

    .admin-main {
        flex: 1;
        margin-left: 250px;
        min-height: 100vh;
        overflow-x: hidden;
    }


    /* Pastikan tidak ada margin/padding conflict */
    .admin-main > * {
        width: 100%;
    }
</style>
