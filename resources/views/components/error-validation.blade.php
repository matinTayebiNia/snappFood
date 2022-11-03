@if($errors->any())
    <div id="alert1" class="my-3 w-1/2  block  text-right text-white bg-red-500  flex items-center justify-start p-4 rounded-md relative" role="alert">
        @foreach ($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
    </div>
@endif
