<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="https://scontent.ftru3-1.fna.fbcdn.net/v/t39.30808-6/293164450_353506510296821_5028679871833543578_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeFD4cttxTLclbsoQcOHkIGEoLi0DWyc8iGguLQNbJzyIS2XnMQut1IxosSiVv7juKAyDVYS4iIHSAu62Y8Xsz9b&_nc_ohc=Nz7O8YoQwPwAX8kui5G&_nc_ht=scontent.ftru3-1.fna&oh=00_AT_fl-ufF_4b9zycm1LWJjItgFl4v8_M0daf6R3hzoLURg&oe=62E40E2F" width="150" height="150" class="d-inline-block align-text-top">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
