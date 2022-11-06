<x-adminlayoutpanel>

    <div class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">

        <div class="self-start mb-2 text-xl font-light text-gray-800 sm:text-2xl ">
            ثبت تخفیف جدید
        </div>
        <div class="p-6 mt-8">
            <div class="w-full rounded-lg block">
                <x-errorValidation></x-errorValidation>
                <form action="{{route("admin.discounts.store")}}" method="post" class="w-full">
                    @csrf
                    <div class="flex flex-col mb-2 space-y-4">
                        <div class=" relative ">
                            <label for="code" class="mb-2 block font-semibold">کد تخفیف:</label>
                            <input id="code"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("code",\Illuminate\Support\Str::random(6))}}"
                                   name="code" placeholder="کد تخفیف">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="title" class="mb-2 block font-semibold">عنوان تخفیف:</label>
                            <input id="title"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("title")}}"
                                   name="title" placeholder="عنوان تخفیف">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="Discount_amount" class="mb-2 block font-semibold">مقدار تخفیف:</label>
                            <input id="Discount_amount"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("Discount_amount")}}"
                                   name="Discount_amount" placeholder="مقدار تخفیف">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="typeDiscount" class="mb-2 block font-semibold">نوع تخفیف:</label>
                            <select id="typeDiscount"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"

                                   name="typeDiscount" >
                                <option value="none"></option>
                                <option value="money" {{old("typeDiscount")=="money"?"selected":""}} >پول</option>
                                <option value="Percentage" {{old("typeDiscount")=="Percentage"?"selected":""}} >درصد</option>
                            </select>
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="expired_at" class="mb-2 block font-semibold">تاریخ انقضا:</label>
                            <input id="expired_at"
                                    class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                    value="{{old("expired_at")}}" type="date"
                                    name="expired_at" placeholder="تاریخ انقضا">


                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>

                        <button class="flex-shrink-0 px-4 py-2 text-base
                     font-semibold text-white bg-purple-600 rounded-lg
                      shadow-md hover:bg-purple-700 focus:outline-none
                      focus:ring-2 focus:ring-purple-500 focus:ring-offset-2
                      focus:ring-offset-purple-200" type="submit">
                            ثبت
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-adminlayoutpanel>
