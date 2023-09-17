@foreach($subscription_ended as $sub)
<x-mail::message>
 Hi {{ $sub->name }},

Your Subscription to Verb-Voyage will end today.

Visit Verb-Voyage to subscribe and start Reading awesome books.

Happy Reading&#128525;.<br>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
@endforeach
