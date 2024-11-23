<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Store Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your store's information such as name and address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('store.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="store_name" :value="__('Store Name')" />
            <x-text-input id="store_name" name="store_name" type="text" class="mt-1 block w-full" :value="old('store_name', $store->store_name)"
                required autofocus autocomplete="store_name" />
            <x-input-error class="mt-2" :messages="$errors->get('store_name')" />
        </div>

        <div>
            <x-input-label for="store_address" :value="__('Store Address')" />
            <x-text-input id="store_address" name="store_address" type="text" class="mt-1 block w-full" :value="old('store_address', $store->store_address)"
                required autofocus autocomplete="store_address" />
            <x-input-error class="mt-2" :messages="$errors->get('store_address')" />
        </div>

        <div>
            <x-input-label for="created_at" :value="__('Created At')" />
            <x-text-input id="created_at" name="created_at" type="text" class="mt-1 block w-full"
                :value="$store->created_at->format('Y-m-d H:i:s')" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('created_at')" />
        </div>

        <div>
            <x-input-label for="updated_at" :value="__('Last Updated At')" />
            <x-text-input id="updated_at" name="updated_at" type="text" class="mt-1 block w-full"
                :value="$store->updated_at->format('Y-m-d H:i:s')" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('updated_at')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'store-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
