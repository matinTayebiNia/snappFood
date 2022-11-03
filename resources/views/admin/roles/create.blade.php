<x-adminlayoutpanel>

    <div class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">

        <div class="self-start mb-2 text-xl font-light text-gray-800 sm:text-2xl ">
            ثبت نقش جدید
        </div>
        <div class="p-6 mt-8">
            <div class="w-full rounded-lg block">
                <x-errorValidation></x-errorValidation>
                <form action="{{route("admin.roles.store")}}" method="post" class="w-full">
                    @csrf
                    <div class="flex flex-col mb-2 space-y-4">
                        <div class=" relative ">
                            <label for="name" class="mb-2 block font-semibold">نام نقش:</label>
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
                                   name="name" placeholder="نام نقش">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="label" class="mb-2 block font-semibold">توضیحات نقش:</label>
                            <input id="label"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("label")}}"
                                   name="label" placeholder="توضیحات نقش">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="permissions" class="mb-2 block font-semibold">
                                دسترسی ها
                            </label>
                            <select class="js-example-basic-single w-1/2" id="permissions" multiple
                                    name="permissions[]">
                                @foreach(\App\Models\Permission::all() as $permission)
                                    <option
                                        value="{{$permission->id}}"
                                        {{in_array($permission->id,old("permissions")??[])?"selected":""}}>
                                        {{$permission->name}} --- {{$permission->label}}</option>
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
</x-adminlayoutpanel>
