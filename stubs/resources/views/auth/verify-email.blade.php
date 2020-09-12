<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            از عضویت شما ممنونیم. قبل از شروع، باید ایمیل خود را به وسیله ی لینکی که به آن ارسال شده است را فعال کنید.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                لینک فعال سازی به ایمیلی که در ابتدا وارد کرده اید ارسال شد.
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="/email/verification-notification">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        ارسال مجدد ایمیل فعال سازی
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="/logout">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    خروج
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
