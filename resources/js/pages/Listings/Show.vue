<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '../../components/AppLayout.vue';
import { formatDate, formatPrice } from '../../format';

defineProps({
    listing: { type: Object, required: true },
});
</script>

<template>
    <Head :title="listing.address_line_1" />

    <AppLayout :heading="listing.address_line_1" :subheading="`${listing.city}, ${listing.postcode}`">
        <div class="rounded-xl border border-slate-200 bg-white p-8">
            <p class="text-3xl font-bold">{{ formatPrice(listing.price) }}</p>

            <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-medium text-slate-500">Bedrooms</dt>
                    <dd>{{ listing.bedrooms }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-slate-500">Bathrooms</dt>
                    <dd>{{ listing.bathrooms }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-slate-500">Property type</dt>
                    <dd>{{ listing.property_type_label }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-slate-500">Listed</dt>
                    <dd>{{ formatDate(listing.listed_at) ?? '—' }}</dd>
                </div>
            </dl>

            <p class="mt-6 border-t border-slate-100 pt-6 text-sm text-slate-600">
                Marketed by {{ listing.branch.name }} ({{ listing.branch.region }})
            </p>
            <p class="mt-1 text-xs text-slate-400">Ref: {{ listing.reference }}</p>
        </div>

        <Link href="/" class="mt-6 inline-block text-sm text-slate-500 hover:text-slate-900">
            &larr; Back to all listings
        </Link>
    </AppLayout>
</template>
