<div>
    @if (count($stories) > 0)
        <div class="w-full px-4">
            <!-- Stories Container -->
            <div class="flex space-x-3 overflow-x-auto scrollbar-hide p-4 bg-white rounded-xl shadow-md">
                @forelse($stories as $index => $story)
                    <div wire:click="openStory({{ $index }})"
                        class="flex-shrink-0 cursor-pointer transform transition-transform hover:scale-105">
                        <div class="relative">
                            <!-- Story Image -->
                            <div
                                class="w-20 h-20 rounded-full bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 p-0.5">
                                <div class="w-full h-full rounded-full bg-white p-0.5">
                                    <img src="{{ Storage::disk('public')->url($story['content']) }}"
                                        alt="Story by {{ $story['user']['name'] }}"
                                        class="w-full h-full rounded-full object-cover">
                                </div>
                            </div>

                            <!-- User Name -->
                            <p class="text-xs text-center mt-1 font-medium text-gray-700 truncate w-20">
                                {{ $story['user']['name'] }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="flex items-center justify-center w-full py-8">
                        <p class="text-gray-500">Belum ada story yang tersedia</p>
                    </div>
                @endforelse
            </div>

            <!-- Story Viewer Modal -->
            @if ($selectedStory)
                <div class="fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center"
                    wire:click="closeStory">
                    <div class="relative max-w-md w-full mx-4" wire:click.stop>
                        <!-- Story Header -->
                        <div class="absolute top-0 left-0 right-0 z-10 p-4">
                            <!-- Progress Bars -->
                            <div class="flex space-x-1 mb-3">
                                @for ($i = 0; $i < count($stories); $i++)
                                    <div class="flex-1 h-0.5 bg-white bg-opacity-30 rounded-full overflow-hidden">
                                        <div
                                            class="h-full bg-white transition-all duration-300 {{ $i < $currentIndex ? 'w-full' : ($i == $currentIndex ? 'w-full animate-pulse' : 'w-0') }}">
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <!-- User Info -->
                            <div class="flex items-center justify-between text-white">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-400 to-pink-500 p-0.5">
                                        <div class="w-full h-full rounded-full bg-white p-0.5">
                                            <div class="w-full h-full rounded-full bg-gray-300"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm">{{ $selectedStory['user']['name'] }}</h3>
                                        <p class="text-xs opacity-75">
                                            {{ \Carbon\Carbon::parse($selectedStory['created_at'])->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Close Button -->
                                <button wire:click="closeStory"
                                    class="w-8 h-8 rounded-full bg-black bg-opacity-50 flex items-center justify-center hover:bg-opacity-70 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Story Content -->
                        <div class="relative bg-black rounded-lg overflow-hidden aspect-[9/16] max-h-[70vh]">
                            <img src="{{ Storage::disk('public')->url($selectedStory['content']) }}" alt="Story"
                                class="w-full h-full object-cover">

                            <!-- Navigation Areas -->
                            @if ($currentIndex > 0)
                                <div wire:click="prevStory"
                                    class="absolute left-0 top-0 w-1/3 h-full cursor-pointer z-20">
                                </div>
                            @endif

                            @if ($currentIndex < count($stories) - 1)
                                <div wire:click="nextStory"
                                    class="absolute right-0 top-0 w-1/3 h-full cursor-pointer z-20">
                                </div>
                            @endif
                        </div>

                        <!-- Navigation Arrows -->
                        @if ($currentIndex > 0)
                            <button wire:click="prevStory"
                                class="absolute left-2 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-black bg-opacity-50 rounded-full flex items-center justify-center text-white hover:bg-opacity-70 transition z-30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7">
                                    </path>
                                </svg>
                            </button>
                        @endif

                        @if ($currentIndex < count($stories) - 1)
                            <button wire:click="nextStory"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-black bg-opacity-50 rounded-full flex items-center justify-center text-white hover:bg-opacity-70 transition z-30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Auto-advance story setiap 5 detik -->
            @if ($selectedStory)
                <script>
                    let storyTimer = setInterval(() => {
                        @this.call('nextStory');
                    }, 5000);

                    // Clear timer ketika modal ditutup
                    document.addEventListener('livewire:update', () => {
                        if (!@this.selectedStory) {
                            clearInterval(storyTimer);
                        }
                    });
                </script>
            @endif

            <style>
                .scrollbar-hide {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }

                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }

                @keyframes progress {
                    0% {
                        width: 0%;
                    }

                    100% {
                        width: 100%;
                    }
                }

                .animate-progress {
                    animation: progress 5s linear;
                }
            </style>

        </div>
    @endif
</div>
