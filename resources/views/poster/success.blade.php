<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poster Registration - Step 3</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome (icons) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: radial-gradient(1200px 600px at 20% -10%, rgba(47, 160, 221, .18), transparent 60%),
                radial-gradient(900px 600px at 110% 10%, rgba(255, 152, 25, .10), transparent 55%),
                #f6f8fb;
        }

        .wrap {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 16px;
        }

        .panel {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(16, 24, 40, .08);
            padding: 24px;
        }

        .step-progress-bar {
            height: 8px;
            background: #eef2f7;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 18px;
        }

        .progress-indicator {
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, #0d6efd, #20c997);
        }

        .step-header {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .step-item {
            border: 1px solid #e9edf5;
            border-radius: 14px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fbfcff;
        }

        .step-item.active {
            border-color: rgba(13, 110, 253, .35);
            background: rgba(13, 110, 253, .06);
        }

        .step-number {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: #eaf2ff;
            color: #0d6efd;
            font-weight: 800;
        }

        .step-item.active .step-number {
            background: #0d6efd;
            color: #fff;
        }

        .step-title {
            font-weight: 800;
            color: #111827;
        }

        .block {
            border: 1px solid #e9edf5;
            border-radius: 14px;
            padding: 16px;
            background: #fbfcff;
        }

        .sep {
            height: 1px;
            background: #e9edf5;
            margin: 14px 0;
        }

        .glass {
            background: rgba(255, 255, 255, .72);
            border: 1px solid rgba(255, 255, 255, .55);
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
            backdrop-filter: blur(10px);
            border-radius: 18px;
        }

        .section-card {
            padding: 18px;
            margin-bottom: 14px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            margin: 0 0 12px 0;
            color: #111827;
        }

        .section-title i {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(47, 160, 221, .12);
            color: #2fa0dd;
        }

        .info-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 14px;
            border: 1px solid #e9edf5;
            background: #fff;
        }

        .info-table tr:not(:last-child) td {
            border-bottom: 1px solid #eef2f7;
        }

        .info-table td {
            padding: 12px 14px;
            vertical-align: top;
        }

        .label-cell {
            width: 34%;
            color: #6b7280;
            font-weight: 700;
            background: linear-gradient(180deg, #fbfcff, #ffffff);
        }

        .value-cell {
            color: #111827;
            font-weight: 600;
        }

        .muted {
            color: #6b7280;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .label-cell {
                width: 45%;
            }
        }
    </style>
</head>

