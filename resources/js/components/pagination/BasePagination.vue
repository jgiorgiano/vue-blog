<template>
    <div class="flex justify-center py-2">
        <IndigoButton
            :disabled="isPreviousButtonDisabled"
            @clicked="previousPage"
        >
            <v-icon name="arrow-left"></v-icon>
        </IndigoButton>

        <BasePaginationTrigger
            v-for="paginationTrigger in paginationTriggers"
            :key="paginationTrigger"
            class="border-rounded rounded"
            :class="{'bg-gray-300 border-indigo-500 border-b': paginationTrigger === currentPage}"
            :pageNumber="paginationTrigger"
            @loadPage="onLoadPage"
        />

        <IndigoButton :disabled="isNextButtonDisabled" @clicked="nextPage">
            <v-icon name="arrow-right"></v-icon>
        </IndigoButton>
    </div>
</template>

<script>
import BasePaginationTrigger from "./BasePaginationTrigger.vue";
import IndigoButton from "@/components/buttons/IndigoButton";

export default {
    components: {
        IndigoButton,
        BasePaginationTrigger
    },

    props: {
        currentPage: {
            type: Number,
            required: true
        },

        pageCount: {
            type: Number,
            required: true
        },

        visiblePagesCount: {
            type: Number,
            default: 5
        }
    },

    computed: {
        isPreviousButtonDisabled() {
            return this.currentPage === 1;
        },

        isNextButtonDisabled() {
            return this.currentPage === this.pageCount;
        },

        paginationTriggers() {
            const currentPage = this.currentPage;
            const pageCount = this.pageCount;
            const visiblePagesCount = this.pageCount <= 5 ? this.pageCount : this.visiblePagesCount;
            const visiblePagesThreshold = (visiblePagesCount - 1) / 2;
            const pagintationTriggersArray = Array(visiblePagesCount - 1).fill(
                0
            );

            if (currentPage <= visiblePagesThreshold + 1) {
                pagintationTriggersArray[0] = 1;
                const pagintationTriggers = pagintationTriggersArray.map(
                    (paginationTrigger, index) => {
                        return pagintationTriggersArray[0] + index;
                    }
                );

                if(pageCount > 1) {
                    pagintationTriggers.push(pageCount);
                }

                return pagintationTriggers;
            }

            if (currentPage >= pageCount - visiblePagesThreshold + 1) {
                const pagintationTriggers = pagintationTriggersArray.map(
                    (paginationTrigger, index) => {
                        return pageCount - index;
                    }
                );

                pagintationTriggers.reverse().unshift(1);

                return pagintationTriggers;
            }

            pagintationTriggersArray[0] = currentPage - visiblePagesThreshold + 1;
            const pagintationTriggers = pagintationTriggersArray.map(
                (paginationTrigger, index) => {
                    return pagintationTriggersArray[0] + index;
                }
            );

            pagintationTriggers.unshift(1);
            pagintationTriggers[pagintationTriggers.length - 1] = pageCount;

            return pagintationTriggers;
        }
    },

    methods: {
        nextPage() {
            this.$emit("nextPage");
        },

        onLoadPage(value) {
            this.$emit("loadPage", value);
        },

        previousPage() {
            this.$emit("previousPage");
        }
    }
};
</script>
