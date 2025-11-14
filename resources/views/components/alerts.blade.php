{{-- ✅ Success --}}
@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
        class="flex items-center justify-between gap-2 rounded-xl border border-green-400 bg-green-50 text-green-800 px-5 py-4 shadow-sm mb-4">
        <div class="flex items-center gap-2">
            <span class="text-xl">✅</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-sm hover:opacity-70">✖</button>
    </div>
@endif

{{-- ℹ️ Info --}}
@if (session('info'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
        class="flex items-center justify-between gap-2 rounded-xl border border-yellow-400 bg-yellow-50 text-yellow-800 px-5 py-4 shadow-sm mb-4">
        <div class="flex items-center gap-2">
            <span class="text-xl">ℹ️</span>
            <span class="font-medium">{{ session('info') }}</span>
        </div>
        <button @click="show = false" class="text-sm hover:opacity-70">✖</button>
    </div>
@endif

{{-- ❌ Error --}}
@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
        class="flex items-center justify-between gap-2 rounded-xl border border-red-400 bg-red-50 text-red-800 px-5 py-4 shadow-sm mb-4">
        <div class="flex items-center gap-2">
            <span class="text-xl">❌</span>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
        <button @click="show = false" class="text-sm hover:opacity-70">✖</button>
    </div>
@endif
