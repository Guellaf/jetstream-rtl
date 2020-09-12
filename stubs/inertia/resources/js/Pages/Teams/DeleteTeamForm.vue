<template>
    <jet-action-section>
        <template #title>
            حذف تیم
        </template>

        <template #description>
            حذف همیشگی و کامل این تیم
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                به محض حذف تیم، تمام اطلاعات و منابع شما پاک میشود. لطفا در ایتدا از تمام اطلاعات مهم خود نسخه پشتیبان تهیه کنید.
            </div>

            <div class="mt-5">
                <jet-danger-button @click.native="confirmTeamDeletion">
                    حذف تیم
                </jet-danger-button>
            </div>

            <!-- Delete Team Confirmation Modal -->
            <jet-confirmation-modal :show="confirmingTeamDeletion" @close="confirmingTeamDeletion = false">
                <template #title>
                    حذف تیم
                </template>

                <template #content>
                    آیا مطمئنید که میخواهید این تیم را حذف کنید ؟ به محض حذف تیم، تمام اطلاعات و منابع شما پاک میشود.
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="confirmingTeamDeletion = false">
                        بیخیال
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click.native="deleteTeam" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        حذف تیم
                    </jet-danger-button>
                </template>
            </jet-confirmation-modal>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from './../../Jetstream/ActionSection'
    import JetButton from './../../Jetstream/Button'
    import JetConfirmationModal from './../../Jetstream/ConfirmationModal'
    import JetDangerButton from './../../Jetstream/DangerButton'
    import JetSecondaryButton from './../../Jetstream/SecondaryButton'

    export default {
        props: ['team'],

        components: {
            JetActionSection,
            JetButton,
            JetConfirmationModal,
            JetDangerButton,
            JetSecondaryButton,
        },

        data() {
            return {
                confirmingTeamDeletion: false,
                deleting: false,

                form: this.$inertia.form({
                    //
                }, {
                    bag: 'deleteTeam'
                })
            }
        },

        methods: {
            confirmTeamDeletion() {
                this.confirmingTeamDeletion = true
            },

            deleteTeam() {
                this.form.delete('/teams/' + this.team.id, {
                    preserveScroll: true
                });
            },
        },
    }
</script>
