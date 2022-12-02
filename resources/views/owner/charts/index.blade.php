<x-ownerlayoutpanel>

    <div class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">
        امار امتیازات به غذا در ماه:
        <canvas id="FoodChart" height="150px"></canvas>
    </div>
    <div class="flex mt-8 flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">
        امار امتیازات به رستوران در ماه:
        <canvas id="RestaurantChart" height="150px"></canvas>
    </div>
    <div class="flex mt-8 flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">
        کامنت های تایید شده!
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
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$comments->links()}}
    </div>
    <div class="h-16">

    </div>
    @section("script")
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
            createFoodChart();
            createRestaurantChart();

            function createRestaurantChart() {
                const restaurantMonths = {{ Js::from($RestaurantMonths) }};
                const restaurantAvg = {{ Js::from($RestaurantAvg) }};
                const restaurantData = {
                    labels: restaurantMonths,
                    datasets: [{
                        label: 'امتیاز به رستوران ',
                        backgroundColor: 'rgb(62,83,162)',
                        borderColor: 'rgb(41,45,62)',
                        data: restaurantAvg,
                    }]
                };
                const restaurantConfig = {
                    type: 'line',
                    data: restaurantData,
                    options: {}
                };
                const RestaurantChart = new Chart(
                    document.getElementById("RestaurantChart"),
                    restaurantConfig
                );
            }

            function createFoodChart() {
                const foodMonths = {{ Js::from($FoodMonths) }};
                const foodAvg = {{ Js::from($FoodAvg) }};
                const FoodData = {
                    labels: foodMonths,
                    datasets: [{
                        label: 'امتیاز به غذا ها ',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: foodAvg,
                    }]
                };

                const FoodConfig = {
                    type: 'line',
                    data: FoodData,
                    options: {}
                };

                const FoodChart = new Chart(
                    document.getElementById('FoodChart'),
                    FoodConfig
                );
            }
        </script>
    @endsection
</x-ownerlayoutpanel>
