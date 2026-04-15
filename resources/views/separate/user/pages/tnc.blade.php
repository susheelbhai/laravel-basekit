<x-layout.user.app>
    <x-slot name="head">
        <title>Terms and Conditions | {{ config('app.name') }}</title>
    </x-slot>

    <x-container>
        <p class="text-2xl font-bold">{{ $data->title }}</p>
        <p class="mt-2 font-bold">Last Updated: {{ $data->updated_at }}</p>
        <div class="prose prose-neutral mt-6 max-w-none dark:prose-invert">
            {!! $data->content !!}
        </div>
    </x-container>
</x-layout.user.app>
