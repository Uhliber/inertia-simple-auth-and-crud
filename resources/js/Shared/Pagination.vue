<!-- eslint-disable vue/no-v-html -->
<template>
  <div>
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
      <div class="flex flex-1 justify-between sm:hidden">
        <Link
          :href="pageData.next_page_url"
          :disabled="!pageData.next_page_url"
          class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
        >
          Previous
        </Link>
        <Link
          :href="pageData.prev_page_url"
          :disabled="!pageData.prev_page_url"
          class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
        >
          Next
        </Link>
        <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
        <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
      </div>
      <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700">
            Showing <span class="font-medium">{{ pageData.from }}</span> to <span class="font-medium">{{ pageData.to }}</span> of <span class="font-medium">{{ pageData.total }}</span> results
          </p>
        </div>
        <div>
          <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
            <Component
              :is="link.url ? 'Link' : 'span'"
              v-for="(link, index) in truncatedPaginator"
              :key="index"
              :href="link.url"
              :disabled="!link.url"
              class="relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset"
              :class="[
                link.active ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'text-gray-900 ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0',
                { 'hover:bg-transparent': !link.url },
                { 'px-2 rounded-l-md': link.label.includes('Previous') },
                { 'px-2 rounded-r-md': link.label.includes('Next') },
              ]"
            >
              <template v-if="link.label.includes('Previous')">
                <span class="sr-only">Previous</span>
                <ChevronLeft
                  class="h-5 w-5"
                  :class="{ 'stroke-gray-400': !link.url }"
                  aria-hidden="true"
                />
              </template>
              <template v-else-if="link.label.includes('Next')">
                <span class="sr-only">Next</span>
                <ChevronRight
                  class="h-5 w-5"
                  :class="{ 'stroke-gray-400': !link.url }"
                  aria-hidden="true"
                />
              </template>
              <template v-else>
                {{ link.label }}
              </template>
            </Component>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ChevronLeft, ChevronRight } from "lucide-vue-next";
import { computed } from "vue";

const props = defineProps({
  pageData: {
    type: Object,
    default: () => {}
  }
});

const truncatedPaginator = computed(() => {
  const { pageData } = props;
  const truncateCount = 7;
  const truncateCountLessDefault = truncateCount - 4; // ['Previous', '<first_page>', '<last_page>', 'Next']

  if (pageData.last_page <= truncateCount) {
    return pageData.links;
  }

  const firstTwo = pageData.links.slice(0, 2);
  const lastTwo = pageData.links.slice(-2);
  const firstPage = 1;
  const lastPage = pageData.last_page;
  const isFarFromStart = pageData.current_page > firstPage + 2;
  const isFarFromLast = pageData.current_page < lastPage - 2;
  const strippedArray = pageData.links.slice(2, -2);
  const activeIndex = strippedArray.findIndex(obj => obj.active);

  const strippedStartIndex = 0;
  const strippedLastIndex = strippedArray.length - 1;

  const truncatedPageObj = {
    url: null,
    label: "...",
    active: false,
  };

  let startExcess = 0, lastExcess = 0;
  let startIndex = 0, lastIndex = 0;

  const idxs = getPreviousAndNextIndexes(activeIndex);

  for (let i = 0; i < idxs.length; i++) {
    if (idxs[i] < strippedStartIndex) startExcess++;
    if (idxs[i] > strippedLastIndex) lastExcess++;
  }

  const indexAddCount = truncateCountLessDefault + 1;

  if (pageData.current_page === firstPage) {
    startIndex = strippedStartIndex;
    lastIndex = strippedStartIndex + indexAddCount;
  } else if (pageData.current_page === lastPage) {
    startIndex = strippedLastIndex - indexAddCount;
    lastIndex = strippedLastIndex;
  } else {
    if (startExcess > 0) {
      startIndex = strippedStartIndex;
      lastIndex = strippedStartIndex + indexAddCount;
    } else if (lastExcess > 0) {
      startIndex = strippedLastIndex - indexAddCount;
      lastIndex = strippedLastIndex;
    } else {
      startIndex = idxs[0];
      lastIndex = idxs[indexAddCount];
    }
  }

  const truncatedArray = strippedArray.slice(startIndex, lastIndex + 1);

  if (isFarFromStart) truncatedArray[0] = truncatedPageObj;
  if (isFarFromLast) truncatedArray[truncatedArray.length - 1] = truncatedPageObj;

  return [
    ...firstTwo,
    ...truncatedArray,
    ...lastTwo,
  ];

});

const getPreviousAndNextIndexes = (index) => {
  const indexes = [];
  for (let i = index - 2; i <= index + 2; i++) {
    indexes.push(i);
  }
  return indexes;
};
</script>