<body>

    @php
        $leadPhone = trim(($poster?->lead_ccode ?? '').' '.($poster?->lead_phone ?? ''));
        $ppPhone   = trim(($poster?->pp_ccode ?? '').' '.($poster?->pp_phone ?? ''));
    @endphp

    <div class="wrap">
        <div class="panel">
            <h1 class="h3 fw-bold mb-1">Success</h1>
            <div class="text-secondary mb-3">Step 3 of 3 — Registration completed.</div>

            <div class="step-progress-bar">
                <div class="progress-indicator"></div>
            </div>

            <div class="step-header">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-title">Registration</div>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-title">Preview</div>
                </div>
                <div class="step-item active">
                    <div class="step-number">3</div>
                    <div class="step-title">Success</div>
                </div>
            </div>

            {{-- Approval Pending Message --}}
            <div class="alert alert-info d-flex align-items-start gap-2">
                <i class="fa-solid fa-circle-info mt-1"></i>
                <div>
                    <div class="fw-bold">Approval Pending</div>
                    <div>
                        Your profile is not approved yet for payment. Please wait for admin approval.
                        You will be notified once your application is approved.
                    </div>
                </div>
            </div>

            <div class="block mb-3">

                {{-- Core --}}
                <div class="glass section-card">
                    <h4 class="section-title">
                        <i class="fa-solid fa-layer-group"></i>
                        Core Information
                    </h4>

                    <table class="info-table">
                        <tr>
                            <td class="label-cell">Registration ID</td>
                            <td class="value-cell"><strong>#{{ $poster->id }}</strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Sector</td>
                            <td class="value-cell">{{ $poster->sector }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Nationality</td>
                            <td class="value-cell">{{ $poster->nationality }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Title</td>
                            <td class="value-cell"><strong>{{ $poster->title }}</strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Theme</td>
                            <td class="value-cell">{{ $poster->theme ?: '—' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="sep"></div>

                {{-- Lead Author --}}
                <div class="glass section-card">
                    <h4 class="section-title">
                        <i class="fa-solid fa-user-pen"></i>
                        Lead Author
                    </h4>

                    <table class="info-table">
                        <tr>
                            <td class="label-cell">Name</td>
                            <td class="value-cell"><strong>{{ $poster->lead_name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Email</td>
                            <td class="value-cell">{{ $poster->lead_email }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">College Name/Organisation Name</td>
                            <td class="value-cell">{{ $poster->lead_org }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Mobile Number</td>
                            <td class="value-cell">{{ $leadPhone ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Address</td>
                            <td class="value-cell">{{ $poster->lead_addr }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">City</td>
                            <td class="value-cell">{{ $poster->lead_city }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">State</td>
                            <td class="value-cell">{{ $poster->lead_state }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Country</td>
                            <td class="value-cell">{{ $poster->lead_country }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Postal Code</td>
                            <td class="value-cell">{{ $poster->lead_zip }}</td>
                        </tr>
                    </table>
                </div>

                <div class="sep"></div>

                {{-- Poster Presenter --}}
                <div class="glass section-card">
                    <h4 class="section-title">
                        <i class="fa-solid fa-user-tie"></i>
                        Poster Presenter
                    </h4>

                    <table class="info-table">
                        <tr>
                            <td class="label-cell">Name</td>
                            <td class="value-cell"><strong>{{ $poster->pp_name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Email</td>
                            <td class="value-cell">{{ $poster->pp_email }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">College Name/Organisation Name</td>
                            <td class="value-cell">{{ $poster->pp_org }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Mobile Number</td>
                            <td class="value-cell">{{ $ppPhone ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Website</td>
                            <td class="value-cell">
                                @if($poster->pp_website)
                                    <a href="{{ $poster->pp_website }}" target="_blank">{{ $poster->pp_website }}</a>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Address</td>
                            <td class="value-cell">{{ $poster->pp_addr }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">City</td>
                            <td class="value-cell">{{ $poster->pp_city }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">State</td>
                            <td class="value-cell">{{ $poster->pp_state }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Country</td>
                            <td class="value-cell">{{ $poster->pp_country }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Postal Code</td>
                            <td class="value-cell">{{ $poster->pp_zip }}</td>
                        </tr>
                    </table>
                </div>

                <div class="sep"></div>

                {{-- Payment --}}
                <div class="glass section-card">
                    <h4 class="section-title">
                        <i class="fa-solid fa-credit-card"></i>
                        Payment Summary
                    </h4>

                    <table class="info-table">
                        <tr>
                            <td class="label-cell">Payment Mode</td>
                            <td class="value-cell">{{ $poster->paymode ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Currency</td>
                            <td class="value-cell">{{ $poster->currency ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Base Amount</td>
                            <td class="value-cell">{{ $poster->base_amount ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Additional Charges</td>
                            <td class="value-cell">{{ $poster->additional_charge ?: '—' }}</td>
                        </tr>
                        <tr hidden>
                            <td class="label-cell">Discount Code</td>
                            <td class="value-cell">{{ $poster->discount_code ?: '—' }}</td>
                        </tr>
                        <tr hidden>
                            <td class="label-cell">Discount Amount</td>
                            <td class="value-cell">{{ $poster->discount_amount ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">GST Amount</td>
                            <td class="value-cell">{{ $poster->gst_amount ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Processing Fee</td>
                            <td class="value-cell">{{ $poster->processing_fee ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Total Amount</td>
                            <td class="value-cell"><strong>{{ $poster->total_amount ?: '—' }}</strong></td>
                        </tr>
                    </table>

                    <div class="alert alert-warning mt-3 mb-0">
                        <i class="fas fa-clock"></i>
                        Payment options will be available once your application is approved by the admin.
                    </div>
                </div>

            </div>

            <div class="d-flex flex-wrap gap-2 justify-content-end">
                <a href="{{ url('/poster/register') }}" class="btn btn-outline-primary">
                    <i class="fa-solid fa-plus"></i> New Registration
                </a>
            </div>

            <div class="text-secondary mt-3" style="font-size: 13px;">
                Your registration has been submitted successfully. Keep your Registration ID for future reference.
            </div>

        </div>
    </div>

</body>
</html>
