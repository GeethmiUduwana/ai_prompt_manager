<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full flex justify-center items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-green-600 border border-transparent rounded-xl font-semibold text-sm text-white tracking-wide hover:from-emerald-600 hover:to-green-700 active:from-emerald-700 active:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-25 transition-all duration-200 shadow-lg shadow-emerald-500/30']) }}>
    {{ $slot }}
</button>
