<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h3>Hi, {{ $contact->first_name }}!</h3>
<p>Your agent <b>{{ $contact->user->name }}</b> has created a new ticket for you.</p>
<p>Ticket details:<br><br>
<i>Type:</i> {{ $contact->tickets()->latest()->first()->ticket_type->description }}<br>
<i>Title:</i> {{ $contact->tickets()->latest()->first()->title }}<br>
<i>Description:</i> {{ $contact->tickets()->latest()->first()->description }}</p>
<p>We will try to solve your ticket as soon as possible.</p>

Kind regards,<br>
TicketingApp@theFitz99
</body>
</html>
