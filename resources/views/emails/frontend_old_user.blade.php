@component('mail::message')

Hi, <br><br>
Your MRT Laboratories account has been updated and is ready to use.<br>
Please log into MRT Laboratories with your password below:
<br>
Account ID : <b>{{ $mrtId }}</b><br>
Password : <b>{{ $password }}</b><br>
To keep your account secure.

Thank You,<br>
MRT Laboratories

@endcomponent
