<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('معلومات الحساب') }}
    </x-slot>

    <x-slot name="description">
        {{ __('قم بتحديث معلومات حسابك وعنوان بريدك الإلكتروني.') }}
    </x-slot>

    <x-slot name="form">
        <!-- صورة الملف الشخصي -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- مدخل اختيار صورة الملف الشخصي -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('الصورة') }}" />

                <!-- صورة الملف الشخصي الحالية -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover">
                </div>

                <!-- معاينة صورة الملف الشخصي الجديدة -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('اختيار صورة جديدة') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('إزالة الصورة') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- الاسم -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('الاسم') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- البريد الإلكتروني -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('البريد الإلكتروني') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 {{ session('theme','light') }}:text-white">
                    {{ __('عنوان بريدك الإلكتروني غير مفعل.') }}

                    <button type="button" class="underline text-sm text-gray-600 {{ session('theme','light') }}:text-gray-400 hover:text-gray-900 {{ session('theme','light') }}:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ session('theme','light') }}:focus:ring-offset-gray-800" wire:click.prevent="sendEmailVerification">
                        {{ __('اضغط هنا لإعادة إرسال رسالة التحقق.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600 {{ session('theme','light') }}:text-green-400">
                        {{ __('تم إرسال رابط التحقق الجديد إلى عنوان بريدك الإلكتروني.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('تم الحفظ.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('حفظ') }}
        </x-button>
    </x-slot>
</x-form-section>
