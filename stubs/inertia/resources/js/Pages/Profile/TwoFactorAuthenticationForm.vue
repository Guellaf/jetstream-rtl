<template>
    <jet-action-section>
        <template #title>
            احراز هویت دومرحله لی
        </template>

        <template #description>
            به وسیله احرازهویت دو مرحله ای امنیت حساب کاربری خود را افزایش دهید.
            Add additional security to your account using two factor authentication.
        </template>

        <template #content>
            <h3 class="text-lg font-medium text-gray-900" v-if="twoFactorEnabled">
                شما احرازهویت دومرحله ای را فعال کرده اید.
            </h3>

            <h3 class="text-lg font-medium text-gray-900" v-else>
                شما احرازهویت دومرحله ای را فعال نکرده اید.
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    هنگامی گه احرازهویت دومرحله ای را فعال میکنید از شما یک رمز دیگری درخواست میشود که باید از نرم افزار Google Authenticator دریافت نمایید.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            هم اکنون احرازهویت دومرحله ای برای شما فعال شد. QR code زیر را در نرم افزار Google Authenticator اسکن نمایید.
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode">
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            کد بازیابی را در مکانی امن ذخیره کنید. این کد زمانی که دستگاهی که روی آن Google Authenticator نصب است را گم کرده اید به شما کمک میکند تا حساب خود را بازیابی کنید.
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in recoveryCodes">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <jet-button type="button" @click.native="enableTwoFactorAuthentication"
                                        :class="{ 'opacity-25': enabling }"
                                        :disabled="enabling">
                        فعال
                    </jet-button>
                </div>

                <div v-else>
                    <jet-secondary-button class="mr-3"
                                    @click.native="regenerateRecoveryCodes"
                                    v-if="recoveryCodes.length > 0">
                        تولید مجدد کد بازیابی
                    </jet-secondary-button>

                    <jet-secondary-button class="mr-3"
                                @click.native="showRecoveryCodes"
                                v-else>
                        نمایش کدهای بازیابی
                    </jet-secondary-button>

                    <jet-danger-button @click.native="disableTwoFactorAuthentication"
                                    :class="{ 'opacity-25': disabling }"
                                    :disabled="disabling">
                        غیرفعال
                    </jet-danger-button>
                </div>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from './../../Jetstream/ActionSection'
    import JetButton from './../../Jetstream/Button'
    import JetDangerButton from './../../Jetstream/DangerButton'
    import JetSecondaryButton from './../../Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionSection,
            JetButton,
            JetDangerButton,
            JetSecondaryButton,
        },

        data() {
            return {
                enabling: false,
                disabling: false,

                qrCode: null,
                recoveryCodes: [],
            }
        },

        methods: {
            enableTwoFactorAuthentication() {
                this.enabling = true

                this.$inertia.post('/user/two-factor-authentication', {}, {
                    preserveScroll: true,
                }).then(() => {
                    return Promise.all([
                        this.showQrCode(),
                        this.showRecoveryCodes()
                    ])
                }).then(() => {
                    this.enabling = false
                })
            },

            showQrCode() {
                return axios.get('/user/two-factor-qr-code')
                        .then(response => {
                            this.qrCode = response.data.svg
                        })
            },

            showRecoveryCodes() {
                return axios.get('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.recoveryCodes = response.data
                        })
            },

            regenerateRecoveryCodes() {
                axios.post('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.showRecoveryCodes()
                        })
            },

            disableTwoFactorAuthentication() {
                this.disabling = true

                this.$inertia.delete('/user/two-factor-authentication', {
                    preserveScroll: true,
                }).then(() => {
                    this.disabling = false
                })
            },
        },

        computed: {
            twoFactorEnabled() {
                return ! this.enabling && this.$page.user.two_factor_enabled
            }
        }
    }
</script>
