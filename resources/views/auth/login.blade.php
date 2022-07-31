<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <img src="https://scontent.ftru3-1.fna.fbcdn.net/v/t39.30808-6/293164450_353506510296821_5028679871833543578_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeFD4cttxTLclbsoQcOHkIGEoLi0DWyc8iGguLQNbJzyIS2XnMQut1IxosSiVv7juKAyDVYS4iIHSAu62Y8Xsz9b&_nc_ohc=Nz7O8YoQwPwAX8kui5G&_nc_ht=scontent.ftru3-1.fna&oh=00_AT_fl-ufF_4b9zycm1LWJjItgFl4v8_M0daf6R3hzoLURg&oe=62E40E2F" width="150" height="150" class="d-inline-block align-text-top" alt="Logo CiteCall">
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
