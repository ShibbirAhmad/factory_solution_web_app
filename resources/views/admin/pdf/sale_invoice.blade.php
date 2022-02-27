<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Print || Invoice</title>


    <style>
        .pull-right.moha_add_inv p {
            line-height: .5;
            ;
        }

        .pull-right.moha_add_inv {
            text-align: left;
            margin-right: 20px;
            margin-left: 20px;
            margin-top: 10px;
        }

        body {
            background: #ddd;
        }

        .print {
            background: #fff;
            padding: 28px;
            display: block;
        }

        .page-break {
            page-break-after: always;
            background-color: #fff;
            padding-bottom: 50px;
            padding-top: 15px;
            margin-bottom: 10px;
            width: 70%;
        }

        .invoice_header_left_section {
            text-align: left;
            width: 55% !important;
        }

        .invoice_header_right_section {
            text-align: center;
            width: 35% !important;
            display: flex;
            flex-direction: column;
        }

        @media print {
            #print {
                display: none;
            }
        }

        .btn-pr {
            text-align: right;
            display: block;
            position: fixed;
            right: 0;
            top: 280px;
        }

        .btn-pr button {
            height: 50px;
        }


        .rotate-logo {
            position: fixed;
            left: 30%;
            top: 20%;
            right: 0;
            bottom: 50%;
            width: 502px;
            font-size: 24px;
            opacity: 0.2;

        }

        .rotate-logo img {
            width: 350px;
        }


        .customer_info_list {
            border: 3px dashed #000;
            margin-top: 30px;
            margin-right: 100px;
            margin-left: 10px;
        }

        .customer_info_list li {
            list-style-type: square;
            padding: 5px 0px;
            text-align: left;
        }

        .current_date {
            margin-right: 170px;
        }

        .company_logo {
            width: 200px;
            margin-left: 20px;
        }

        .v_parent_list {
            list-style-type: none;
        }

        .v_parent_list>li {
            padding: 2px 0px;
        }

        .v_parent {
            padding: 2px 0px;
            width: 100%;
            display: block;
        }

        .v_child {
            float: left;
            width: 25%;
        }

    </style>



</head>

<body>
    <div class="btn-pr">
        <button class="btn btn-success text-center print-button" onclick="allPrint()" id="print"><i
                class="fa fa-print"></i></button>
    </div>

    <div class="container page-break">
        <div class="row justify-content-center break">
            <div class="invoice_header_left_section">
                <ul class="customer_info_list">
                    <li> <strong> Name: {{ $sale->client->name }} </strong> </li>
                    <li> <strong> Mobile: {{ $sale->client->phone }} </strong> </li>
                    <li> <strong> Invoice No: {{ $sale->invoice_no }} </strong> </li>
                </ul>

            </div>
            <div class="invoice_header_right_section">
                <img class="company_logo" src="{{ asset('frontend/image/logo.png') }}" alt="logo">
                <div class="pull-right moha_add_inv">
                    <p>Office: House: 02, Lane: 11, Block: A,</p>
                    <p>Mirpur-11, Dhaka-1216.</p>
                    <p>E-mail: support@mahadizone.com</p>
                    <p>Hot Line: 01635-212121</p>
                    <p class="current_date" style="margin-top: 5px;">
                        <strong> Date: <span style="border:1px solid #ddd"> <?php echo date('d/m/Y'); ?></span> </strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-11 col-md-11 col-lg-offset-1 col-md-offset-1">

                <table class="table table-bordered moha_tbl_inv" style="margin-top: 5px;">

                    <tbody>

                        <tr>
                            <th style="background-color: #04AA6D !important;" class="text-center">#</th>
                            <th style="background-color: #04AA6D !important;" class="text-center">Product</th>
                            <th style="background-color: #04AA6D !important;" class="text-center">Variant</th>
                            <th style="background-color: #04AA6D !important;" class="text-center">Qty</th>
                            <th style="background-color: #04AA6D !important;" class="text-center">Price</th>
                            <th style="background-color: #04AA6D !important;" class="text-center">Amount</th>
                        </tr>
                        @foreach ($sale_items as $k => $item)
                            @php
                                $image = !empty($item->product->image) ? asset(\App\Helper\dynamicFileLink('product') . $item->product->image) : \App\Helper\noImage();
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td class="text-center" style="text-transform: capitalize;">
                                    <br>
                                    <br>
                                    <img height="200" width="200" src="{{ $image }}">
                                    <p> Name: {{ $item->product->name }}</p>
                                    <p> Code: {{ $item->product->code }}</p>

                                </td>

                                <td colspan="4">
                                    <ul class="v_parent_list">
                                        @forelse ($item->variants as $v)
                                            <li>
                                                <div class="v_parent">
                                                    <div class="v_child">
                                                        {{ $v->variant->name }}
                                                    </div>
                                                    <div class="v_child">
                                                        {{ $v->qty }}
                                                    </div>
                                                    <div class="v_child">
                                                        {{ $v->price }}
                                                    </div>
                                                    <div class="v_child">
                                                        {{ $v->qty * $v->price }}
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                        @endforelse

                                    </ul>

                                </td>
                            </tr>
                        @endforeach

                        <tr>
                                <td colspan="5" class="text-right"> Total Quantity = </td>
                                <td> <strong> {{ $total_sale_quantity }} </strong> </td>

                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">Total:</td>
                                <td class="text-right">
                                    <span style="font-weight:bold;font-size:13px;">
                                        {{ $sale->shipping_cost + $sale->total }} TK</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">Discount:</td>
                                <td class="text-right"> {{ $sale->discount }} Tk</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">Paid:</td>
                                <td class="text-right"> {{ $sale->paid }} Tk</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">Amount Due:</td>
                                <td style="font-weight:bold;color:#000;background-color: #04AA6D !important"
                                    class="text-right">
                                    {{ $sale->total - ($sale->paid + $sale->discount)  }}
                                    Tk
                                </td>
                            </tr>

                    </tbody>
                </table>
                <p style="margin-top:-8px;"> <b><i> **No replace will be accepted after 7 days</i></b></p>

                <table style="width:100%;margin-top:-8px;">
                    <tr>
                        <td style="margin-left: 115px;display: block;">
                            <p>
                                Approved by<br>

                                {{ $sale->createdBy->name ?? '' }}

                            </p>
                        </td>

                        <td>Accounts</td>
                    </tr>
                </table>

            </div>
        </div>



    </div>


    <div class="rotate-logo">
        <img src="{{ asset('rotatelogo.png') }}" alt="">
    </div>

    <script>
        function allPrint() {
            window.print();
        };

        window.addEventListener('DOMContentLoaded', (event) => {
            window.print();
        });
    </script>

</body>

</html>
