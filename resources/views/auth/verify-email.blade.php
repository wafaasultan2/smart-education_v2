<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 {{ session('theme','light') }}:text-gray-400">
            {{ __('قبل المتابعة، هل يمكنك التحقق من عنوان بريدك الإلكتروني من خلال النقر على الرابط الذي أرسلناه إليك للتو؟ إذا لم تستلم البريد الإلكتروني، سنرسل لك رابطًا آخر بكل سرور.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 {{ session('theme','light') }}:text-green-400">
                {{ __('تم إرسال رابط تحقق جديد إلى عنوان البريد الإلكتروني الذي قدمته في إعدادات ملفك الشخصي.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button type="submit">
                        {{ __('إعادة إرسال بريد التحقق') }}
                    </x-button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 {{ session('theme','light') }}:text-gray-400 hover:text-gray-900 {{ session('theme','light') }}:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ session('theme','light') }}:focus:ring-offset-gray-800"
                >
                    {{ __('تعديل الملف الشخصي') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 {{ session('theme','light') }}:text-gray-400 hover:text-gray-900 {{ session('theme','light') }}:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ session('theme','light') }}:focus:ring-offset-gray-800 ms-2">
                        {{ __('تسجيل الخروج') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
