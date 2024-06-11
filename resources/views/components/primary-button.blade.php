<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline btn-info']) }}>
    {{ $slot }}
</button>
