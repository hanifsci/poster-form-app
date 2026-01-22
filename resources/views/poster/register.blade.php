<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poster Registration - Step 1</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.15.0/build/css/intlTelInput.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.15.0/build/js/intlTelInput.min.js"></script> -->


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
            width: 0%;
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

        .card-soft {
            border: 1px solid #e9edf5;
            border-radius: 14px;
            padding: 16px;
            background: #fbfcff;
        }

        .help {
            color: #6b7280;
            font-size: 13px;
        }

        .req {
            color: #b00020;
            font-weight: 800;
        }

        /* phone lib UI  */
        .iti {
            width: 100%;
        }

        .iti__tel-input {
            width: 100%;
        }

        /* table poster tarrif UI */
        .tariff-table thead th {
            text-align: center;
        }

        .tariff-table .align-td {
            text-align: center;
            vertical-align: middle;
        }

        .price-box {
            border: 1px solid #e9edf5;
            background: #fbfcff;
            border-radius: 14px;
            padding: 16px;
        }

        .price-line {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 6px 0;
            border-bottom: 1px dashed #e9edf5;
        }

        .price-line:last-child {
            border-bottom: 0;
        }

        .price-label {
            color: #6b7280;
        }

        .price-value {
            font-weight: 800;
            color: #111827;
        }

        .price-total .price-label,
        .price-total .price-value {
            font-size: 18px;
        }

        .badge-soft {
            background: rgba(13, 110, 253, .08);
            border: 1px solid rgba(13, 110, 253, .15);
            color: #0d6efd;
            padding: 4px 10px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="panel">
            <h1 class="h3 fw-bold mb-1">Poster Registration</h1>
            <div class="text-secondary mb-3">Step 1 of 3 — Fill details and continue to preview.</div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <div class="fw-bold mb-2">Please fix the following:</div>
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="step-progress-bar">
                <div class="progress-indicator"></div>
            </div>

            <div class="step-header">
                <div class="step-item active">
                    <div class="step-number">1</div>
                    <!-- <div class="step-title">Registration</div> -->
                    <div class="step-title">Poster Details</div>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-title">Preview</div>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-title">Success</div>
                </div>
            </div>

            <form method="POST" action="{{ route('poster.register.storeDraft') }}" enctype="multipart/form-data">
                @csrf

                @if (!empty($draft))
                <input type="hidden" name="token" value="{{ $draft->token }}">
                @endif

                {{-- Core --}}
                <div class="card-soft mb-3">
                    <h2 class="h5 fw-bold mb-3">Core</h2>

                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label">Sector <span class="req">*</span></label>
                            <select class="form-select" name="sector" required>
                                <option value="" disabled {{ old('sector', $draft->sector ?? '') ? '' : 'selected' }}>-- Select sector --</option>
                                @foreach ($sectorOptions as $opt)
                                <option value="{{ $opt }}" {{ old('sector', $draft->sector ?? '') === $opt ? 'selected' : '' }}>
                                    {{ $opt }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label">Nationality <span class="req">*</span></label>
                            <div class="d-flex gap-3 mt-2">
                                <label class="form-check-label">
                                    <input class="form-check-input me-1"
                                        type="radio"
                                        name="nationality"
                                        value="India"
                                        {{ old('nationality', $draft->nationality ?? '') === 'India' ? 'checked' : '' }}
                                        required>
                                    India
                                </label>
                                <label class="form-check-label">
                                    <input class="form-check-input me-1"
                                        type="radio"
                                        name="nationality"
                                        value="International"
                                        {{ old('nationality', $draft->nationality ?? '') === 'International' ? 'checked' : '' }}
                                        required>
                                    International
                                </label>
                            </div>
                        </div>

                        {{-- Poster Tariff --}}
                        <div class="col-12">
                            <table class="table table-bordered tariff-table mb-3">
                                <thead>
                                    <tr style="background:#2fa0dd; color:#fff;">
                                        <th colspan="2">Poster Tariff</th>
                                    </tr>
                                    <tr style="background:#2fa0dd; color:#fff;">
                                        <th class="align-td">Nationality</th>
                                        <th class="align-td">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="tariff-row-india" style="background:#e1e1e1;">
                                        <td class="align-td">India</td>
                                        <td class="align-td">INR 3000</td>
                                    </tr>
                                    <tr id="tariff-row-intl" style="background:#e1e1e1;">
                                        <td class="align-td">International</td>
                                        <td class="align-td">USD 50</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Note:</strong><br>
                                            - 18% GST is applicable.<br>
                                            - Processing charges: 3% (India / CCAvenue), 9% (International / PayPal).
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-12">
                            <label class="form-label">Title <span class="req">*</span></label>
                            <input class="form-control" name="title" maxlength="200"
                                value="{{ old('title', $draft->title ?? '') }}" required>
                        </div>
                    </div>
                </div>

                {{-- Lead Author --}}
                <div class="card-soft mb-3">
                    <h2 class="h5 fw-bold mb-3">Lead Author</h2>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name of Lead Author <span class="req">*</span></label>
                            <input class="form-control" name="lead_name" maxlength="200"
                                value="{{ old('lead_name', $draft->lead_name ?? '') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="req">*</span></label>
                            <input class="form-control" type="email" name="lead_email" maxlength="200"
                                value="{{ old('lead_email', $draft->lead_email ?? '') }}" required>
                            <div id="lead-email-alert" class="mt-2" style="display:none;"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">College Name/Organisation Name <span class="req">*</span></label>
                            <input class="form-control" name="lead_org" maxlength="250"
                                value="{{ old('lead_org', $draft->lead_org ?? '') }}" required>
                        </div>

                        <!-- <div class="col-md-4">
                            <label class="form-label">Country Code (optional)</label>
                            <input class="form-control" name="lead_ccode" maxlength="5"
                                value="{{ old('lead_ccode', $draft->lead_ccode ?? '') }}" placeholder="+91">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone <span class="req">*</span></label>
                            <input class="form-control" name="lead_phone" maxlength="15"
                               value="{{ old('lead_phone', $draft->lead_phone ?? '') }}" required>
                        </div> -->
                        <div class="col-md-6">
                            <label class="form-label">Mobile Number <span class="req">*</span></label>

                            <!-- visible phone input -->
                            <input
                                class="form-control"
                                id="lead_phone_input"
                                type="tel"
                                placeholder="Enter phone number"
                                value="{{ old('lead_phone_input', trim(($draft?->lead_ccode ?? '').' '.($draft?->lead_phone ?? ''))) }}"
                                required>

                            <!-- hidden fields submitted to backend -->
                            <input type="hidden" name="lead_ccode" id="lead_ccode" value="{{ old('lead_ccode', $draft->lead_ccode ?? '') }}">
                            <input type="hidden" name="lead_phone" id="lead_phone" value="{{ old('lead_phone', $draft->lead_phone ?? '') }}">

                            <div class="help mt-1"></div>
                        </div>


                        <div class="col-12">
                            <label class="form-label">Address <span class="req">*</span></label>
                            <textarea class="form-control" name="lead_addr" rows="3" required>{{ old('lead_addr', $draft->lead_addr ?? '') }}</textarea>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">City <span class="req">*</span></label>
                            <input class="form-control" name="lead_city" maxlength="120"
                                value="{{ old('lead_city', $draft->lead_city ?? '') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">State <span class="req">*</span></label>
                            <input class="form-control" name="lead_state" maxlength="120"
                                value="{{ old('lead_state', $draft->lead_state ?? '') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Country <span class="req">*</span></label>
                            <select class="form-select" name="lead_country" required>
                                <option value="" disabled {{ old('lead_country', $draft->lead_country ?? '') ? '' : 'selected' }}>-- Select country --</option>
                                @foreach ($countryList as $code => $name)
                                <option value="{{ $name }}" {{ old('lead_country', $draft->lead_country ?? '') === $name ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Postal Code <span class="req">*</span></label>
                            <input class="form-control" name="lead_zip" maxlength="30"
                                value="{{ old('lead_zip', $draft->lead_zip ?? '') }}" required>
                        </div>
                    </div>
                </div>

                {{-- Presenter --}}
                <div class="card-soft mb-3">
                    <h2 class="h5 fw-bold mb-3">Poster Presenter</h2>
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="copyLeadToPresenterBtn">
                            Copy from lead author information
                        </button>
                    </div>


                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name of Poster Presenter <span class="req">*</span></label>
                            <input class="form-control" name="pp_name" maxlength="200"
                                value="{{ old('pp_name', $draft->pp_name ?? '') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="req">*</span></label>
                            <input class="form-control" type="email" name="pp_email" maxlength="200"
                                value="{{ old('pp_email', $draft->pp_email ?? '') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">College Name/Organisation Name <span class="req">*</span></label>
                            <input class="form-control" name="pp_org" maxlength="250"
                                value="{{ old('pp_org', $draft->pp_org ?? '') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Website</label>
                            <input class="form-control" name="pp_website" maxlength="255"
                                value="{{ old('pp_website', $draft->pp_website ?? '') }}" placeholder="https://example.com">
                        </div>

                        <!-- <div class="col-md-4">
                            <label class="form-label">Country Code (optional)</label>
                            <input class="form-control" name="pp_ccode" maxlength="5"
                                value="{{ old('pp_ccode', $draft->pp_ccode ?? '') }}" placeholder="+91">
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Phone <span class="req">*</span></label>
                            <input class="form-control" name="pp_phone" maxlength="15"
                                value="{{ old('pp_phone', $draft->pp_phone ?? '') }}" required>
                        </div> -->

                        <div class="col-md-6">
                            <label class="form-label">Mobile Number <span class="req">*</span></label>

                            <input
                                class="form-control"
                                id="pp_phone_input"
                                type="tel"
                                placeholder="Enter phone number"
                                value="{{ old('pp_phone_input', trim(($draft?->pp_ccode ?? '').' '.($draft?->pp_phone ?? ''))) }}"
                                required>

                            <input type="hidden" name="pp_ccode" id="pp_ccode" value="{{ old('pp_ccode', $draft->pp_ccode ?? '') }}">
                            <input type="hidden" name="pp_phone" id="pp_phone" value="{{ old('pp_phone', $draft->pp_phone ?? '') }}">
                        </div>


                        <div class="col-12">
                            <label class="form-label">Address <span class="req">*</span></label>
                            <textarea class="form-control" name="pp_addr" rows="3" required>{{ old('pp_addr', $draft->pp_addr ?? '') }}</textarea>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">City <span class="req">*</span></label>
                            <input class="form-control" name="pp_city" maxlength="120"
                                value="{{ old('pp_city', $draft->pp_city ?? '') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">State <span class="req">*</span></label>
                            <input class="form-control" name="pp_state" maxlength="120"
                                value="{{ old('pp_state', $draft->pp_state ?? '') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Country <span class="req">*</span></label>
                            <select class="form-select" name="pp_country" required>
                                <option value="" disabled {{ old('pp_country', $draft->pp_country ?? '') ? '' : 'selected' }}>-- Select country --</option>
                                @foreach ($countryList as $code => $name)
                                <option value="{{ $name }}" {{ old('pp_country', $draft->pp_country ?? '') === $name ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Postal Code <span class="req">*</span></label>
                            <input class="form-control" name="pp_zip" maxlength="30"
                                value="{{ old('pp_zip', $draft->pp_zip ?? '') }}" required>
                        </div>
                    </div>
                </div>

                {{-- Co Authors --}}
                <div class="card-soft mb-3">
                    <h2 class="h5 fw-bold mb-3">Co-Authors</h2>
                    <div class="row g-3">
                        @for ($i=1; $i<=4; $i++)
                            <div class="col-md-6">
                            <label class="form-label">Co-Author {{ $i }}</label>
                            <input class="form-control" name="co_auth_name_{{ $i }}" maxlength="200"
                                value="{{ old('co_auth_name_'.$i, $draft->{'co_auth_name_'.$i} ?? '') }}">
                    </div>
                    @endfor
                </div>

                <hr class="my-4">

                <h2 class="h5 fw-bold mb-3">Please enter details of Accompanying Co-Author(s) at event</h2>
                <div class="alert alert-warning py-2 mb-2">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    There will be a additional charges for each accompanying co-author.
                </div>
                <div class="d-flex justify-content-end mb-2">
                    <button type="button" class="btn btn-outline-primary btn-sm" id="copyCoToAccBtn">
                        Copy from co-authors
                    </button>
                </div>

                <div class="row g-3">
                    @for ($i=1; $i<=4; $i++)
                        <div class="col-md-6">
                        <label class="form-label">Accompanying Co-Author {{ $i }}</label>
                        <input class="form-control" name="acc_co_auth_name_{{ $i }}" maxlength="200"
                            value="{{ old('acc_co_auth_name_'.$i, $draft->{'acc_co_auth_name_'.$i} ?? '') }}">
                </div>
                @endfor
        </div>
    </div>

    {{-- Theme/Abstract/Files --}}
    <div class="card-soft mb-3">
        <h2 class="h5 fw-bold mb-3">Theme, Abstract & Files</h2>

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Theme</label>
                <input class="form-control" name="theme" maxlength="150"
                    value="{{ old('theme', $draft->theme ?? '') }}">
            </div>

            <div class="col-12">
                <label class="form-label">Abstract <span class="req">*</span></label>
                <textarea class="form-control" id="abstract_text" name="abstract_text" rows="6" required>{{ old('abstract_text', $draft->abstract_text ?? '') }}</textarea>
                <div class="help mt-1">
                    Word count: <b id="abstract_word_count">0</b> (minimum 250 words)
                </div>
                <!-- <div class="help mt-1">Required field.</div> -->
            </div>

            <div class="col-md-6">
                <label class="form-label">Abstract / Description of the Session <span class="req">*</span></label>
                <!-- <input class="form-control" type="file" name="sess_abstract" accept=".doc,.docx,.pdf"> -->
                <input class="form-control" type="file" name="sess_abstract" accept=".doc,.docx,.pdf"
                    {{ empty($draft?->sess_abstract_path) ? 'required' : '' }}>
                @if (!empty($draft?->sess_abstract_path))
                <div class="help mt-1">
                    Uploaded file: {{ $draft->sess_abstract_original_name ?? 'file' }}
                </div>
                @else
                <div class="help mt-1">Allowed: doc, docx, pdf. Max: 2MB</div>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">Lead Author CV <span class="req">*</span></label>
                <!-- <input class="form-control" type="file" name="lead_auth_cv" accept=".doc,.docx,.pdf"> -->
                <input class="form-control" type="file" name="lead_auth_cv" accept=".doc,.docx,.pdf"
                    {{ empty($draft?->lead_auth_cv_path) ? 'required' : '' }}>

                @if (!empty($draft?->lead_auth_cv_path))
                <div class="help mt-1">
                    Uploaded file: {{ $draft->lead_auth_cv_original_name ?? 'file' }}
                </div>
                @else
                <div class="help mt-1">Allowed: doc, docx, pdf. Max: 2MB</div>
                @endif
            </div>
        </div>
    </div>



    {{-- Payment Fields --}}
    <div class="card-soft mb-3">
        <h2 class="h5 fw-bold mb-3">Payment Mode</h2>

        <div class="row g-3">
            {{-- Payment --}}
            <div class="col-12">
                {{-- Payment Mode --}}
                <div class="mb-3">
                    <label class="form-label">Payment Mode <span class="req">*</span></label>
                    <select class="form-select" name="paymode" id="paymode" required>
                        <option value="" disabled selected>-- Select payment mode --</option>
                        {{-- options inserted by JS --}}
                    </select>
                </div>

                {{-- Price Calculation --}}
                <div class="price-box" style="background: #cef5d7;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="fw-bold">Price Calculation</div>
                        <div class="badge-soft" id="calc-badge">Select nationality</div>
                    </div>

                    <div class="price-line">
                        <div class="price-label">Currency</div>
                        <div class="price-value" id="calc-currency">—</div>
                    </div>
                    <div class="price-line">
                        <div class="price-label">Base Price</div>
                        <div class="price-value" id="calc-base">—</div>
                    </div>
                    <div class="price-line">
                        <div class="price-label">Additional Charges</div>
                        <div class="price-value" id="calc-additional">—</div>
                    </div>
                    <div class="price-line" hidden>
                        <div class="price-label">Discount</div>
                        <div class="price-value" id="calc-discount">—</div>
                    </div>
                    <div class="price-line">
                        <div class="price-label">GST (18%)</div>
                        <div class="price-value" id="calc-gst">—</div>
                    </div>
                    <div class="price-line">
                        <div class="price-label" id="calc-proc-label">Processing Charges</div>
                        <div class="price-value" id="calc-proc">—</div>
                    </div>
                    <div class="price-line price-total">
                        <div class="price-label">Total Price</div>
                        <div class="price-value" id="calc-total">—</div>
                    </div>
                </div>

                {{-- Hidden payment fields to store in DB --}}
                <input type="hidden" name="currency" id="currency" value="{{ old('currency', $draft?->currency ?? '') }}">
                <input type="hidden" name="base_amount" id="base_amount" value="{{ old('base_amount', $draft?->base_amount ?? '') }}">
                <input type="hidden" name="discount_code" id="discount_code" value="{{ old('discount_code', $draft?->discount_code ?? '') }}">
                <input type="hidden" name="discount_amount" id="discount_amount" value="{{ old('discount_amount', $draft?->discount_amount ?? '') }}">
                <input type="hidden" name="gst_amount" id="gst_amount" value="{{ old('gst_amount', $draft?->gst_amount ?? '') }}">
                <input type="hidden" name="processing_fee" id="processing_fee" value="{{ old('processing_fee', $draft?->processing_fee ?? '') }}">
                <input type="hidden" name="total_amount" id="total_amount" value="{{ old('total_amount', $draft?->total_amount ?? '') }}">

                <input type="hidden" name="acc_count" id="acc_count" value="{{ old('acc_count', $draft->acc_count ?? 0) }}">
                <input type="hidden" name="acc_unit_cost" id="acc_unit_cost" value="{{ old('acc_unit_cost', $draft->acc_unit_cost ?? 0) }}">
                <input type="hidden" name="additional_charge" id="additional_charge" value="{{ old('additional_charge', $draft->additional_charge ?? 0) }}">
            </div>



        </div>
    </div>

    {{-- reCAPTCHA --}}
    <div class="mb-3">
        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

        @error('g-recaptcha-response')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    {{-- continue button --}}

    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            Continue to Preview
        </button>
    </div>
    </form>
    </div>
    </div>

    <!-- JS for phone input -->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.15.0/build/js/intlTelInput.min.js"></script>
    <script>
        function setupIntlTel(inputId, hiddenCodeId, hiddenPhoneId, preferredCountries = ["in", "us", "gb"]) {
            const input = document.getElementById(inputId);
            if (!input) return;

            const iti = window.intlTelInput(input, {
                initialCountry: "in",
                preferredCountries,
                separateDialCode: true,
                nationalMode: true,
                loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.15.0/build/js/utils.js"),
            });

            const hiddenCode = document.getElementById(hiddenCodeId);
            const hiddenPhone = document.getElementById(hiddenPhoneId);

            const sync = () => {
                const data = iti.getSelectedCountryData();
                // dialCode is number only, store as +NN
                hiddenCode.value = data?.dialCode ? `+${data.dialCode}` : "";
                // store only digits for phone (national number)
                hiddenPhone.value = (input.value || "").replace(/\D/g, "");
            };

            // sync on input & country change
            input.addEventListener("input", sync);
            input.addEventListener("countrychange", sync);

            // sync immediately (handles prefilled edit mode)
            sync();

            return iti;
        }

        setupIntlTel("lead_phone_input", "lead_ccode", "lead_phone");
        setupIntlTel("pp_phone_input", "pp_ccode", "pp_phone");
    </script>
    <!-- JS for Payment and detail and tarrif table -->
    <script>
        (function() {
            const INR_BASE = 3000;
            const USD_BASE = 50;

            const GST_RATE = 0.18;
            const PROC_IN = 0.03; // India
            const PROC_INT = 0.09; // International

            const el = (id) => document.getElementById(id);

            function getNationality() {
                const checked = document.querySelector('input[name="nationality"]:checked');
                return checked ? checked.value : null;
            }

            function fmt(currency, amount) {
                const n = Number(amount || 0);
                const fixed = n.toFixed(2);
                if (currency === 'INR') return `₹${fixed}`;
                if (currency === 'USD') return `$${fixed}`;
                return fixed;
            }

            // Inject a small CSS block once (for highlight styling)
            function setTariffHighlight(nat) {
                const indiaRow = el('tariff-row-india');
                const intlRow = el('tariff-row-intl');
                if (!indiaRow || !intlRow) return;

                indiaRow.style.outline = 'none';
                intlRow.style.outline = 'none';

                if (nat === 'India') indiaRow.style.outline = '3px solid rgba(13,110,253,.35)';
                if (nat === 'International') intlRow.style.outline = '3px solid rgba(13,110,253,.35)';
            }

            function setPaymodeOptions(nat) {
                const select = el('paymode');
                if (!select) return;

                select.innerHTML = `<option value="" disabled>-- Select payment mode --</option>`;

                if (nat === 'India') {
                    const opt = document.createElement('option');
                    opt.value = 'CCAvenue (Indian Payments)';
                    opt.textContent = 'CCAvenue (Indian Payments)';
                    select.appendChild(opt);
                    select.value = opt.value;
                } else if (nat === 'International') {
                    const opt = document.createElement('option');
                    opt.value = 'PayPal (International payments)';
                    opt.textContent = 'PayPal (International payments)';
                    select.appendChild(opt);
                    select.value = opt.value;
                } else {
                    // keep empty
                    select.selectedIndex = 0;
                }
            }

            function countAccompanying() {
                let count = 0;
                for (let i = 1; i <= 4; i++) {
                    const input = document.querySelector(`[name="acc_co_auth_name_${i}"]`);
                    if (input && input.value.trim() !== '') count++;
                }
                return count;
            }

            function safeNum(v) {
                const n = Number(v);
                return Number.isFinite(n) ? n : 0;
            }

            function recalc() {
                const nat = getNationality();

                // No nationality selected
                if (!nat) {
                    el('calc-badge').textContent = 'Select nationality';
                    el('calc-currency').textContent = '—';
                    el('calc-base').textContent = '—';
                    el('calc-additional').textContent = '—';
                    el('calc-gst').textContent = '—';
                    el('calc-proc').textContent = '—';
                    el('calc-total').textContent = '—';

                    // Clear hidden fields
                    el('currency').value = '';
                    el('base_amount').value = '';
                    el('gst_amount').value = '';
                    el('processing_fee').value = '';
                    el('total_amount').value = '';

                    el('acc_count').value = '0';
                    el('acc_unit_cost').value = '0.00';
                    el('additional_charge').value = '0.00';

                    setTariffHighlight(null);
                    setPaymodeOptions(null);
                    return;
                }

                setTariffHighlight(nat);
                setPaymodeOptions(nat);

                const currency = (nat === 'India') ? 'INR' : 'USD';
                const base = (nat === 'India') ? INR_BASE : USD_BASE;

                const discount = safeNum(el('discount_amount')?.value);

                // accompanying
                const accCount = countAccompanying();
                const accUnitCost = base; // current rule: unit cost = base
                const additional = accUnitCost * accCount;

                // subtotal = base + additional - discount (never negative)
                let subTotal = (base + additional) - discount;
                if (subTotal < 0) subTotal = 0;

                // GST 18% on subtotal
                const gst = subTotal * GST_RATE;

                // Processing charge on (subtotal + gst)
                const procRate = (nat === 'India') ? PROC_IN : PROC_INT;
                const procBase = subTotal + gst;
                const proc = procBase * procRate;

                const total = procBase + proc;

                // UI update
                el('calc-badge').textContent = nat;
                el('calc-currency').textContent = currency;
                el('calc-base').textContent = fmt(currency, base);
                el('calc-additional').textContent = fmt(currency, additional);
                el('calc-gst').textContent = fmt(currency, gst);

                el('calc-proc-label').textContent =
                    nat === 'India' ?
                    'Processing Charges (for India: 3.00%)' :
                    'Processing Charges (for International: 9.00%)';

                el('calc-proc').textContent = fmt(currency, proc);
                el('calc-total').textContent = fmt(currency, total);

                // Hidden fields (DB)
                el('currency').value = currency;
                el('base_amount').value = base.toFixed(2);

                el('acc_count').value = String(accCount);
                el('acc_unit_cost').value = accUnitCost.toFixed(2);
                el('additional_charge').value = additional.toFixed(2);

                el('gst_amount').value = gst.toFixed(2);
                el('processing_fee').value = proc.toFixed(2);
                el('total_amount').value = total.toFixed(2);
            }

            // nationality change
            document.querySelectorAll('input[name="nationality"]').forEach(r => {
                r.addEventListener('change', recalc);
            });

            // accompanying fields change
            for (let i = 1; i <= 4; i++) {
                const input = document.querySelector(`[name="acc_co_auth_name_${i}"]`);
                if (input) input.addEventListener('input', recalc);
            }

            // re-run after copy co-authors button
            const copyBtn = document.getElementById('copyCoToAccBtn');
            if (copyBtn) copyBtn.addEventListener('click', () => setTimeout(recalc, 0));

            // Run on load (edit mode)
            recalc();
        })();
    </script>

    <!-- Real time alter for email in lead auther -->
    <script>
        (function() {
            const emailInput = document.querySelector('input[name="lead_email"]');
            const alertBox = document.getElementById('lead-email-alert');

            if (!emailInput || !alertBox) return;

            let timer = null;
            let lastValue = '';

            function showAlert(type, message) {
                alertBox.className = 'alert alert-' + type;
                alertBox.textContent = message;
                alertBox.style.display = 'block';
            }

            function hideAlert() {
                alertBox.style.display = 'none';
                alertBox.textContent = '';
                alertBox.className = '';
            }

            async function checkEmail(email) {
                const url = new URL("{{ route('poster.checkEmail') }}", window.location.origin);
                url.searchParams.set('email', email);

                const res = await fetch(url.toString(), {
                    headers: {
                        "Accept": "application/json"
                    }
                });

                if (!res.ok) return null;
                return res.json();
            }

            emailInput.addEventListener('input', () => {
                const value = (emailInput.value || '').trim().toLowerCase();

                // don't spam
                if (value === lastValue) return;
                lastValue = value;

                // basic client-side email shape check
                if (!value || !value.includes('@') || !value.includes('.')) {
                    hideAlert();
                    return;
                }

                clearTimeout(timer);
                timer = setTimeout(async () => {
                    try {
                        const data = await checkEmail(value);
                        if (!data) return;

                        if (data.exists) {
                            showAlert('danger', 'This email is already registered. Please use another email.');
                        } else {
                            // showAlert('success', 'Email is available.');
                            // optional: auto-hide success after 1.5s
                            setTimeout(() => hideAlert(), 1500);
                        }
                    } catch (e) {
                        // fail silently (don't block user due to network error)
                        hideAlert();
                    }
                }, 350); // debounce delay
            });
        })();
    </script>
    <!-- Js for copy lead auther and co authors deatil -->
    <script>
        (function() {
            const $ = (name) => document.querySelector(`[name="${name}"]`);

            // Copy Lead -> Presenter
            const leadToPresenterBtn = document.getElementById('copyLeadToPresenterBtn');
            if (leadToPresenterBtn) {
                leadToPresenterBtn.addEventListener('click', () => {
                    // text fields
                    $('pp_name').value = $('lead_name').value || '';
                    $('pp_email').value = $('lead_email').value || '';
                    $('pp_org').value = $('lead_org').value || '';

                    // phone hidden fields (intl-tel-input)
                    const leadCode = document.getElementById('lead_ccode')?.value || '';
                    const leadPhone = document.getElementById('lead_phone')?.value || '';

                    if (document.getElementById('pp_ccode')) document.getElementById('pp_ccode').value = leadCode;
                    if (document.getElementById('pp_phone')) document.getElementById('pp_phone').value = leadPhone;

                    // Also update visible phone input (best-effort)
                    const ppVisible = document.getElementById('pp_phone_input');
                    if (ppVisible) ppVisible.value = leadPhone;

                    // address fields
                    $('pp_addr').value = $('lead_addr').value || '';
                    $('pp_city').value = $('lead_city').value || '';
                    $('pp_state').value = $('lead_state').value || '';
                    $('pp_country').value = $('lead_country').value || '';
                    $('pp_zip').value = $('lead_zip').value || '';
                });
            }

            // Copy Co-Authors -> Accompanying Co-Authors
            const coToAccBtn = document.getElementById('copyCoToAccBtn');
            if (coToAccBtn) {
                coToAccBtn.addEventListener('click', () => {
                    for (let i = 1; i <= 4; i++) {
                        const co = $(`co_auth_name_${i}`);
                        const acc = $(`acc_co_auth_name_${i}`);
                        if (co && acc) acc.value = co.value || '';
                    }
                });
            }
        })();
    </script>
    <!-- JS for real time count the words for abstract text-->
    <script>
        (function() {
            const textarea = document.getElementById('abstract_text');
            const counter = document.getElementById('abstract_word_count');
            if (!textarea || !counter) return;

            function countWords(text) {
                // split by whitespace, ignore empty
                return (text || '')
                    .trim()
                    .split(/\s+/)
                    .filter(Boolean)
                    .length;
            }

            function update() {
                const n = countWords(textarea.value);
                counter.textContent = n;
                counter.style.color = (n >= 250) ? '' : 'crimson';
            }

            textarea.addEventListener('input', update);
            update();
        })();
    </script>


</body>

</html>