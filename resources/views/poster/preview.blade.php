<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poster Registration - Step 2</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap (if your app already includes it globally, you can remove these) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome (icons) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Custom Styles --}}

    <style>
        body {
            background: #f6f7fb;
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
            width: 50%;
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

        .k {
            color: #6b7280;
            font-size: 13px;
        }

        .v {
            font-weight: 700;
            color: #111827;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        .sep {
            height: 1px;
            background: #e9edf5;
            margin: 14px 0;
        }


        body {
            background: radial-gradient(1200px 600px at 20% -10%, rgba(47, 160, 221, .18), transparent 60%),
                radial-gradient(900px 600px at 110% 10%, rgba(255, 152, 25, .10), transparent 55%),
                #f6f8fb;
        }

        .page-wrap {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 14px;
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .page-title {
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0;
        }

        .page-sub {
            color: #6b7280;
            margin-top: 6px;
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

        .value-cell a {
            text-decoration: none;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            border: 1px solid rgba(17, 24, 39, .10);
            background: rgba(17, 24, 39, .04);
            color: #111827;
        }

        .pill-blue {
            background: rgba(47, 160, 221, .10);
            border-color: rgba(47, 160, 221, .18);
            color: #0b5ea8;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .btn-soft {
            background: rgba(47, 160, 221, .10);
            border: 1px solid rgba(47, 160, 221, .18);
            color: #0b5ea8;
            font-weight: 800;
        }

        .btn-soft:hover {
            background: rgba(47, 160, 221, .14);
        }

        .muted {
            color: #6b7280;
            font-weight: 600;
        }

        .file-btn i {
            margin-right: 6px;
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
    // Safe helpers for view
    $leadPhone = trim(($draft?->lead_ccode ?? '').' '.($draft?->lead_phone ?? ''));
    $ppPhone = trim(($draft?->pp_ccode ?? '').' '.($draft?->pp_phone ?? ''));

    $sessUrl = $draft?->sess_abstract_path ? asset('storage/'.$draft->sess_abstract_path) : null;
    $cvUrl = $draft?->lead_auth_cv_path ? asset('storage/'.$draft->lead_auth_cv_path) : null;

    $hasCoAuthors =
    ($draft?->co_auth_name_1 || $draft?->co_auth_name_2 || $draft?->co_auth_name_3 || $draft?->co_auth_name_4);

    $hasAccCoAuthors =
    ($draft?->acc_co_auth_name_1 || $draft?->acc_co_auth_name_2 || $draft?->acc_co_auth_name_3 || $draft?->acc_co_auth_name_4);
    @endphp

    <div class="wrap">
        <div class="panel">
            <h1 class="h3 fw-bold mb-1">Preview</h1>
            <div class="text-secondary mb-3">Step 2 of 3 — Review and submit.</div>

            <div class="step-progress-bar">
                <div class="progress-indicator"></div>
            </div>

            <div class="step-header">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-title">Registration</div>
                </div>
                <div class="step-item active">
                    <div class="step-number">2</div>
                    <div class="step-title">Preview</div>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-title">Success</div>
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
                            <td class="label-cell">Sector</td>
                            <td class="value-cell">{{ $draft->sector }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Nationality</td>
                            <td class="value-cell">{{ $draft->nationality }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Title</td>
                            <td class="value-cell"><strong>{{ $draft->title }}</strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Theme</td>
                            <td class="value-cell">{{ $draft->theme ?: '—' }}</td>
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
                            <td class="value-cell"><strong>{{ $draft->lead_name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Email</td>
                            <td class="value-cell">{{ $draft->lead_email }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">College Name/Organisation Name</td>
                            <td class="value-cell">{{ $draft->lead_org }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Mobile Number</td>
                            <td class="value-cell">{{ $leadPhone ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Address</td>
                            <td class="value-cell">{{ $draft->lead_addr }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">City</td>
                            <td class="value-cell">{{ $draft->lead_city }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">State</td>
                            <td class="value-cell">{{ $draft->lead_state }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Country</td>
                            <td class="value-cell">{{ $draft->lead_country }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Postal Code</td>
                            <td class="value-cell">{{ $draft->lead_zip }}</td>
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
                            <td class="value-cell"><strong>{{ $draft->pp_name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Email</td>
                            <td class="value-cell">{{ $draft->pp_email }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">College Name/Organisation Name</td>
                            <td class="value-cell">{{ $draft->pp_org }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Mobile Number</td>
                            <td class="value-cell">{{ $ppPhone ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Website</td>
                            <td class="value-cell">
                                @if($draft->pp_website)
                                <a href="{{ $draft->pp_website }}" target="_blank">{{ $draft->pp_website }}</a>
                                @else
                                —
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Address</td>
                            <td class="value-cell">{{ $draft->pp_addr }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">City</td>
                            <td class="value-cell">{{ $draft->pp_city }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">State</td>
                            <td class="value-cell">{{ $draft->pp_state }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Country</td>
                            <td class="value-cell">{{ $draft->pp_country }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Postal Code</td>
                            <td class="value-cell">{{ $draft->pp_zip }}</td>
                        </tr>
                    </table>
                </div>

                <div class="sep"></div>

                {{-- Co-authors --}}
                <div class="glass section-card">
                    <h4 class="section-title">
                        <i class="fa-solid fa-users"></i>
                        Co-Authors
                    </h4>

                    <table class="info-table">
                        <tr>
                            <td class="label-cell">Co-Author 1</td>
                            <td class="value-cell">{{ $draft->co_auth_name_1 ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Co-Author 2</td>
                            <td class="value-cell">{{ $draft->co_auth_name_2 ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Co-Author 3</td>
                            <td class="value-cell">{{ $draft->co_auth_name_3 ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Co-Author 4</td>
                            <td class="value-cell">{{ $draft->co_auth_name_4 ?: '—' }}</td>
                        </tr>
                    </table>

                    @if(!$hasCoAuthors)
                    <div class="muted mt-2">No co-authors added.</div>
                    @endif
                </div>

                <div class="sep"></div>

                {{-- Accompanying Co-authors --}}
                <div class="glass section-card">
                    <h4 class="section-title">
                        <i class="fa-solid fa-user-group"></i>
                        <!-- Accompanying Co-Authors -->
                        Please enter details of Accompanying Co-Author(s) at event
                    </h4>

                    <table class="info-table">
                        <tr>
                            <td class="label-cell">Accompanying 1</td>
                            <td class="value-cell">{{ $draft->acc_co_auth_name_1 ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Accompanying 2</td>
                            <td class="value-cell">{{ $draft->acc_co_auth_name_2 ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Accompanying 3</td>
                            <td class="value-cell">{{ $draft->acc_co_auth_name_3 ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Accompanying 4</td>
                            <td class="value-cell">{{ $draft->acc_co_auth_name_4 ?: '—' }}</td>
                        </tr>
                    </table>

                    @if(!$hasAccCoAuthors)
                    <div class="muted mt-2">No accompanying co-authors added.</div>
                    @endif
                </div>

                <div class="sep"></div>

                {{-- Abstract + Session abstract --}}
                <div class="glass section-card">
                    <h4 class="section-title">
                        <i class="fa-solid fa-file-lines"></i>
                        Abstract
                    </h4>

                    <table class="info-table">
                        <tr>
                            <td class="label-cell">Abstract Text</td>
                            <td class="value-cell" style="white-space: pre-wrap;">{{ $draft->abstract_text }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Abstract / Description of the Session</td>
                            <td class="value-cell">
                                @if($sessUrl)
                                <a class="btn btn-sm btn-primary file-btn" target="_blank" href="{{ $sessUrl }}">
                                    <i class="fa-solid fa-file"></i> View Abstract / Session Description
                                </a>
                                <div class="muted mt-1">
                                    {{ $draft->sess_abstract_original_name }} ({{ number_format(($draft->sess_abstract_size ?? 0)/1024, 0) }} KB)
                                </div>
                                @else
                                <span class="muted">No file uploaded</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Lead Author CV</td>
                            <td class="value-cell">
                                @if($cvUrl)
                                <a class="btn btn-sm btn-primary file-btn" target="_blank" href="{{ $cvUrl }}">
                                    <i class="fa-solid fa-file"></i> View CV
                                </a>
                                <div class="muted mt-1">
                                    {{ $draft->lead_auth_cv_original_name }} ({{ number_format(($draft->lead_auth_cv_size ?? 0)/1024, 0) }} KB)
                                </div>
                                @else
                                <span class="muted">No file uploaded</span>
                                @endif
                            </td>
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
                            <td class="value-cell">{{ $draft->paymode ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Currency</td>
                            <td class="value-cell">{{ $draft->currency ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Base Amount</td>
                            <td class="value-cell">{{ $draft->base_amount ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Additional Charges</td>
                            <td class="value-cell">{{ $draft->additional_charge ?: '—' }}</td>
                        </tr>
                        <tr hidden>
                            <td class="label-cell">Discount Code</td>
                            <td class="value-cell">{{ $draft->discount_code ?: '—' }}</td>
                        </tr>
                        <tr hidden>
                            <td class="label-cell">Discount Amount</td>
                            <td class="value-cell">{{ $draft->discount_amount ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">GST Amount</td>
                            <td class="value-cell">{{ $draft->gst_amount ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Processing Fee</td>
                            <td class="value-cell">{{ $draft->processing_fee ?: '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Total Amount</td>
                            <td class="value-cell"><strong>{{ $draft->total_amount ?: '—' }}</strong></td>
                        </tr>
                    </table>
                </div>

                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-exclamation"></i>
                    Please review all information carefully before submitting. Once submitted, changes cannot be made.
                </div>

            </div>

            <div class="d-flex flex-wrap gap-2 justify-content-between">
                <a class="btn btn-outline-secondary" href="{{ route('poster.register.edit', ['token' => $draft->token]) }}">
                    <i class="fa-solid fa-arrow-left"></i> Back to Edit
                </a>

                <form method="POST" action="{{ route('poster.submit', ['token' => $draft->token]) }}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fa-solid fa-paper-plane"></i> Submit Registration</button>
                </form>
            </div>

            <!-- <div class="text-secondary mt-3" style="font-size: 13px;">
            Submitting will finalize your registration and move it to the poster table. Your draft remains as backup.
        </div> -->
        </div>
    </div>
</body>

</html>