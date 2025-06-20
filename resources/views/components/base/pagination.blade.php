<div class="mt-6 flex justify-between items-center flex-wrap gap-1 bg-white rounded-full py-2 px-5
    flex-col sm:flex-row sm:py-2 sm:px-5"
    wire:loading.remove>
    <div class="mb-2 sm:mb-0 text-center sm:text-left w-full sm:w-auto">
        <span class="text-sm text-gray-600">
            Page {{ $pagination->currentPage() }} of {{ $pagination->lastPage() }}
            &middot;
            Showing {{ $pagination->firstItem() }}-{{ $pagination->lastItem() }} of {{ $pagination->total() }} results
        </span>
    </div>
    <div class="flex gap-1 sm:gap-2 flex-wrap justify-center w-full sm:w-auto">
        <button wire:click="previousPage" wire:loading.attr="disabled"
            class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full border text-xs sm:text-sm font-medium transition
            {{ $pagination->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white hover:bg-blue-100 text-gray-700' }}">
            ←
        </button>

        @for ($i = 1; $i <= $pagination->lastPage(); $i++)
            @if (
                $pagination->lastPage() <= 5 ||
                    abs($pagination->currentPage() - $i) <= 1 ||
                    $i == 1 ||
                    $i == $pagination->lastPage())
                <button wire:click="gotoPage({{ $i }})" wire:loading.attr="disabled"
                    class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full border text-xs sm:text-sm font-semibold transition-all duration-200
                {{ $pagination->currentPage() === $i
                    ? 'bg-primary text-white border-blue-600 shadow'
                    : 'bg-white text-gray-700 hover:bg-blue-50' }}">
                    {{ $i }}
                </button>
                @if ($i == 1 && $pagination->currentPage() > 3 && $pagination->lastPage() > 5)
                    <span class="px-1 text-gray-400">...</span>
                @endif
                @if (
                    $i == $pagination->currentPage() + 1 &&
                        $pagination->currentPage() < $pagination->lastPage() - 2 &&
                        $pagination->lastPage() > 5)
                    <span class="px-1 text-gray-400">...</span>
                @endif
            @endif
        @endfor

        <button wire:click="nextPage" wire:loading.attr="disabled"
            class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full border text-xs sm:text-sm font-medium transition
            {{ $pagination->hasMorePages() ? 'bg-white hover:bg-blue-100 text-gray-700' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}">
            →
        </button>
    </div>
</div>
