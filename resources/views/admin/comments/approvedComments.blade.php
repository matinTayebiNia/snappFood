<x-adminlayoutpanel>
    <div class="py-8">
        <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
            <h2 class="text-2xl leading-tight">
                تخفیف ها
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

                <div class="flex">
                    @can("show-unapproved")
                        <a href="{{route("admin.comments.unapproved")}}"
                           class="p-3 rounded-lg bg-blue-600 hover:bg-blue-800 text-white  mt-9 mr-4 ">
                            نظرات تایید نشده
                        </a>
                    @endcan
                </div>

                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            کاربر
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            کامنت
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            مربوط به
                        </th>

                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                            اقدامات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$comment->user->name}}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$comment->comment}}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$comment->commentable->name}}

                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex">

                                    @can("destroy-comments")
                                        <form action="{{route("admin.comments.destroy",$comment->id)}}" method="post">
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
                {{$comments->appends(['search'=>request('search')])->links()}}
            </div>
        </div>
    </div>
</x-adminlayoutpanel>
