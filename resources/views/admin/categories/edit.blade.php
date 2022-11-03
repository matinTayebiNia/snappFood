<x-adminlayoutpanel>

    <div class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">

        <div class="self-start mb-2 text-xl font-light text-gray-800 sm:text-2xl ">
            ثبت دسته بندی جدید
        </div>
        <div class="p-6 mt-8">
            <div class="w-full rounded-lg block">
                <x-errorValidation></x-errorValidation>
                <form action="{{route("admin.categories.update",$category->id)}}" enctype="multipart/form-data"
                      class="w-full"
                      method="post">
                    @csrf
                    @method("PATCH")
                    <div class="flex flex-col mb-2 space-y-4">
                        <div class=" relative ">
                            <label for="name" class="mb-2 block font-semibold">نام دسته بندی:</label>
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
                                   value="{{old("name",$category->name)}}"
                                   name="name" placeholder="نام دسته بندی">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="slug" class="mb-2 block font-semibold">نمایه:</label>
                            <input id="slug"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("slug",$category->slug)}}"
                                   name="slug" placeholder="نمایه">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="icon" class="mb-2 block font-semibold">عکس دسته بندی:</label>
                            <input id="icon" type="file"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"

                                   name="icon" value="{{old("icon",$category->icon)}}" placeholder="عکس دسته بندی">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class="relative">
                            <label for="parent_id" class="mb-2 block font-semibold">زیردسته:</label>
                            <select id="parent_id"
                                    class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"

                                    name="parent_id">
                                <option value="0">دسته بندی اصلی</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option
                                        value="{{$category->id}}" {{old("parent_id",$category->parent_id) == $category->id ? "selected": ""}}>
                                        {{$category->name}}</option>
                                @endforeach
                            </select>
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class="relative">

                            <label for="type" class="mb-2 block font-semibold">نوع دسته بندی:</label>
                            <select id="type"
                                    class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"

                                    name="type">
                                <option value=""></option>
                                <option
                                    value="ForRestaurant" {{old("type",$category->type)=="ForRestaurant"?"selected":""}} >
                                    برای
                                    رستوران
                                </option>
                                <option value="ForFood" {{old("type",$category->type)=="ForFood"?"selected":""}} >برای
                                    غذا
                                </option>
                            </select>
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>

                        <div class=" relative ">
                            <label for="placetype_id" class="mb-2 block font-semibold">دسته بندی برای چه مکانی استفاده
                                میشود</label>

                            <select class="js-example-basic-single w-1/2" id="placetype_id" multiple
                                    name="placetype_id[]">

                                @foreach(\App\Models\PlaceType::all() as $type)
                                    <option
                                        value="{{$type->id}}" {{in_array($type->id,$category->placeTypes->pluck('id')->toArray()) ? "selected" :""}}>
                                        {{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative">

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


    @section("script")
        <script>
            $(document).ready(function () {
                $('.js-example-basic-single').select2();
            });
        </script>
    @endsection
</x-adminlayoutpanel>


