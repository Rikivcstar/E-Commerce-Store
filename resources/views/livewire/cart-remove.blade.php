<div>
    <button wire:click='remove()' type="button" class="py-1 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-red-500 ring-red-500 ring-1 focus:outline-hidden focus:bg-red-100 hover:text-red-800 disabled:opacity-50 disabled:pointer-events-none  dark:hover:text-red-800 dark:focus:bg-red-800/30 dark:focus:text-red-400">
    <svg class="w-6 h-6 text-red-500 dark:text-white hover:text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
    </svg>

    <div wire:loading  class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full dark:text-white" role="status" aria-label="loading">
     <span class="sr-only">Loading...</span>
    </div>
</button>
</div>
