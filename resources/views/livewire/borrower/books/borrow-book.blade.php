<div class="bg-gray-5-">
  <x-slot name="header">
    <div class="flex items-center gap-4">
      <a href="/borrower" class="">
        <img src="/images/logo.png" alt="PSU logo" class="h-8">
      </a>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Pangasinan State University Library') }}
      </h2>
    </div>
  </x-slot>


  <div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img src="{{ $book->photo_url }}" alt="{{ $book->title }}" class="w-full h-96 object-cover rounded-md">
        </a>
        <div class="px-5 pb-5">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $book->title }}</h5>
            <p class="text-gray-600 text-justify">{{ $book->description }}</p>
            <div class="flex items-center justify-between mt-4">
                <p class="text-gray-900">Quantity</p>
                <div class="flex items-center">
                    <button class="text-gray-700 bg-gray-200 px-3 py-1 rounded-full" onclick="decreaseQuantity()">-</button>
                    <span id="quantity" class="mx-3 text-lg font-semibold">1</span>
                    <button class="text-gray-700 bg-gray-200 px-3 py-1 rounded-full" onclick="increaseQuantity()">+</button>
                </div>
            </div>
            <div class="flex items-center justify-between mt-4">
                <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-auto">Add to cart</a>
            </div>
        </div>
    </div>
</div>

<script>
    let quantityElement = document.getElementById('quantity');
    let quantity = 1; // Initial quantity

    function increaseQuantity() {
        quantity++;
        updateQuantity();
    }

    function decreaseQuantity() {
        if (quantity > 1) {
            quantity--;
            updateQuantity();
        }
    }

    function updateQuantity() {
        quantityElement.innerText = quantity;
    }
</script>


</div>