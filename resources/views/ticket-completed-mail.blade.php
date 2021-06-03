<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h3>Hi, {{ $contact->first_name }}!</h3>
<p>We want to inform you that your agent <b>{{ $contact->user->name }}</b> has resolve your ticket #{{  $ticketId }}.</p>
<p>Ticket details:<br><br>
    <i>Type:</i> {{ $contact->tickets()->latest()->first()->ticket_type->description }}<br>
    <i>Title:</i> {{ $contact->tickets()->latest()->first()->title }}<br>
    <i>Description:</i> {{ $contact->tickets()->latest()->first()->description }}</p>
<p>We hope you will be satisfied with our solution.</p>

Kind regards,<br>
TicketingApp@theFitz99
</body>
</html>
