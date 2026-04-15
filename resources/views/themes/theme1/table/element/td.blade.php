<td colspan="{{ $colspan }}" {{ $attributes->merge(['class' => 'p-3 align-top text-sm text-foreground']) }}>
    {{ $data2 ?? '' }}
    {{ $slot }}
</td>