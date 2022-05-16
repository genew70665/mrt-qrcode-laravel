{{-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
    <title>Document</title>
</head> --}}

    @component('mail::message')
    Account ID: {{ $accountID }}<br>
    User Name: {{ $name }}<br>
    User Email: {{ $email }}<br>
    User Company: {{ $company }}<br>
    User Address 1: {{ $address1 }}<br>
    User Address 2: {{ $address2 }}<br>
    User City: {{ $city }}<br>
    User ZIP: {{ $zip }}<br>
    User Notes: {{ $notes }}<br><br>
    <table border="1" style="margin-left: auto;margin-right: auto;width:100%">
        <tr>
            <th>Equipment ID</th>
            <th>Fluid in use</th>
            <th>Identified Equipment</th>
            <th>Kit ID</th>
            <th>Type</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item['point_id'] }}</td>
                <td>{{ $item['fluid_in_use'] }}</td>
                <td>{{ $item['identified_equipment'] }}</td>
                <td>{{ $item['samplecode'] }}</td>
                <td>{{ $item['type'] }}</td>
                <td>{{ $item['description'] }}</td>
                <td>{{ !empty($item['equipment_id']) ? 'Existing' : 'New' }}</td>
            </tr>
        @endforeach
    </table>
    <p></p>
    Thank You,<br>
    MRT Laboratories
    @endcomponent