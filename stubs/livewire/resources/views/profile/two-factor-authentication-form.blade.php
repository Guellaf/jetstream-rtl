<x-jet-action-section>
    <x-slot name="title">
                    احراز هویت دومرحله ای
    </x-slot>

    <x-slot name="description">
        به وسیله احرازهویت دو مرحله ای امنیت حساب کاربری خود را افزایش دهید.
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                شما احرازهویت دومرحله ای را فعال کرده اید.
            @else
                شما احرازهویت دومرحله ای را فعال نکرده اید.
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                 هنگامی گه احرازهویت دومرحله ای را فعال میکنید از شما یک رمز دیگری درخواست میشود که باید از نرم افزار Google Authenticator دریافت نمایید.
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        هم اکنون احرازهویت دومرحله ای برای شما فعال شد. QR code زیر را در نرم افزار Google Authenticator اسکن نمایید.
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        کد بازیابی را در مکانی امن ذخیره کنید. این کد زمانی که دستگاهی که روی آن Google Authenticator نصب است را گم کرده اید به شما کمک میکند تا حساب خود را بازیابی کنید.
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-button type="button" wire:click="enableTwoFactorAuthentication" wire:loading.attr="disabled">
                   فعال
                </x-jet-button>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-secondary-button class="mr-3" wire:click="regenerateRecoveryCodes">
                         تولید مجدد کد بازیابی
                    </x-jet-secondary-button>
                @else
                    <x-jet-secondary-button class="mr-3" wire:click="$toggle('showingRecoveryCodes')">
                          نمایش کدهای بازیابی
                    </x-jet-secondary-button>
                @endif

                <x-jet-danger-button wire:click="disableTwoFactorAuthentication" wire:loading.attr="disabled">
                    غیرفعال
                </x-jet-danger-button>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
