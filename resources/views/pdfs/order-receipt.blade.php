<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        @page {
            margin: 15px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #2c3e50;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
        }

        /* Header Section */
        .header {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #bb976d;
        }

        .header-row {
            width: 100%;
        }

        .company-section {
            float: left;
            width: 60%;
        }

        .invoice-section {
            float: right;
            width: 35%;
            text-align: right;
        }

        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #bb976d;
            margin-bottom: 5px;
        }

        .company-tagline {
            font-size: 11px;
            color: #6c757d;
            font-style: italic;
        }

        .invoice-title {
            font-size: 22px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .invoice-meta {
            font-size: 11px;
            color: #495057;
            line-height: 1.6;
        }

        .clearfix {
            clear: both;
        }

        /* Billing Section */
        .billing-container {
            margin-bottom: 25px;
        }

        .bill-to-section {
            float: left;
            width: 48%;
        }

        .bill-from-section {
            float: right;
            width: 48%;
        }

        .section-header {
            font-size: 13px;
            font-weight: bold;
            color: #bb976d;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #dee2e6;
        }

        .address-name {
            font-weight: bold;
            font-size: 12px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        /* Items Table */
        .items-section {
            margin-bottom: 20px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border: 1px solid #dee2e6;
        }

        .items-table th {
            background-color: #bb976d;
            color: #ffffff;
            padding: 12px 10px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            border-bottom: 1px solid #a08660;
        }

        .items-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #dee2e6;
            font-size: 11px;
            color: #495057;
        }

        .items-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .items-table tbody tr:hover {
            background-color: #f1f3f4;
        }

        .item-description {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .item-details {
            font-size: 10px;
            color: #6c757d;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* Summary Section */
        .summary-section {
            margin-top: 25px;
            margin-bottom: 25px;
        }

        .summary-table {
            width: 45%;
            float: right;
            border-collapse: collapse;
            border: 1px solid #dee2e6;
        }

        .summary-table td {
            padding: 8px 15px;
            font-size: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .summary-label {
            text-align: right;
            color: #495057;
            font-weight: normal;
            background-color: #f8f9fa;
        }

        .summary-value {
            text-align: right;
            font-weight: bold;
            width: 120px;
            color: #2c3e50;
            background-color: #ffffff;
        }

        .total-row {
            background-color: #bb976d;
            color: #ffffff;
        }

        .total-row td {
            font-size: 14px;
            font-weight: bold;
            padding: 12px 15px;
            border-bottom: none;
        }

        /* Payment Info */
        .payment-info {
            margin-top: 30px;
            margin-bottom: 25px;
        }

        .info-grid {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #dee2e6;
        }

        .info-grid th {
            background-color: #f8f9fa;
            padding: 10px 12px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            color: #bb976d;
            width: 25%;
            border: 1px solid #dee2e6;
        }

        .info-grid td {
            padding: 10px 12px;
            font-size: 11px;
            border: 1px solid #dee2e6;
            color: #495057;
            background-color: #ffffff;
        }

        .status-paid {
            color: #28a745;
            font-weight: bold;
            font-size: 12px;
        }

        .status-pending {
            color: #ffc107;
            font-weight: bold;
            font-size: 12px;
        }

        .status-overdue {
            color: #dc3545;
            font-weight: bold;
            font-size: 12px;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            font-size: 10px;
            color: #6c757d;
        }

        .footer-brand {
            font-weight: bold;
            color: #bb976d;
            font-size: 11px;
        }

        /* Professional touches */
        .company-section img {
            max-width: 180px;
            height: auto;
        }

        .invoice-number {
            font-weight: bold;
            color: #bb976d;
        }

        .amount-due {
            color: #bb976d;
            font-weight: bold;
        }

        /* Print optimizations for dompdf */
        @media print {
            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .header,
            .billing-container,
            .items-section,
            .summary-section,
            .payment-info,
            .footer {
                page-break-inside: avoid;
            }
        }

        /* Additional professional styling */
        .highlight-primary {
            color: #bb976d;
            font-weight: bold;
        }

        .text-muted {
            color: #6c757d;
        }

        .border-primary {
            border-color: #bb976d !important;
        }

        .bg-light {
            background-color: #f8f9fa;
        }

        .bg-primary {
            background-color: #bb976d;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-row">
                <div class="company-section">
                    <div class="company-name">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo-light.png'))) }}"
                            width="180">
                    </div>
                    <div class="company-tagline">Premium Furniture & Interior Solutions</div>
                </div>
                <div class="invoice-section">
                    <div class="invoice-title">INVOICE</div>
                    <div class="invoice-meta">
                        <strong>Order Number:</strong> <span
                            class="invoice-number">{{ $record->id }}</span><br>
                        <strong>Date:</strong>
                        {{ Carbon\Carbon::parse($record->created_at)->format('m-d-Y H:i:s') }}<br>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Billing Information -->
        <div class="billing-container">
            <div class="bill-to-section">
                <div class="section-header">BILL TO</div>
                <div>
                    <div class="address-name">
                        {{ $record->customer->name }}
                    </div>
                    Full Address Here <br>
                    <strong>Phone:</strong> {{ $record->customer->phone_number }}<br>
                    <strong>Email:</strong> {{ $record->customer->email }}
                </div>
            </div>
            <div class="bill-from-section">
                <div class="section-header">FROM</div>
                <div>
                    @use('App\Settings\Contact')
                    <div class="address-name">{{ config('app.name') }}</div>
                    {{ app(Contact::class)->address }}<br>

                    <strong>Phone:</strong>
                    @foreach (app(Contact::class)->phone_numbers as $phone)
                        {{ $phone }}<br>
                    @endforeach
                    <strong>Email:</strong>
                    @foreach (app(Contact::class)->emails as $email)
                        {{ $email }}<br>
                    @endforeach
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- Items -->
        <div class="items-section">
            <div class="section-header">ITEMS</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 50%;">Description</th>
                        <th style="width: 12%;" class="text-center">Qty</th>
                        <th style="width: 19%;" class="text-right">Unit Price</th>
                        <th style="width: 19%;" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($record->items as $item)
                        <tr>
                            <td>
                                <div class="item-description">
                                    {{ $item->product->name }}
                                </div>
                                <div class="item-details">
                                    {!! str($item->product->short_description)->toHtmlString() !!}
                                </div>
                            </td>
                            <td class="text-center">
                                {{ $item->quantity }}
                            </td>
                            <td class="text-right">
                                ₱{{ number_format($item->price) }}
                            </td>
                            <td class="text-right">
                                ₱{{ number_format($item->total_price) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="summary-section">
            <table class="summary-table">
                <tr>
                    <td class="summary-label">Subtotal:</td>
                    <td class="summary-value"> ₱{{ number_format($record->overall_total) }}</td>
                </tr>
                <tr>
                    <td class="summary-label">Delivery:</td>
                    <td class="summary-value">₱500.00</td>
                </tr>
                <tr class="total-row">
                    <td class="summary-label">TOTAL :</td>
                    <td class="summary-value amount-due">₱27,604.00</td>
                </tr>
            </table>
            <div class="clearfix"></div>
        </div>

        <!-- Payment Information -->
        <div class="payment-info">
            <div class="section-header">PAYMENT DETAILS</div>
            <table class="info-grid">
                <tr>
                    <th>Payment Method</th>
                    <td>{{ ucwords($record->payment_method) }}</td>
                    <th>Status</th>
                    <td>
                        <span class="status-paid">
                            {{ $record->status->getLabel() }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>
                        Shipping Date
                    </th>
                    <td>
                        {{ $record->shipped_at ? Carbon\Carbon::parse($record->shipped_at)->format('m-d-Y H:i:s') : 'N/A' }}
                    </td>
                    <th>
                        Paid At
                    </th>
                    <td>
                        {{ $record->paid_at ? Carbon\Carbon::parse($record->paid_at)->format('m-d-Y H:i:s') : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <th colspan="1">Special Instructions</th>
                    <td colspan="3">
                        {{ $record->additional_notes }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <span class="footer-brand">Thank you for choosing Place Perfect!</span><br>
            For questions about this invoice, contact us at support@placeperfect.com<br>
            <em>This is a computer-generated invoice. No signature required.</em>
        </div>
    </div>
</body>

</html>
