<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    meta: { type: Object, required: true },
    links: { type: Object, required: true },
});
</script>

<template>
    <nav v-if="meta.last_page > 1" class="mt-8 flex items-center justify-center gap-4">
        <Link
            v-if="links.prev"
            :href="links.prev"
            preserve-scroll
            class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm hover:bg-slate-100"
        >
            Previous
        </Link>
        <span v-else class="rounded-lg border border-slate-200 px-4 py-2 text-sm text-slate-300">
            Previous
        </span>

        <span class="text-sm text-slate-500">
            Page {{ meta.current_page }} of {{ meta.last_page }}
        </span>

        <Link
            v-if="links.next"
            :href="links.next"
            preserve-scroll
            class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm hover:bg-slate-100"
        >
            Next
        </Link>
        <span v-else class="rounded-lg border border-slate-200 px-4 py-2 text-sm text-slate-300">
            Next
        </span>
    </nav>
</template>
