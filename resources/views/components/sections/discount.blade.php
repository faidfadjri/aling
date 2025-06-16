 <section class="px-4 py-4 my-3 bg-[linear-gradient(to_right,_#0F4FCE,_#0FCEC4)] w-full">
     <div class="flex items-center justify-between mb-4">
         <h2 class="text-xl font-bold text-white flex items-center gap-1">
             🔥 <span>Diskon Spesial</span>
         </h2>
     </div>

     <div class="flex gap-4 overflow-x-auto scrollbar-hide">
         @php
             $promos = [
                 [
                     'promoDisc' => 'Diskon 20%',
                     'promoImage' =>
                         'https://diperpa.badungkab.go.id/storage/olds/diperpa/Cara-Memilih-Daging-Ayam-Potong-Yang-Segar-Dan-Sehat_138302.jpg',
                     'productName' => 'Ayam Broiler Segar',
                     'productPrice' => 'Rp. 30.000/kg',
                     'productOutlet' => 'Outlet A',
                 ],
                 [
                     'promoDisc' => 'Diskon 40%',
                     'promoImage' => 'https://www.sinarpahalautama.com/image-product/img61-1581762923.jpg',
                     'productName' => 'Ayam Broiler Segar',
                     'productPrice' => 'Rp. 50.000/kg',
                     'productOutlet' => 'Outlet A',
                 ],
                 [
                     'promoDisc' => 'Diskon 20%',
                     'promoImage' =>
                         'https://cdn.digitaldesa.com/uploads/marketplace/products/e35997ca4be6711b2085992f33439317.jpeg',
                     'productName' => 'Ayam Broiler Segar',
                     'productPrice' => 'Rp. 30.000/kg',
                     'productOutlet' => 'Outlet A',
                 ],
             ];
         @endphp

         @foreach ($promos as $index => $promo)
             @include('components.cards.promo-card', array_merge($promo, ['index' => $index]))
         @endforeach
     </div>
 </section>
