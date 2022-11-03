<div class="flex flex-col w-full max-w-md px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10">
    <div class="self-center mb-6 text-xl font-light text-gray-600 sm:text-2xl ">
        {{$formTitle}}
    </div>
    <div class="mt-8">
        <form action="{{$route}}" method="post" autocomplete="off">
            @csrf
            <x-emailTextBox name="email" id="sign-in-email"/>
            <x-passwordTextBox name="password" id="sign-in-password"/>

            <div class="flex w-full">
                <x-PrimaryButton name="loginButton" value="ورود"/>
            </div>
        </form>
    </div>
</div>
