<template>
	<div class="inventory-container">
		<h2>Inventarliste</h2>
		<div v-if="loading" class="icon-loading">Lade...</div>
        <div v-else-if="error" class="error">{{ error }}</div>
		<table v-else>
			<thead>
				<tr>
					<th>Name</th>
					<th>Seriennummer</th>
					<th>Standort</th>
					<th>Wert (€)</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="item in items" :key="item.id">
					<td>{{ item.name }}</td>
					<td>{{ item.serialNumber }}</td>
					<td>{{ item.location }}</td>
					<td>{{ formatCurrency(item.value) }}</td>
				</tr>
				<tr v-if="items.length === 0">
					<td colspan="4">Keine Einträge gefunden.</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'

export default {
	name: 'InventoryList',
	data() {
		return {
			items: [],
			loading: true,
			error: null
		}
	},
	mounted() {
		this.fetchItems()
	},
	methods: {
		async fetchItems() {
			this.loading = true
            this.error = null
			try {
				const response = await axios.get(generateUrl('/apps/clubsuite-inventory/items'))
				this.items = response.data
			} catch (e) {
				console.error('Fehler beim Laden des Inventars', e)
				this.error = 'Laden fehlgeschlagen: ' + e.message
			} finally {
				this.loading = false
			}
		},
		formatCurrency(cents) {
			if (!cents) return '0,00 €'
			return (cents / 100).toLocaleString('de-DE', { style: 'currency', currency: 'EUR' })
		}
	}
}
</script>

<style scoped>
.inventory-container {
    padding: 20px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    border-bottom: 1px solid #eee;
    text-align: left;
}
.error {
    color: var(--color-error);
    margin-bottom: 10px;
}
</style>
