  @php
      function formatWaNumber($number)
      {
          $number = preg_replace('/\D/', '', $number);

          if (substr($number, 0, 1) === '0') {
              $number = '62' . substr($number, 1);
          }

          if (substr($number, 0, 2) !== '62') {
              $number = '62' . $number;
          }

          return $number;
      }
  @endphp


  <div>
      <div class="w-full bg-sky-700 flex items-center justify-between px-5 py-2">
          <p class="text-white font-semibold">Pesanan partai besar?</p>

          <a href="https://wa.me/{{ formatWaNumber($product->outlet->user->hp) }}" target="_blank"
              class="font-semibold bg-white text-sky-800 px-3 py-1 rounded-sm text-sm hover:bg-transparent hover:text-white border border-white hover:shadow duration-200">
              Hubungi Admin
          </a>
      </div>
      <div class="mx-auto px-5 rounded-lg flex flex-col lg:flex-row items-center shadow-sm overflow-hidden lg:mt-10">
          <div class="mt-5 lg:mt-0 relative flex-1 w-full lg:w-1/2">
              <img src="{{ $product->image }}" alt="{{ $product->name }}"
                  class="w-full h-60 lg:h-80 object-cover rounded-lg">
              <button class="absolute top-2 right-2 text-blue-500">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                      <path
                          d="M7 4h-2l-3 9v2h20v-2l-3-9h-2v-2h-10v2zm0 0v-2h10v2h-10zm1.5 16c-1.105 0-2-.895-2-2h2c0 .552.448 1 1 1s1-.448 1-1h2c0 1.105-.895 2-2 2zm9 0c-1.105 0-2-.895-2-2h2c0 .552.448 1 1 1s1-.448 1-1h2c0 1.105-.895 2-2 2z" />
                  </svg>
              </button>
          </div>
          <div class="flex-1 py-4 px-4 lg:px-6">
              <div class="flex items-center space-x-2">
                  <span class="text-lg font-bold text-gray-800">{{ $product->name }}</span>
              </div>
              <h2 class="text-xl lg:text-2xl font-semibold mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}
                  @if ($product->discount != 0)
                      <span
                          class="line-through text-gray-400">Rp{{ number_format($product->price + $product->price * ($product->discount / 100), 0, ',', '.') }}</span>
                      <span class="text-red-600 text-sm font-semibold">{{ $product->discount }}%</span>
                  @endif
              </h2>
              <p class="text-sm mt-1 flex gap-2 text-black">
                  @if ($product->reviews->isNotEmpty())
                      <span class="flex items-center gap-1">
                          <span class="text-yellow-400">★</span>
                          {{ $product->reviews->count() }}
                          ·
                      </span>
                  @endif
                  <span>
                      {{ $product->orders->count() ?? 0 }} terjual
                  </span>
              </p>
              <p class="text-sm lg:text-md text-black opacity-70 mt-2">{{ $product->description }}</p>
              <hr class="my-4 opacity-20">
              <div class="flex items-center space-x-2">
                  <img class="h-8 w-8 md:h-10 md:w-10 object-cover rounded-full" src="{{ $product->outlet->photo }}"
                      alt="Outlet owner smiling in front of store counter with shelves of products in the background">
                  <h2 class="text-sm md:text-base font-medium">{{ $product->outlet->name }}</h2>
              </div>
          </div>

          <div class="z-90 w-full mt-2 fixed lg:relative lg:flex-1 flex justify-center bottom-0">
              <div
                  class="w-full lg:w-11/12 bg-white lg:rounded-lg shadow-sm border-gray-200 p-5 flex lg:flex-col lg:items-center gap-2">
                  <button
                      class="lg:hidden py-2 flex items-center justify-center gap-2 h-10 w-10 lg:w-full lg:px-4 rounded-lg text-sm bg-green-600 text-white font-semibold cursor-pointer">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                          <path
                              d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                          <path
                              d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                      </svg>
                      <span class="hidden lg:flex">CS Outlet</span>
                  </button>
                  <div class="flex-1 w-auto lg:w-full flex lg:justify-end gap-2">
                      <a class="lg:flex-1 py-2 px-4 w-full lg:w-auto rounded-lg text-sm border border-blue-600 text-blue-600 font-semibold hover:bg-blue-600 hover:text-white duration-300 cursor-pointer lg:min-w-[120px] text-center"
                          href="{{ route('order.checkout.detail', $product->id) }}">
                          Beli Langsung
                      </a>
                      <button
                          class="py-2 px-4 lg:flex-1 w-full h-full lg:w-auto rounded-lg text-sm border border-blue-600 bg-blue-600 text-white font-semibold hover:bg-blue-800 duration-300 cursor-pointer lg:min-w-[120px] relative flex items-center justify-center"
                          wire:click="addToCart('{{ $product->id }}')" wire:loading.attr="disabled"
                          wire:target="addToCart('{{ $product->id }}')">
                          <span wire:loading.remove wire:target="addToCart('{{ $product->id }}')">+ Keranjang</span>
                          <svg wire:loading wire:target="addToCart('{{ $product->id }}')"
                              class="animate-spin h-4 w-4 text-white absolute" xmlns="http://www.w3.org/2000/svg"
                              fill="none" viewBox="0 0 24 24">
                              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                  stroke-width="4"></circle>
                              <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                              </path>
                          </svg>
                      </button>

                  </div>
                  <div class="hidden lg:flex items-center space-x-6 mt-4 text-sm text-gray-800">
                      @if ($product->outlet && $product->outlet->phone != 0)
                          <a href="https://{{ $product->outlet->phone }}"
                              class="flex items-center space-x-2 hover:text-blue-600"
                              onclick="alert('Chat dengan CS Outlet: Halo, ada yang bisa kami bantu?')" type="button">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                  stroke-width="1.5" stroke="currentColor" class="size-4">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                              </svg>
                              <span>CS Outlet</span>
                          </a>
                          <div class="w-px h-5 bg-gray-300"></div>
                      @endif

                      <button class="flex items-center space-x-1 hover:text-green-600" onclick="shareLink()"
                          type="button">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                          </svg>
                          <span>Share</span>
                      </button>
                  </div>
              </div>
          </div>
      </div>
  </div>


  @push('scripts')
      <script>
          function shareLink() {
              const url = window.location.href;
              const title = document.title;
              if (navigator.share) {
                  navigator.share({
                      title: title,
                      url: url
                  });
              } else {
                  navigator.clipboard.writeText(url).then(function() {
                      alert('Link berhasil disalin!');
                  }, function() {
                      alert('Gagal menyalin link.');
                  });
              }
          }
      </script>
  @endpush
