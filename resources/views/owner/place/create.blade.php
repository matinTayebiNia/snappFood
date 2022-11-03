<x-ownerlayoutpanel>

    <div class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">

        <div class="self-start mb-2 text-xl font-light text-gray-800 sm:text-2xl ">
            ثبت رستوران جدید
        </div>
        <div class="p-6 mt-8">
            <div class="w-full rounded-lg block">
                <x-errorValidation></x-errorValidation>
                <form action="{{route("owner.placesOwner.store")}}" method="post" class="w-full">
                    @csrf
                    <div class="flex flex-col mb-2 space-y-4">
                        <div class=" relative ">
                            <label for="name" class="mb-2 block font-semibold">نام مکان:</label>
                            <input id="name"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("name")}}"
                                   name="name" placeholder="نام مکان">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="Number" class="mb-2 block font-semibold">تلفن:</label>
                            <input id="Number" type="number"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("Number")}}"
                                   name="Number" placeholder="تلفن">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="account_number" class="mb-2 block font-semibold">شماره سریال:</label>
                            <input id="account_number" type="number"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("account_number")}}"
                                   name="account_number" placeholder="شماره سریال">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="state" class="mb-2 block font-semibold">استان:</label>
                            <input id="state" type="text"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("state")}}"
                                   name="state" placeholder="استان">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="city" class="mb-2 block font-semibold">شهر:</label>
                            <input id="city" type="text"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("city")}}"
                                   name="city" placeholder="شهر">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>

                        <div class=" relative ">
                            <label for="street" class="mb-2 block font-semibold">خیابان:</label>
                            <input id="street" type="text"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("street")}}"
                                   name="street" placeholder="خیابان">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>

                        <div class=" relative ">
                            <label for="pluck" class="mb-2 block font-semibold">پلاک:</label>
                            <input id="pluck" type="text"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("pluck")}}"
                                   name="pluck" placeholder="پلاک">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="types" class="mb-2 block font-semibold">
                                نوع مکان
                            </label>
                            <select class="js-example-basic-single w-1/2" id="types" multiple
                                    name="types[]">
                                @foreach(\App\Models\PlaceType::all() as $type)
                                    <option
                                        value="{{$type->id}}"
                                        {{in_array($type->id,old("types")??[])?"selected":""}}>
                                        {{$type->name}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" relative ">
                            <label for="categories" class="mb-2 block font-semibold">
                                دسته بندی ها
                            </label>
                            <select class="js-example-basic-single w-1/2" id="categories" multiple
                                    name="categories[]">
                                @foreach(\App\Models\Category::all() as $category)
                                    <option
                                        value="{{$category->id}}"
                                        {{in_array($category->id,old("categories")??[])?"selected":""}}>
                                        {{$category->name}} </option>
                                @endforeach
                            </select>
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

    @section("script")
        <script>
            $(document).ready(function () {
                $('.js-example-basic-single').select2();
            });
        </script>
    @endsection
</x-ownerlayoutpanel>
