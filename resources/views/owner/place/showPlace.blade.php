<x-ownerlayoutpanel>
    <div class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">
        <div class="self-start mb-2 text-xl w-full font-light text-gray-800 sm:text-2xl ">
            <div class="flex items-center  justify-between">
                <div>
                    نام رستوران: {{auth("owner")->user()->place->name}}
                </div>
                <div class="">
                    <a href="{{route("owner.placesOwner.edit",rand(1111,4444))}}"
                       class="p-2 rounded-lg bg-blue-600 text-normal hover:bg-blue-800 text-white  mt-9 mr-4 ">
                       ویرایش مشخصات
                    </a>
                </div>
            </div>


        </div>
        <div class="p-6 mt-8">
            <div class="w-full rounded-lg block space-y-8">
                <div class="flex w-full items-center justify-between">
                    <div>
                        شماره تلفن : {{auth("owner")->user()->place->Number}}
                    </div>
                    <div>
                        شماره کارت : {{auth("owner")->user()->place->account_number}}
                    </div>
                    <div>
                        نوع مکان :
                        @foreach(auth("owner")->user()->place->placetypes as $type)
                            {{$type->name}},
                        @endforeach
                    </div>

                    <div>
                        دسته بندی :
                        @foreach(auth("owner")->user()->place->categories as $type)
                            {{$type->name}},
                        @endforeach
                    </div>

                </div>
                <div class="flex w-full items-center justify-between">

                    <div>
                        استان : {{auth("owner")->user()->place->address->state}}
                    </div>
                    <div>
                        شهر : {{auth("owner")->user()->place->address->city}}
                    </div>
                    <div>
                        خیابان : {{auth("owner")->user()->place->address->street}}
                    </div>
                    <div>

                        پلاک:
                        {{auth("owner")->user()->place->address->pluck}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-ownerlayoutpanel>
