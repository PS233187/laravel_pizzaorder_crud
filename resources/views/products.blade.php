<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stonks Pizzas') }}
        </h2>
    </x-slot>
    <div class="container px-12 py-8 mx-auto">
        <h3 class="text-2xl font-bold text-purple-700">Onze Pizza's</h3>
        <div class="h-1 bg-red-500 w-36"></div>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)

            <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-md shadow-md">

                <a href="" type="" id="popup-view">
                    <img src="{{ url($product->image) }}" alt="" class="w-full max-h-60">
                    <div class="flex items-end justify-end w-full bg-cover">

                    </div>

                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $product->name }} {{ $product->size->name }}</h3>
                    
                </a>
                <span id="Product-{{ $product->id }}" class="mt-2 text-gray-500">€{{ $product->price }}</span>
                <form id="form-{{ $product->id }}"  action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $product->id }}" name="id">
                    <input type="hidden" value="{{ $product->name }}" name="name">
                    <input id="FProduct-{{ $product->id }}" type="hidden" value="{{ $product->price }}" name="price">
                    <input type="hidden" value="{{ $product->image }}" name="image">
                    <select onchange="updatePrice('form-{{ $product->id }}', 'Product-{{ $product->id }}', '{{ $product->price }}')" name="size" id="" class="w-56 mb-2">
                        <option value="medium">Medium</option>
                        <option value="small">Klein</option>
                        <option value="large">Groot</option>
                    </select>
                    <input type="number" value="1" min="1" name="quantity" class="w-16">
                    </br>

                    <span class="underline">Extra's :</span></br>



                    @foreach ($product->toppingsNotAttached() as $topping)


                    <input name="toppings[]"
                    class="Product-{{ $product->id }}" onchange="updatePrice('form-{{ $product->id }}', 
                    'Product-{{ $product->id }}', '{{ $product->price }}')" type="checkbox" value="{{ $topping->id }}">
                    <label> {{ $topping->name }} €{{ $topping->price   }}</label></br>
                 
                    @endforeach

                   
                    

                    <button class="px-4 py-1.5 text-white text-sm bg-blue-800 rounded">Voeg toe aan winkelwagen</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</x-app-layout>

<script>
    function updatePrice(formId, priceId, productPrice) {

        // console.log(formId, priceId, productPrice);

        let size = document.querySelector("#"+formId+'>Select').value;
        let checkBoxen = document.querySelectorAll("#"+formId+'>.'+priceId)

        // console.log(size, checkBoxen[0].checked, checkBoxen[1].checked, checkBoxen[2].checked)
        
        let newprice = 0.0;
        if (size == 'medium') {
            newprice = productPrice * 1.0
        } else if (size == 'large') {
            newprice = productPrice * 1.2

        } else {
            newprice = productPrice * 0.8
        }

        for(let i = 0; i < checkBoxen.length; i++){
            if (checkBoxen[i].checked){
                newprice += 1.0;
            }
        }


        document.getElementById(priceId).innerHTML = '€' + newprice.toFixed(2)
        document.getElementById("F" + priceId).value = newprice.toFixed(2)
    }

    // function updatePriceTopping(id, value) {
    //     let oldPriceStringWithEuro = document.getElementById(id).innerText;
    //     let oldPriceString = oldPriceStringWithEuro.substring(1, oldPriceStringWithEuro.length); //euro teken weg halen anders ziet hij het als text 
    //     // door substring.1 begin ik niet bij nul maar bij het getal zelf 
    //     console.log(id, value, oldPriceStringWithEuro, oldPriceString);
    //     let newPrice = oldPriceString * 1.0; //zodat ik zeker weet dat het echt een getal is ipv een string 

</script>