<x-ownerlayoutpanel>

    <div class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">

        <div class="self-start mb-2 text-xl font-light text-gray-800 sm:text-2xl ">
            ثبت تخفیف جدید
        </div>
        <div class="p-6 mt-8">
            <div class="w-full rounded-lg block">
                <x-errorValidation></x-errorValidation>
                <form action="{{route("owner.orders.update",$order->id)}}" method="post" class="w-full">
                    @csrf
                    @method("PATCH")
                    <div class="flex flex-col mb-2 space-y-4">
                        <div class=" relative ">
                            <label for="status" class="mb-2 block font-semibold">وضعیت:</label>
                            <select id="status"
                                    class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"

                                    name="status">
                                @foreach($order->getOrderOptions() as $options)
                                    <option value="{{$options}}"
                                        {{old("status",$order->status) == $options ? "selected" : ""}} >
                                        {{$options}}
                                    </option>
                                @endforeach
                            </select>
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>

                        <button class="flex-shrink-0 px-4 py-2 text-base
                     font-semibold text-white bg-purple-600 rounded-lg
                      shadow-md hover:bg-purple-700 focus:outline-none
                      focus:ring-2 focus:ring-purple-500 focus:ring-offset-2
                      focus:ring-offset-purple-200" type="submit">
                            ویرایش
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-ownerlayoutpanel>
