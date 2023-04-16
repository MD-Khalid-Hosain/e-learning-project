<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>A simple, clean, and responsive HTML invoice template</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="invoice-box">
    <table>
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            Learn Academy
                        </td>

                        <td>
                            Invoice #: {{$paymentDetails->id}}<br />
                            Created: {{ $paymentDetails->created_at->translatedFormat('d, F, Y') }}<br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            Learn Academy<br />
                            Sector 10,<br />
                            Uttara, Dhaka 1230
                        </td>

                        <td>
                            Exam Date: {{ App\ExamEvent::where('id', $paymentDetails->exam_id)->value('exam_date') }}<br />
                            Exam Time: {{\Carbon\Carbon::parse(App\ExamEvent::where('id', $paymentDetails->exam_id)->value('time'))->translatedFormat('g:i A')}}<br />
                            {{ App\Student::where('id', $paymentDetails->student_id)->value('first_name') }} {{ App\Student::where('id', $paymentDetails->student_id)->value('last_name') }}<br />
                            {{ App\Student::where('id', $paymentDetails->student_id)->value('email') }}<br />
                            {{ App\Student::where('id', $paymentDetails->student_id)->value('number') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>

            <td>#</td>
        </tr>

        <tr class="details">
            <td>Card</td>

            <td></td>
        </tr>

        <tr class="heading">
            <td>Exam Title</td>

            <td>Price</td>
        </tr>

        <tr class="item">
            <td>{{ App\ExamEvent::where('id', $paymentDetails->exam_id)->value('exam_title') }}</td>

            <td>Tk {{$paymentDetails->amount}}</td>
        </tr>

        <tr class="total">
            <td></td>

            <td>Total: Tk {{$paymentDetails->amount}}</td>
        </tr>
    </table>
</div>
</body>
</html>
