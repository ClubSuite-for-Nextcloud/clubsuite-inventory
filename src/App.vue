<template>
	<div id="content" class="app-inventory">
		<InventoryList />
	</div>
</template>

<script>
import InventoryList from './views/InventoryList.vue'

export default {
	name: 'App',
	components: {
		InventoryList
	}
}
</script>

<style scoped>
.app-inventory {
    height: 100vh;
    overflow-y: auto;
}
</style>
