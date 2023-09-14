<x-mail::message>
Hi, {{ $data['name'] }}

Welcome To Verb Voyage,
We are Happy to have here.

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Enjoy with Verb Voyage.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
