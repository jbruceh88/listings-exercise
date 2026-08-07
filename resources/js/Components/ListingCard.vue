<script setup>
import { Link } from '@inertiajs/vue3';
import { formatPrice } from '../format';

defineProps({
    listing: { type: Object, required: true },
});
</script>

<template>
    <article
        class="rounded-xl border border-slate-200 bg-white transition hover:shadow-lg focus-within:ring-2 focus-within:ring-slate-900"
    >
        <!--
            The whole card is clickable, but the anchor is what carries the
            interaction so it stays keyboard-reachable and announces properly.
        -->
        <Link :href="`/listings/${listing.id}`" class="block p-4 focus:outline-none">
            <span class="text-xl font-bold">{{ formatPrice(listing.price) }}</span>

            <span class="mt-1 block text-slate-900">
                {{ listing.address_line_1 }}, {{ listing.city }}
            </span>

            <span class="mt-1 block text-sm text-slate-600">
                {{ listing.bedrooms }} bed &middot; {{ listing.bathrooms }} bath &middot;
                {{ listing.property_type_label }}
            </span>

            <span class="mt-3 block text-xs text-slate-400">
                {{ listing.branch.name }} — {{ listing.branch.region }}
            </span>
        </Link>
    </article>
</template>
