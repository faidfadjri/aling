  <div class="p-4">
      <div class="flex mb-5 h-fit">
          <a href="{{ route('profile.address.add') }}" wire:navigate
              class="w-full bg-blue-600 text-white text-sm font-semibold py-2 lg:py-3 rounded-md text-center">
              + Alamat Baru
          </a>
      </div>

      <div class="flex flex-col gap-3">
          @forelse ($addresses as $address)
              <div wire:click="selectAddress({{ $address->id }})"
                  class="cursor-pointer {{ $selectedAddress == $address->id ? 'bg-sky-50 border border-sky-300' : 'bg-white' }} p-4 rounded-md shadow-md flex items-center gap-2 relative transition-all duration-150 hover:ring-1 hover:ring-sky-200">

                  @if ($selectedAddress == $address->id)
                      <div class="absolute left-0 top-4 h-10 w-1 rounded-sm bg-sky-400"></div>
                  @endif

                  <div class="flex-2 w-full">
                      <h2 class="font-semibold text-base capitalize">{{ $address->type }}</h2>
                      <p class="text-sm text-gray-700 mb-5">
                          {{ optional($address->village->district->regency->province)->name ?? '-' }},
                          {{ optional($address->village->district->regency)->name ?? '-' }},
                          {{ optional($address->village->district)->name ?? '-' }},
                          {{ optional($address->village)->name ?? '-' }},
                          {{ $address->description ?? '-' }}
                      </p>
                      <a href="{{ route('profile.address.edit', ['addressID' => $address->id]) }}"
                          class="bg-gray-100 text-sm font-medium py-2 rounded-md text-center px-4 inline-block"
                          onclick="event.stopPropagation()">
                          Ubah Alamat
                      </a>
                  </div>

                  @if ($selectedAddress == $address->id)
                      <div class="text-sky-800">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                          </svg>
                      </div>
                  @endif
              </div>
          @empty
              <p class="italic text-center text-gray-500">Belum ada alamat tersimpan.</p>
          @endforelse
      </div>
  </div>
