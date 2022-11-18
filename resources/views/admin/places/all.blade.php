<x-adminlayoutpanel>
    <div class="py-8">
        <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
            <h2 class="text-2xl leading-tight">
                مکان ها
            </h2>
            <div class="text-end">
                <form
                    action=""
                    class="flex flex-col md:flex-row w-3/4
                    md:w-full max-w-sm md:space-x-3 space-y-3 md:space-y-0 justify-center"
                    method="get">
                    <div class=" relative ">
                        <input type="text" name="search" id="search" class="rounded-r-lg
                         border-transparent flex-1 appearance-none border border-gray-300
                          w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400
                           shadow-sm text-base focus:outline-none focus:ring-2
                           focus:ring-purple-600 focus:border-transparent" placeholder="جستجو">
                    </div>
                    <button class="flex-shrink-0 px-4 py-2 text-base
                     font-semibold text-white bg-purple-600 rounded-l-lg
                      shadow-md hover:bg-purple-700 focus:outline-none
                      focus:ring-2 focus:ring-purple-500 focus:ring-offset-2
                      focus:ring-offset-purple-200" type="submit">
                        فیلتر
                    </button>
                </form>
            </div>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden bg-white">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            نام رستوران
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            شماره تلفن
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            شماره کارت
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            صاحب رستوران
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            ادرس
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            نوع مکان
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            اقدامات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($places as $place)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$place->name}}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$place->Number}}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$place->account_number}}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{$place->owner->name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{$place->address->state}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @foreach($place->placetypes as $type)
                                    {{$type->name.","}}
                                @endforeach
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex">
                                    @can("edit-discount")
                                        <a href="{{route("admin.places.edit",$place->id)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                                 width="24px" fill="#F9A602">
                                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                <path
                                                    d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"></path>
                                            </svg>
                                        </a>
                                    @endcan
                                    @can("destroy-discount")
                                        <form action="{{route("admin.places.destroy",$place->id)}}" method="post">
                                            @method("DELETE")
                                            @csrf
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                     viewBox="0 0 24 24"
                                                     width="24px" fill="#FF0000">
                                                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                    <path
                                                        d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$places->appends(['search'=>request('search')])->links()}}
            </div>
        </div>
    </div>
</x-adminlayoutpanel>
