<x-mail::message>
    Hi! <br>
    Sender: {{ $lead->email }} <br>
    Name: {{ $lead->name }} <br>
    Message: <br>
    {{ $lead->message }}
    <br>
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
