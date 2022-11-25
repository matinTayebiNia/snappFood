<x-ownerLayoutPanel>

    @foreach($unreadNotifications as $notification)
        <form id="form-read-notification-{{$notification->id}}"
              action="{{route("owner.notification.read",$notification->id)}}" method="post">
            @method("PATCH")
            @csrf
        </form>
        <div id="alert1"
             class="my-3  block  text-left text-white bg-green-500 h-12 flex items-center justify-center p-4 rounded-md relative"
             role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 class="flex-shrink-0 w-6 h-6 mx-2 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
            شما یک سفارش از طرف {{$notification->data["name"]}} دارید با ایمیل {{$notification->data["email"]}}
            <a href="#"
               onclick="event.preventDefault();
               document.getElementById('form-read-notification-{{$notification->id}}').submit()"
               class="mr-8">مارک کردن اعلان به عنوان دیده شدن</a>
            <button onclick="closeAlert()"
                    class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-3 mr-6 outline-none focus:outline-none">
                <span>×</span>
            </button>
        </div>
    @endforeach

    @section("script")
        <script>
            function closeAlert() {
                var element = document.getElementById("alert1");
                element.classList.add("hidden");
            }
        </script>
    @endsection
</x-ownerLayoutPanel>
