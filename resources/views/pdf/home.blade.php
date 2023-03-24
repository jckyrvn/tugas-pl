<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
</head>

<style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #0087c3;
        text-decoration: none;
    }

    body {
        position: relative;
        width: 18cm;
        height: 28cm;
        margin: 0 auto;
        color: #555555;
        background: #ffffff;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-family: SourceSansPro;
    }

    header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #aaaaaa;
    }

    #logo {
        float: left;
        margin-top: 8px;
    }

    #logo img {
        height: 70px;
    }

    #company {
        float: right;
        text-align: right;
    }

    #details {
        margin-bottom: 50px;
    }

    #client {
        padding-left: 6px;
        border-left: 6px solid #0087c3;
        float: left;
    }

    #client .to {
        color: #777777;
    }

    h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
    }

    #invoice {
        float: right;
        text-align: right;
    }

    #invoice h1 {
        color: #0087c3;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0 0 10px 0;
    }

    #invoice .date {
        font-size: 1.1em;
        color: #777777;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
    }

    table th,
    table td {
        /* padding-top: 10px;
        padding-bottom: 10px; */
        padding: 5px;
        background: #eeeeee;
        text-align: center;
        border-bottom: 1px solid #ffffff;
    }

    table th {
        white-space: nowrap;
        font-weight: normal;
    }

    table td {
        text-align: center;
    }

    table td h3 {
        color: #0087c3;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
    }

    table .no {
        color: #ffffff;
        font-size: 1.2em;
        background: #0087c3;
    }

    table .desc {
        text-align: left;
    }

    table .unit {
        background: #dddddd;
    }

    table .qty {}

    table .total {
        background: #0087c3;
        color: #ffffff;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    table tbody tr:last-child td {
        border: none;
    }

    table tfoot td {
        padding: 10px 20px;
        background: #ffffff;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap;
        border-top: 1px solid #aaaaaa;
    }

    table tfoot tr:first-child td {
        border-top: none;
    }

    table tfoot tr:last-child td {
        color: #0087c3;
        font-size: 1.4em;
        border-top: 1px solid #0087c3;
    }

    table tfoot tr td:first-child {
        border: none;
    }

    #thanks {
        font-size: 2em;
        margin-bottom: 50px;
    }

    #notices {
        padding-left: 6px;
        border-left: 6px solid #0087c3;
        font-size: 2em;
    }

    #notices .notice {
        font-size: 2em;
    }

    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #aaaaaa;
        padding: 8px 0;
        text-align: center;
    }
</style>

<body>

    <header class="clearfix">
        <div id="logo">
            {{-- <img src="/images/logo.png"> --}}

            <img
                src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/images/logo.png'))); ?>">
        </div>
        <div id="company">
            <h2 class="name">Invoice By</h2>
            <div>{{ $data3->sellerdetail->name }}</div>
            <div>{{ $data3->sellerdetail->number }}</div>
            <div><a href="mailto:{{ $data3->sellerdetail->email }}">{{ $data3->sellerdetail->email }}</a></div>
            <div>{{ $data3->sellerdetail->merchant_address }}</div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            @foreach ($data2 as $item2)
            <div id="client">
                <div class="to">INVOICE TO:</div>
                <h2 class="name">{{ $item2->userdetail->name }}</h2>
                <div class="address">{{ $item2->userdetail->address }}</div>
                <div class="email"><a href="mailto:{{ $item2->userdetail->email }}">{{ $item2->userdetail->email }}</a>
                </div>
            </div>
            <div id="invoice">
                <h1>INVOICE {{ $item2->id }}</h1>
                <div class="date">Date of Invoice: {{ $item2->created_at }}</div>
                <div class="date">Order Status: {{ $item2->status }}</div>
            </div>
            @endforeach
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">#</th>
                    <th class="unit">Product Name</th>
                    <th class="desc">Description</th>
                    <th class="unit">Subprice</th>
                    <th class="unit">Discount (%)</th>
                    <th class="unit">Price After Disc</th>
                    <th class="qty">Quantity</th>
                    <th class="total">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $num=1;
                @endphp
                @foreach ($data1 as $item1)
                <tr>
                    <td class="no">
                        {{ $num++ }}
                    </td>
                    <td class="unit">{{ $item1->productdetail->name_product }}</td>
                    <td class="desc">
                        {{ $item1->productdetail->description }}
                    </td>
                    <td class="unit">{{ $item1->productdetail->subprice }}</td>
                    <td class="unit">{{ $item1->productdetail->discount }}%/item</td>
                    <td class="unit">{{ $item1->subprice }}</td>
                    <td class="qty">{{ $item1->quantity }}</td>
                    <td class="total">{{ $item1->price }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @foreach ($data2 as $item2)

                    <td colspan="5"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td>Rp. {{ $item2->totalprice }}</td>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>