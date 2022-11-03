<x-adminlayoutpanel>

    <div class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">

        <div class="self-start mb-2 text-xl font-light text-gray-800 sm:text-2xl ">
            ثبت نقش جدید
        </div>
        <div class="p-6 mt-8">
            <div class="w-full rounded-lg block">
                <x-errorValidation></x-errorValidation>
                <form action="{{route("owner.profile.update")}}" method="post" class="w-full">
                    @csrf
                    @method("PATCH")
                    <div class="flex flex-col mb-2 space-y-4">
                        <div class=" relative ">
                            <label for="name" class="mb-2 block font-semibold">نام:</label>
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
                                   value="{{old("name",auth()->user()->name)}}"
                                   name="name" placeholder="نام ">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <div class=" relative ">
                            <label for="email" class="mb-2 block font-semibold">ایمیل:</label>
                            <input id="email" type="email"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("email",auth()->user()->email)}}"
                                   name="email" placeholder="ایمیل">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>

                        <div class=" relative ">
                            <label for="phone" class="mb-2 block font-semibold">شماره موبایل:</label>
                            <input id="phone" type="number"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value="{{old("phone",auth()->user()->phone)}}"
                                   name="phone" placeholder="شماره موبایل">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>

                        <div class=" relative ">
                            <label for="password" class="mb-2 block font-semibold">رمز عبور:</label>
                            <input id="password" type="password"
                                   class="

                                                   rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"
                                   value=""
                                   name="password" placeholder="رمز عبور">
                            <p class=" text-red-700 m-3 font-semibold">

                            </p>
                        </div>
                        <button class="flex-shrink-0 px-4 py-2 text-base
                     font-semibold text-white bg-purple-600 rounded-lg
                      shadow-md hover:bg-purple-700 focus:outline-none
                      focus:ring-2 focus:ring-purple-500 focus:ring-offset-2
                      focus:ring-offset-purple-200" type="submit">
                            ویرایش اطلاعات
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
