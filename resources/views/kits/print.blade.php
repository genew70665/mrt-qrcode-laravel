{{-- @extends('layouts.main') --}}

{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MRT</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Kanit:wght@800&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");

        body {
            margin: 0;
            padding: 0;
        }

        p {
            margin-top: 9px;
            margin-bottom: 8px;
        }
        .container-fluid{
            width: 816px;
            margin-top: 17px;
            height: 51px;
            margin-left: auto;
            margin-right: auto;
        }
        .container {
            width: 816px;
            /* height: 1061px;
            border: 1px solid black; */
            margin-left: auto;
            margin-right: auto;
        }

        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        /* Create four equal columns that floats next to each other */
        .column {
            float: left;
            margin: 0.3vh 0vh;
            width: 50%;
            padding: 9px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .mrt-card {
            width: 384px;
            height: 192px;
            border: 1px solid black;
            position: relative;
        }

        .mrt-card-id {
            font-size: 10px;
            font-family: 'Nunito', sans-serif;
            padding-right: 7px;
        }

        .mrt-card-id .line1 {
            text-align: right;
        }

        .mrt-card-id p {
            text-align: right;
            line-height: 10px;
        }

        .mrt-card-brand {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 384px;
            height: 50px;
            margin-top: -35px;
        }

        .mrt-card-brand .logo {
            width: 50px;
            height: 50px;
            padding-left: 10px;
            padding-top: 8px;
        }

        .mrt-card-brand .logo-name h1 {
            font-size: 40px;
            line-height: 1px;
            font-family: 'Kanit', sans-serif;
        }

        .mrt-card-brand .logo-name h2 {
            line-height: 1px;
            font-size: 7px;
            letter-spacing: 2px;
            font-weight: 800;
            font-family: 'Nunito', sans-serif;
            margin-top: -13px;
        }

        .mrt-card-brand .mrt-sample {
            font-size: 18px;
            padding-left: 46px;
            padding-top: 22px;
            font-family: sans-serif;
        }

        .mrt-card-detail {
            padding-top: 6px;
            padding-left: 10px;
            font-family: sans-serif;
        }

        .mrt-card-detail table {
            width: 100%;
        }

        .mrt-card-detail td {
            font-size: 9px;
        }

        .mrt-card-detail tr:hover {
            background-color: yellow;
        }

        .mrt-card-detail img {
            width: 100px;
            height: 85px;
            position: absolute;
            top: 102px;
            left: 275px;
        }

        .qr-img {
            width: 90px;
            height: 90px;
            position: absolute;
            top: 97px;
            left: 280px;
        }

        .print-button {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
            display: inline-block;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            border: 1 px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
        }

        .cancel-button{
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            display: inline-block;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            border: 1 px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
        }

        @media print {
            .noPrint {
                display: none;
            }
        }

        /*# sourceMappingURL=main.css.map */

    </style>
</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="noPrint container-fluid">
            <button class="cancel-button noPrint" onclick="window.history.back()">Back</button>
            <button class="print-button noPrint" style="float: right" onclick="window.print()">Print</button>
        </div>
        <main class="container">

            <div>
                @foreach ($kits as $kit)
                <div class="column">

                    <section class="mrt-card">
                        <div class="mrt-card-id">
                            <p class="line1">Kit No. : {{ $kit->kit }}</p>
                            <p>ACCOUNT NUMBER: {{ $kit->user }}</p>
                        </div>

                        <div class="mrt-card-brand">
                            <div><img class="logo" src="{{ asset('images/Icon-App-40x40@3x.png') }}"
                                    alt="logo">
                            </div>

                            <div class="logo-name">
                                <h1>MRT</h1>
                                <h2>LABORATORIES</h2>
                            </div>

                            <div class="mrt-sample">
                                <p>SAMPLE POINT ID: ___</p>
                            </div>
                        </div>


                        <div class="mrt-card-detail">
                            <table>

                                <tr>
                                    <td>SITE :</td>
                                    <td>__________________________________</td>
                                    <td></td>
                                    <td>DATE: _____________</td>

                                </tr>
                                <tr>
                                    <td>AREA :</td>
                                    <td>__________________________________</td>
                                    <td></td>
                                    <td>UNIT: ______________</td>
                                </tr>

                                <tr>

                                </tr>

                                <tr>
                                    <td>EQUIPMENT :</td>
                                    <td>__________________________________</td>

                                </tr>
                                <tr>
                                    <td>DESCRIPTION :</td>
                                    <td>__________________________________</td>

                                </tr>
                                <tr>
                                    <td>FLUID IN USE :</td>
                                    <td>__________________________________</td>

                                </tr>
                                <tr>
                                    <td>LAB TESTS :</td>
                                    <td>__________________________________</td>

                                </tr>
                                <tr>
                                    <td>COMMENTS :</td>
                                    <td>__________________________________</td>

                                </tr>

                            </table>

                            <div class="qr-img">
                                {!! QrCode::size(90)->generate($kit->kit) !!}
                            </div>
                        </div>

                    </section>
                </div>
                @endforeach

            </div>

        </main>
    </div>

</body>
{{-- @endsection --}}

</html>