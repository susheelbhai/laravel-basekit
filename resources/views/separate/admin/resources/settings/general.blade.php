<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> General Setting | {{ config('app.name') }}</title>
    </x-slot>
    
    <x-slot name="page_name">
        General Setting
    </x-slot>

    <x-form.type.standard title="General Setting" action="{{ route('admin.settings.general') }}">
        @method('patch')
        @php
            $squareDarkLogoPath = data_get($setting ?? null, 'square_dark_logo');
            $squareLightLogoPath = data_get($setting ?? null, 'square_light_logo');
            $darkLogoPath = data_get($setting ?? null, 'dark_logo');
            $lightLogoPath = data_get($setting ?? null, 'light_logo');

            $squareDarkLogoUrl = $squareDarkLogoPath ? asset($squareDarkLogoPath) : '';
            $squareLightLogoUrl = $squareLightLogoPath ? asset($squareLightLogoPath) : '';
            $darkLogoUrl = $darkLogoPath ? asset($darkLogoPath) : '';
            $lightLogoUrl = $lightLogoPath ? asset($lightLogoPath) : '';
        @endphp

        <x-form.element.input1
            name="app_name"
            label="App Name"
            type="text"
            :value="old('app_name', data_get($setting ?? null, 'app_name', ''))"
            required="required"
            div="1"
        />

        <x-form.element.input1
            name="short_description"
            label="Description"
            type="textarea"
            :value="old('short_description', data_get($setting ?? null, 'short_description', ''))"
            div="1"
        />

        <x-form.element.input1
            name="address"
            label="Address"
            type="textarea"
            :value="old('address', data_get($setting ?? null, 'address', ''))"
            div="1"
        />

        <div class="col-span-12 grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-form.element.input-img name="square_dark_logo" label="Square Dark Logo" type="photo" :value="$squareDarkLogoUrl" div="1" />
            <x-form.element.input-img name="square_light_logo" label="Square Light Logo" type="photo" :value="$squareLightLogoUrl" div="1" />
        </div>

        <x-form.element.input-img name="dark_logo" label="Dark Logo" type="photo" :value="$darkLogoUrl" div="4" />
        <x-form.element.input-img name="light_logo" label="Light Logo" type="photo" :value="$lightLogoUrl" div="4" />

        <x-form.element.input1 name="phone" label="Phone" type="text" :value="old('phone', data_get($setting ?? null, 'phone', ''))" div="1" />
        <x-form.element.input1 name="email" label="Email" type="text" :value="old('email', data_get($setting ?? null, 'email', ''))" div="1" />

        <x-form.element.input1 name="facebook" label="Facebook" type="text" :value="old('facebook', data_get($setting ?? null, 'facebook', ''))" div="1" />
        <x-form.element.input1 name="twitter" label="Twitter" type="text" :value="old('twitter', data_get($setting ?? null, 'twitter', ''))" div="1" />
        <x-form.element.input1 name="linkedin" label="Linkedin" type="text" :value="old('linkedin', data_get($setting ?? null, 'linkedin', ''))" div="1" />
        <x-form.element.input1 name="instagram" label="Instagram" type="text" :value="old('instagram', data_get($setting ?? null, 'instagram', ''))" div="1" />
        <x-form.element.input1 name="youtube" label="Youtube" type="text" :value="old('youtube', data_get($setting ?? null, 'youtube', ''))" div="1" />
        <x-form.element.input1 name="whatsapp" label="Whatsapp" type="text" :value="old('whatsapp', data_get($setting ?? null, 'whatsapp', ''))" div="1" />
    </x-form.type.standard>
    
</x-layout.admin.app>
