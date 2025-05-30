<template>
    <div class="admin-dashboard">
        <h1>Bienvenue dans le panneau d'administration</h1>
    </div>
</template>

<script>
export default {
    name: 'AdminDashboard'
}
</script>

<style scoped>
.admin-dashboard {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
    background: #f5f6fa;
}

h1 {
    color: #2d3436;
    font-size: 2rem;
    font-weight: bold;
}
</style>