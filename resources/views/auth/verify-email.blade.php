<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="https://scontent.ftru3-1.fna.fbcdn.net/v/t39.30808-6/293164450_353506510296821_5028679871833543578_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeFD4cttxTLclbsoQcOHkIGEoLi0DWyc8iGguLQNbJzyIS2XnMQut1IxosSiVv7juKAyDVYS4iIHSAu62Y8Xsz9b&_nc_ohc=Nz7O8YoQwPwAX8kui5G&_nc_ht=scontent.ftru3-1.fna&oh=00_AT_fl-ufF_4b9zycm1LWJjItgFl4v8_M0daf6R3hzoLURg&oe=62E40E2F" width="150" height="150" class="d-inline-block align-text-top">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
