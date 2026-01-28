<script setup>
import { ref, onMounted } from 'vue'

const items = ref([])
const total = ref(0)
const limit = ref(20)
const offset = ref(0)

async function load() {
  const params = new URLSearchParams({ limit: String(limit.value), offset: String(offset.value) })
  const res = await fetch('/index.php/apps/clubsuite-inventory/api/items?' + params.toString())
  const data = await res.json()
  items.value = data.rows
  total.value = data.total
}

function next() {
  if (offset.value + limit.value < total.value) { offset.value += limit.value; load(); }
}
function prev() {
  if (offset.value >= limit.value) { offset.value -= limit.value; load(); }
}

onMounted(load)
</script>

<template>
  <div>
    <div>
      <button @click="prev">Prev</button>
      <button @click="next">Next</button>
      <span>Showing {{ items.length }} of {{ total }}</span>
    </div>
    <ul>
      <li v-for="it in items" :key="it.id">{{ it.name }} - {{ it.category_id }}</li>
    </ul>
  </div>
</template>
