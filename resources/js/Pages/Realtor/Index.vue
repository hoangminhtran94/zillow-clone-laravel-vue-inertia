<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section class="mb-4">
        <RealtorFilter :filters="filters" />
    </section>
    <section
        v-if="listings.data.length > 0"
        class="grid grid-cols-1 lg:grid-cols-2 gap-2"
    >
        <Box
            v-for="listing of listings.data"
            :key="listing.id"
            :class="listing.deleted_at && `border-dashed`"
        >
            <div
                class="flex flex-col md:flex-row gap-2 md:items-center justify-between"
            >
                <div :class="listing.deleted_at && ` opacity-25 `">
                    <div
                        v-if="listing.sold_at != null"
                        class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2"
                    >
                        sold
                    </div>
                    <div class="xl:flex items-center gap-2">
                        <Price
                            :price="listing.price"
                            class="text-2xl font-medium"
                        />
                        <ListingInfo :listing="listing" />
                    </div>

                    <ListingAddress :listing="listing" />
                </div>
                <section>
                    <div
                        class="flex items-center gap-1 text-gray-600 dark:text-gray-300"
                    >
                        <a
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn-outline text-xs font-medium"
                            :href="
                                route(`realtor.listing.show`, {
                                    listing: listing.id,
                                })
                            "
                        >
                            Preview
                        </a>
                        <Link
                            class="btn-outline text-xs font-medium"
                            :href="
                                route(`realtor.listing.edit`, {
                                    listing: listing.id,
                                })
                            "
                        >
                            Edit
                        </Link>
                        <Link
                            v-if="!listing.deleted_at"
                            class="btn-outline text-xs font-medium"
                            :href="
                                route(`realtor.listing.destroy`, {
                                    listing: listing.id,
                                })
                            "
                            as="button"
                            method="delete"
                        >
                            Delete
                        </Link>
                        <Link
                            v-else
                            class="btn-outline text-xs font-medium"
                            :href="
                                route(`realtor.listing.restore`, {
                                    listing: listing.id,
                                })
                            "
                            as="button"
                            method="put"
                        >
                            Restore
                        </Link>
                    </div>
                    <div class="mt-2">
                        <Link
                            :href="
                                route(`realtor.listing.image.create`, {
                                    listing: listing.id,
                                })
                            "
                            class="block w-full btn-outline text-xs font-medium text-center"
                        >
                            Images ({{ listing.images_count }})
                        </Link>
                    </div>
                    <div class="mt-2">
                        <Link
                            :href="
                                route(`realtor.listing.offer.index`, {
                                    listing: listing.id,
                                })
                            "
                            class="block w-full btn-outline text-xs font-medium text-center"
                        >
                            Offers ({{ listing.offers_count }})
                        </Link>
                    </div>
                </section>
            </div>
        </Box>
    </section>
    <PlaceHolderBox v-else>No listings yet</PlaceHolderBox>
    <section v-if="listings.data.length > 0" class="flex justify-center mt-6">
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>
import Box from "../../Components/UI/Box.vue";
import PlaceHolderBox from "../../Components/UI/PlaceHolderBox.vue";
import Price from "../../Components/Price.vue";
import RealtorFilter from "./components/RealtorFilters.vue";
import ListingAddress from "../../Components/ListingAddress.vue";
import ListingInfo from "../../Components/ListingInfo.vue";
import { Link } from "@inertiajs/vue3";
import Pagination from "../../Components/UI/Pagination.vue";
defineProps({ listings: Object, filters: Object });
</script>
