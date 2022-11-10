<x-ownerlayoutpanel>
    <div class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">

        <div class="self-start mb-2 text-xl font-light text-gray-800 sm:text-2xl ">
            ثبت غذا جدید
        </div>
        <div class="p-6 mt-8">
            <div class="w-full rounded-lg block">
                <x-errorValidation></x-errorValidation>
                <form action="{{route("owner.products.store")}}"
                      enctype="multipart/form-data" class="w-full"
                      method="post">
                    @csrf

                    <div class="flex flex-col mb-2 space-y-4">
                        <div class=" relative ">
                            <label for="name" class="mb-2 block font-semibold">نام غذا:</label>
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
                                   name="name" placeholder="نام غذا">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="Basic_cases" class="mb-2 block font-semibold">مواد اولیه:</label>
                            <input id="Basic_cases"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("Basic_cases")}}"
                                   name="Basic_cases" placeholder="مواد اولیه">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="count" class="mb-2 block font-semibold">تعداد:</label>
                            <input id="count" type="number"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("count")}}"
                                   name="count" placeholder="تعداد">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="price" class="mb-2 block font-semibold">قیمت:</label>
                            <input id="price" type="number"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("price")}}"
                                   name="price" placeholder="قیمت">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="image" class="mb-2 block font-semibold">عکس غذا:</label>
                            <input id="image" type="file"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"

                                   name="image" value="{{old("image")}}" placeholder="عکس غذا">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class="relative">
                            <label for="category_id" class="mb-2 block font-semibold">دسته غذا:</label>
                            <select id="category_id"
                                    class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent"
                                    name="category_id">
                                @foreach(\App\Models\Category::where("type","ForFood")->get() as $category)
                                    <option
                                        value="{{$category->id}}" {{old("category_id")==$category->id?"selected":""}}>
                                        {{$category->name}}</option>
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
