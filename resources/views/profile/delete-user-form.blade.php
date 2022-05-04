<x-jet-action-section>
    <x-slot name="title">
        {{ __('Удалить аккаунт') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Вы можете навсегда удалить свой аккаунт.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Как только Ваша учетная запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно. Перед удалением Вашей учетной записи, пожалуйста, сохраните любые данные или информацию, которые Вы хотите сохранить.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Удалить аккаунт') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Удалить аккаунт') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Вы уверены что хотите удалить аккаунт? Как только Ваша учетная запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно. Пожалуйста, введите Ваш пароль для подтверждения удаления аккаунта.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Пароль') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Отмена') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Удалить аккаунт') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
