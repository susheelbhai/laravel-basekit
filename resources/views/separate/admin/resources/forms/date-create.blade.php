<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Date Form | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Date Form" :action="route('admin.forms.simple.store')" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="date" label="Date" type="date" div="1" />
            <x-form.element.input1 name="datetime" label="Date &amp; Time" type="datetime-local" div="1" />
            <x-form.element.input1 name="date_picker" label="Date Picker" type="date-picker" div="1" />
            <x-form.element.input1 name="date_range_picker" label="Date Range Picker" type="date-range-picker" div="1" />
            <x-form.element.input1 name="date_range_picker_expended" label="Date Range Picker Expended" type="date-range-picker-expended" div="1" />
            <x-form.element.input1 name="time_picker" label="Time Picker" type="time-picker" div="1" />
            <x-form.element.input1 name="clock_time_picker" label="Clock Time Picker" type="clock-time-picker" div="1" />
            <x-form.element.input1 name="datetime_picker" label="Date &amp; Time Picker" type="date-time-picker" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
