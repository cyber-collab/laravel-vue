<template>
    <div class="container">
        <sidebar-menu :items="menuItems" />
    </div>
</template>

<script lang="ts">

export default defineComponent({
    setup() {
        const menuItems = [
            { title: 'Home', icon: 'mdi-home', route: '/' },
            { title: 'Some Page', icon: 'mdi-page', route: '/some-page' },
            { title: 'About', icon: 'mdi-information', route: '/about' },
        ];

        return {
            menuItems,
        };
    },
});
</script>

<style lang="less" scoped>
.container {
    display: flex;
}

.main-content {
    flex-grow: 1;
    padding: 20px;
}
</style>
