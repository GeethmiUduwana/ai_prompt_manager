<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="flex flex-col items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <span class="mt-3 text-xl font-bold text-gray-800">AI Prompt Manager</span>
            </a>
        </x-slot>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Create an account</h2>
            <p class="mt-1 text-sm text-gray-500">Start managing your AI prompts today</p>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Full Name')" />

                <x-input id="name" class="block mt-1" type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email Address')" />

                <x-input id="email" class="block mt-1" type="email" name="email" :value="old('email')" required placeholder="you@example.com" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="Min. 8 characters" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1"
                                type="password"
                                name="password_confirmation" required
                                placeholder="Re-enter your password" />
            </div>

            <div class="mt-6">
                <x-button>
                    {{ __('Create Account') }}
                </x-button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-500 transition-colors">
                    Sign in
                </a>
            </p>
        </div>
    </x-auth-card>
</x-guest-layout>
