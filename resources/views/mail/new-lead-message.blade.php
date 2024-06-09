<div>
    <h1>Hi!</h1>
    <p>
        You just got a new message from: {{ $lead['email'] }} - {{ $lead['name'] }}
    </p>

    <h3>
        Message:
    </h3>
    <p>
        {{ $lead['message'] }}
    </p>

</div>
