<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden']) }}>
    @if(isset($header))
        <div class="px-6 py-4 border-b">
            {{ $header }}
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-6 py-4 bg-gray-50 border-t">
            {{ $footer }}
        </div>
    @endif
</div>