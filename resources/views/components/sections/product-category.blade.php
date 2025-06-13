 <section class="px-4 py-6">
     <div class="flex items-center justify-between mb-4 w-full">
         @php
             $tabs = [
                 ['label' => 'Ayam Potong', 'value' => 'potong'],
                 ['label' => 'Ayam Kampung', 'value' => 'kampung'],
                 ['label' => 'Ayam Utuh', 'value' => 'utuh'],
             ];
         @endphp
         <div class="flex w-full overflow-y-hidden overflow-x-auto space-x-6" id="product-tabs">
             @foreach ($tabs as $index => $tab)
                 <button
                     class="tab-button pb-2 {{ $index === 0 ? 'font-semibold border-b-2 border-black' : 'text-gray-600 hover:text-black' }} whitespace-nowrap"
                     data-tab="{{ $tab['value'] }}">
                     {{ $tab['label'] }}
                 </button>
             @endforeach
         </div>
         <button class="w-6 h-6 mb-2 bg-black text-white rounded-full flex items-center justify-center">
             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
             </svg>
         </button>
     </div>

     <div id="product-lists">
         <div class="product-tab flex gap-4 w-full overflow-x-auto" data-tab="potong">
             @foreach (range(1, 3) as $item)
                 @include('components.cards.productCategoryCard', [
                     'productImage' =>
                         'https://diperpa.badungkab.go.id/storage/olds/diperpa/Cara-Memilih-Daging-Ayam-Potong-Yang-Segar-Dan-Sehat_138302.jpg',
                     'productName' => 'Ayam Potong 1KG',
                     'productPrice' => 'Rp. 30.000',
                     'productOutlet' => 'Outlet Banyumas',
                     'promoDisc' => 'Diskon 10%',
                 ])
             @endforeach
         </div>

         <div class="product-tab hidden flex gap-4 overflow-x-auto" data-tab="kampung">
             @foreach (range(1, 5) as $item)
                 @include('components.cards.productCategoryCard', [
                     'productImage' =>
                         'https://diperpa.badungkab.go.id/storage/olds/diperpa/Cara-Memilih-Daging-Ayam-Potong-Yang-Segar-Dan-Sehat_138302.jpg',
                     'productName' => 'Ayam Potong 1KG',
                     'productPrice' => 'Rp. 30.000',
                     'productOutlet' => 'Outlet Banyumas',
                     'promoDisc' => 'Diskon 10%',
                 ])
             @endforeach
         </div>

         <div class="product-tab hidden flex gap-4 overflow-x-auto" data-tab="utuh">
             @foreach (range(1, 1) as $item)
                 @include('components.cards.productCategoryCard', [
                     'productImage' =>
                         'https://diperpa.badungkab.go.id/storage/olds/diperpa/Cara-Memilih-Daging-Ayam-Potong-Yang-Segar-Dan-Sehat_138302.jpg',
                     'productName' => 'Ayam Potong 1KG',
                     'productPrice' => 'Rp. 30.000',
                     'productOutlet' => 'Outlet Banyumas',
                     'promoDisc' => 'Diskon 10%',
                 ])
             @endforeach
         </div>
     </div>
 </section>

 <!-- JS -->
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const tabButtons = document.querySelectorAll(".tab-button");
         const tabContents = document.querySelectorAll(".product-tab");

         tabButtons.forEach(button => {
             button.addEventListener("click", () => {
                 const target = button.dataset.tab;

                 // Ganti aktif tab style
                 tabButtons.forEach(btn => btn.classList.remove("font-semibold", "border-b-2",
                     "border-black"));
                 button.classList.add("font-semibold", "border-b-2", "border-black");

                 // Ganti konten produk
                 tabContents.forEach(content => {
                     if (content.dataset.tab === target) {
                         content.classList.remove("hidden");
                     } else {
                         content.classList.add("hidden");
                     }
                 });
             });
         });
     });
 </script>
