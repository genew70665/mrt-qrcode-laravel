@component('mail::message')

Dear <b>{{ $email }},</b><br><br>
Your new MRT Laboratories admin account has been created and is ready to use.<br>
Please log into MRT Laboratories with your credentials below:<br>
Email ID : <b>{{ $email }}</b> 
<br>
Password : <b>{{ $password }}</b><br>
To keep your account secure.

Thank You,<br>
MRT Laboratories

@endcomponent
