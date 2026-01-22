<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\PosterDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class PosterRegistrationController extends Controller
{
    // If you want strict sector values later, move them here and validate with Rule::in()
    // public array $sectorOptions = [...];
    public array $sectorOptions = [
        "Information Technology",
        "Electronics & Semiconductor",
        "Drones & Robotics",
        "EV, Energy, Climate, Water, Soil, GSDI",
        "Telecommunications",
        "Cybersecurity",
        "Artificial Intelligence",
        "Cloud Services",
        "E-Commerce",
        "Automation",
        "AVGC",
        "Aerospace, Defence & Space Tech",
        "Mobility Tech",
        "Infrastructure",
        "Biotech",
        "Agritech",
        "Medtech",
        "Fintech",
        "Healthtech",
        "Edutech",
        "Startup",
        "Unicorn/ VCs",
        "Academia & University",
        "Tech Parks / Co-Working Spaces of India",
        "Banking / Insurance",
        "R&D and Central Govt.",
        "Others"
    ];
    public $countryList = array(
        "AF" => "Afghanistan",
        "AL" => "Albania",
        "DZ" => "Algeria",
        "AS" => "AmericanSamoa",
        "AD" => "Andorra",
        "AO" => "Angola",
        "AI" => "Anguilla",
        "AQ" => "Antarctica",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BA" => "BosniaandHerzegowina",
        "BW" => "Botswana",
        "BV" => "BouvetIsland",
        "BR" => "Brazil",
        "IO" => "BritishIndianOceanTerritory",
        "BN" => "BruneiDarussalam",
        "BG" => "Bulgaria",
        "BF" => "BurkinaFaso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",
        "CA" => "Canada",
        "CV" => "CapeVerde",
        "KY" => "CaymanIslands",
        "CF" => "CentralAfricanRepublic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CX" => "ChristmasIsland",
        "CC" => "Cocos(Keeling)Islands",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo",
        "CD" => "Congo,theDemocraticRepublicofthe",
        "CK" => "CookIslands",
        "CR" => "CostaRica",
        "CI" => "Coted'Ivoire",
        "HR" => "Croatia(Hrvatska)",
        "CU" => "Cuba",
        "CY" => "Cyprus",
        "CZ" => "CzechRepublic",
        "DK" => "Denmark",
        "DJ" => "Djibouti",
        "DM" => "Dominica",
        "DO" => "DominicanRepublic",
        "EC" => "Ecuador",
        "EG" => "Egypt",
        "SV" => "ElSalvador",
        "GQ" => "EquatorialGuinea",
        "ER" => "Eritrea",
        "EE" => "Estonia",
        "ET" => "Ethiopia",
        "FK" => "FalklandIslands(Malvinas)",
        "FO" => "FaroeIslands",
        "FJ" => "Fiji",
        "FI" => "Finland",
        "FR" => "France",
        "GF" => "FrenchGuiana",
        "PF" => "FrenchPolynesia",
        "TF" => "FrenchSouthernTerritories",
        "GA" => "Gabon",
        "GM" => "Gambia",
        "GE" => "Georgia",
        "DE" => "Germany",
        "GH" => "Ghana",
        "GI" => "Gibraltar",
        "GR" => "Greece",
        "GL" => "Greenland",
        "GD" => "Grenada",
        "GP" => "Guadeloupe",
        "GU" => "Guam",
        "GT" => "Guatemala",
        "GN" => "Guinea",
        "GW" => "Guinea-Bissau",
        "GY" => "Guyana",
        "HT" => "Haiti",
        "HM" => "HeardandMcDonaldIslands",
        "VA" => "HolySee(VaticanCityState)",
        "HN" => "Honduras",
        "HK" => "HongKong",
        "HU" => "Hungary",
        "IS" => "Iceland",
        "IN" => "India",
        "ID" => "Indonesia",
        "IR" => "Iran(IslamicRepublicof)",
        "IQ" => "Iraq",
        "IE" => "Ireland",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JO" => "Jordan",
        "KZ" => "Kazakhstan",
        "KE" => "Kenya",
        "KI" => "Kiribati",
        "KP" => "Korea,DemocraticPeople'sRepublicof",
        "KR" => "Korea,Republicof",
        "KW" => "Kuwait",
        "KG" => "Kyrgyzstan",
        "LA" => "LaoPeople'sDemocraticRepublic",
        "LV" => "Latvia",
        "LB" => "Lebanon",
        "LS" => "Lesotho",
        "LR" => "Liberia",
        "LY" => "LibyanArabJamahiriya",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MO" => "Macau",
        "MK" => "Macedonia,TheFormerYugoslavRepublicof",
        "MG" => "Madagascar",
        "MW" => "Malawi",
        "MY" => "Malaysia",
        "MV" => "Maldives",
        "ML" => "Mali",
        "MT" => "Malta",
        "MH" => "MarshallIslands",
        "MQ" => "Martinique",
        "MR" => "Mauritania",
        "MU" => "Mauritius",
        "YT" => "Mayotte",
        "MX" => "Mexico",
        "FM" => "Micronesia,FederatedStatesof",
        "MD" => "Moldova,Republicof",
        "MC" => "Monaco",
        "MN" => "Mongolia",
        "MS" => "Montserrat",
        "MA" => "Morocco",
        "MZ" => "Mozambique",
        "MM" => "Myanmar",
        "NA" => "Namibia",
        "NR" => "Nauru",
        "NP" => "Nepal",
        "NL" => "Netherlands",
        "AN" => "NetherlandsAntilles",
        "NC" => "NewCaledonia",
        "NZ" => "NewZealand",
        "NI" => "Nicaragua",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "NU" => "Niue",
        "NF" => "NorfolkIsland",
        "MP" => "NorthernMarianaIslands",
        "NO" => "Norway",
        "OM" => "Oman",
        "PK" => "Pakistan",
        "PW" => "Palau",
        "PA" => "Panama",
        "PG" => "PapuaNewGuinea",
        "PY" => "Paraguay",
        "PE" => "Peru",
        "PH" => "Philippines",
        "PN" => "Pitcairn",
        "PL" => "Poland",
        "PT" => "Portugal",
        "PR" => "PuertoRico",
        "QA" => "Qatar",
        "RE" => "Reunion",
        "RO" => "Romania",
        "RU" => "RussianFederation",
        "RW" => "Rwanda",
        "KN" => "SaintKittsandNevis",
        "LC" => "SaintLUCIA",
        "VC" => "SaintVincentandtheGrenadines",
        "WS" => "Samoa",
        "SM" => "SanMarino",
        "ST" => "SaoTomeandPrincipe",
        "SA" => "SaudiArabia",
        "SN" => "Senegal",
        "SC" => "Seychelles",
        "SL" => "SierraLeone",
        "SG" => "Singapore",
        "SK" => "Slovakia(SlovakRepublic)",
        "SI" => "Slovenia",
        "SB" => "SolomonIslands",
        "SO" => "Somalia",
        "ZA" => "SouthAfrica",
        "GS" => "SouthGeorgiaandtheSouthSandwichIslands",
        "ES" => "Spain",
        "LK" => "SriLanka",
        "SH" => "St.Helena",
        "PM" => "St.PierreandMiquelon",
        "SD" => "Sudan",
        "SR" => "Suriname",
        "SJ" => "SvalbardandJanMayenIslands",
        "SZ" => "Swaziland",
        "SE" => "Sweden",
        "CH" => "Switzerland",
        "SY" => "SyrianArabRepublic",
        "TW" => "Taiwan,ProvinceofChina",
        "TJ" => "Tajikistan",
        "TZ" => "Tanzania,UnitedRepublicof",
        "TH" => "Thailand",
        "TG" => "Togo",
        "TK" => "Tokelau",
        "TO" => "Tonga",
        "TT" => "TrinidadandTobago",
        "TN" => "Tunisia",
        "TR" => "Turkey",
        "TM" => "Turkmenistan",
        "TC" => "TurksandCaicosIslands",
        "TV" => "Tuvalu",
        "UG" => "Uganda",
        "UA" => "Ukraine",
        "AE" => "UnitedArabEmirates",
        "GB" => "UnitedKingdom",
        "US" => "UnitedStates",
        "UM" => "UnitedStatesMinorOutlyingIslands",
        "UY" => "Uruguay",
        "UZ" => "Uzbekistan",
        "VU" => "Vanuatu",
        "VE" => "Venezuela",
        "VN" => "VietNam",
        "VG" => "VirginIslands(British)",
        "VI" => "VirginIslands(U.S.)",
        "WF" => "WallisandFutunaIslands",
        "EH" => "WesternSahara",
        "YE" => "Yemen",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe"
    );

    // STEP 1 (blank)
    public function create()
    {
        return view('poster.register', [
            'draft' => null,
            'sectorOptions' => $this->sectorOptions,
            'countryList' => $this->countryList,
        ]);
    }

    // STEP 1 (prefilled)
    public function edit(Request $request, string $token)
    {
        $draft = PosterDraft::where('token', $token)->firstOrFail();

        $sessionToken = $request->session()->get('poster_draft_token');
        if ($sessionToken !== $token) {
            abort(403, 'This draft does not belong to your session.');
        }

        return view('poster.register', [
            'draft' => $draft,
            'sectorOptions' => $this->sectorOptions,
            'countryList' => $this->countryList,
        ]);
    }

    // STEP 1 POST: create OR update draft
    public function storeDraft(Request $request)
    {
        $validated = $request->validate([

            'g-recaptcha-response' => ['required'],

            'token' => ['nullable', 'uuid'],

            // Core
            'sector'       => ['required', Rule::in($this->sectorOptions)],
            'nationality'  => ['required', Rule::in(['India', 'International'])],
            'title'        => ['required', 'string', 'max:200'],

            // Lead Author
            'lead_name'    => ['required', 'string', 'max:200'],
            // 'lead_email'   => ['required', 'email', 'max:200'],
            'lead_email' => [
                'required',
                'email',
                'max:200',
                function ($attribute, $value, $fail) {
                    $email = strtolower(trim($value));

                    $exists = \App\Models\Poster::query()
                        ->where('lead_email', $email)
                        ->orWhere('pp_email', $email)
                        ->exists();

                    if ($exists) {
                        $fail('Lead auther email already registered.');
                    }
                },
            ],
            'lead_org'     => ['required', 'string', 'max:250'],
            // 'lead_ccode'   => ['nullable', 'string', 'max:5'],
            // 'lead_phone'   => ['required', 'string', 'max:15'],
            'lead_ccode' => ['nullable', 'regex:/^\+\d{1,4}$/'],
            'lead_phone' => ['required', 'regex:/^\d{6,15}$/'],

            'lead_addr'    => ['required', 'string'],
            'lead_city'    => ['required', 'string', 'max:120'],
            'lead_state'   => ['required', 'string', 'max:120'],
            'lead_country' => ['required', Rule::in(array_values($this->countryList))],
            'lead_zip'     => ['required', 'string', 'max:30'],

            // Poster Presenter
            'pp_name'      => ['required', 'string', 'max:200'],
            'pp_email'     => ['required', 'email', 'max:200'],
            // 'pp_email' => [
            //     'required',
            //     'email',
            //     'max:200',
            //     function ($attribute, $value, $fail) {
            //         $email = strtolower(trim($value));

            //         $exists = \App\Models\Poster::query()
            //             ->where('lead_email', $email)
            //             ->orWhere('pp_email', $email)
            //             ->exists();

            //         if ($exists) {
            //             $fail('Poster Presenter email already registered.');
            //         }
            //     },
            // ],
            'pp_org'       => ['required', 'string', 'max:250'],
            'pp_website'   => ['nullable', 'url', 'max:255'],
            // 'pp_ccode'     => ['nullable', 'string', 'max:5'],
            // 'pp_phone'     => ['required', 'string', 'max:15'],
            'pp_ccode' => ['nullable', 'regex:/^\+\d{1,4}$/'],
            'pp_phone' => ['required', 'regex:/^\d{6,15}$/'],

            'pp_addr'      => ['required', 'string'],
            'pp_city'      => ['required', 'string', 'max:120'],
            'pp_state'     => ['required', 'string', 'max:120'],
            'pp_country'   => ['required', Rule::in(array_values($this->countryList))],
            'pp_zip'       => ['required', 'string', 'max:30'],

            // Co-authors
            'co_auth_name_1' => ['nullable', 'string', 'max:200'],
            'co_auth_name_2' => ['nullable', 'string', 'max:200'],
            'co_auth_name_3' => ['nullable', 'string', 'max:200'],
            'co_auth_name_4' => ['nullable', 'string', 'max:200'],

            // Accompanying co-authors
            'acc_co_auth_name_1' => ['nullable', 'string', 'max:200'],
            'acc_co_auth_name_2' => ['nullable', 'string', 'max:200'],
            'acc_co_auth_name_3' => ['nullable', 'string', 'max:200'],
            'acc_co_auth_name_4' => ['nullable', 'string', 'max:200'],

            // Theme + Abstract
            'theme'         => ['nullable', 'string', 'max:150'],
            // 'abstract_text' => ['required', 'string'],
            'abstract_text' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $words = preg_split('/\s+/', trim((string) $value));
                    $words = array_filter($words, fn($w) => $w !== '');
                    if (count($words) < 250) {
                        $fail('Abstract must be at least 250 words.');
                    }
                },
            ],


            // Files
            // 'sess_abstract' => ['nullable', 'file', 'max:2048', 'mimes:doc,docx,pdf'], // 2MB
            // 'lead_auth_cv'  => ['nullable', 'file', 'max:2048', 'mimes:doc,docx,pdf'],  // 2MB
            'sess_abstract' => [
                Rule::requiredIf(function () use ($request) {

                    $token = $request->input('token');

                    if (!$token) return true; // new draft must upload
                    $draft = PosterDraft::where('token', $token)->first();
                    return empty($draft?->sess_abstract_path); // require if not already uploaded
                }),
                'file',
                'max:2048',
                'mimes:doc,docx,pdf'
            ],
            'lead_auth_cv' => [
                Rule::requiredIf(function () use ($request) {

                    $token = $request->input('token');

                    if (!$token) return true;
                    $draft = PosterDraft::where('token', $token)->first();
                    return empty($draft?->lead_auth_cv_path);
                }),
                'file',
                'max:2048',
                'mimes:doc,docx,pdf'
            ],


            // Payment (all optional for now)
            // 'paymode'          => ['nullable', 'string', 'max:50'],
            'paymode' => ['required', Rule::in([
                'CCAvenue (Indian Payments)',
                'PayPal (International payments)',
            ])],
            'currency'         => ['nullable', Rule::in(['INR', 'USD'])], // if you change to enum, keep validation in ['INR','USD']
            'base_amount'      => ['nullable',  'numeric'],
            'total_amount'     => ['nullable',  'numeric'],
            'discount_code'    => ['nullable',   'string', 'max:100'],
            'discount_amount'  => ['nullable',  'numeric'],
            'gst_amount'       => ['nullable',  'numeric'],
            'processing_fee'   => ['nullable',  'numeric'],

            // Extra fields (we accept but will recompute)
            'acc_count'         => ['nullable', 'integer', 'min:0', 'max:4'],
            'acc_unit_cost'     => ['nullable', 'numeric', 'min:0'],
            'additional_charge' => ['nullable', 'numeric', 'min:0'],
        ]);

        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(), // optional
        ]);

        $data = $recaptcha->json();

        if (!($data['success'] ?? false)) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.',
            ]);
        }

        $token = $validated['token'] ?? null;
        unset($validated['token']);

        // Handle uploads into $validated so create/update can use it
        $validated = $this->handleUploads($request, $validated);

        /*
    |--------------------------------------------------------------------------
    | SERVER-SIDE AUTHORITATIVE PRICING (ADD HERE) 
    | egs: base amount, discount, gst, processing fee, total
    |--------------------------------------------------------------------------
    | We recompute pricing based on nationality + accompanying count so users
    | cannot manipulate hidden fields.
    */
        $nat = $validated['nationality'];

        // Base values by nationality
        $currency = $nat === 'India' ? 'INR' : 'USD';
        $baseAmount = $nat === 'India' ? 3000 : 50;

        // Force paymode to match nationality (don’t trust client)
        $validated['paymode'] = $nat === 'India'
            ? 'CCAvenue (Indian Payments)'
            : 'PayPal (International payments)';

        $validated['currency'] = $currency;
        $validated['base_amount'] = $this->money((float) $baseAmount);

        $discount = (float) ($validated['discount_amount'] ?? 0);

        // Force safe defaults so NOT NULL decimal columns never get NULL
        $validated['discount_amount'] = $this->money($discount);
        $validated['discount_code'] = $validated['discount_code'] ?? null; // ok to be null if column is nullable

        // Count accompanying co-authors from the actual name fields
        $accCount = $this->countAccompanying($validated);

        // Your current rule: unit cost = base amount
        $accUnitCost = (float) $baseAmount;
        $additional = $accUnitCost * $accCount;

        // Subtotal = base + additional - discount
        $subTotal = ($baseAmount + $additional) - $discount;
        if ($subTotal < 0) $subTotal = 0;

        // GST = 18% of subtotal
        $gst = $subTotal * 0.18;

        // Processing fee = on (subtotal + gst)
        $procRate = $nat === 'India' ? 0.03 : 0.09;
        $processing = ($subTotal + $gst) * $procRate;

        // Total
        $total = $subTotal + $gst + $processing;

        // Store breakdown fields
        $validated['acc_count'] = $accCount;
        $validated['acc_unit_cost'] = $this->money($accUnitCost);
        $validated['additional_charge'] = $this->money($additional);

        $validated['gst_amount'] = $this->money($gst);
        $validated['processing_fee'] = $this->money($processing);
        $validated['total_amount'] = $this->money($total);

        // Create or update draft
        if ($token) {
            $draft = PosterDraft::where('token', $token)->firstOrFail();

            $sessionToken = $request->session()->get('poster_draft_token');
            if ($sessionToken !== $token) {
                abort(403, 'This registration page does not belong to your session.');
            }

            $draft->update($validated);
        } else {
            $draft = PosterDraft::create([
                'token' => (string) Str::uuid(),
                'status' => 'draft',
                ...$validated,
            ]);

            $request->session()->put('poster_draft_token', $draft->token);
        }

        return redirect()->route('poster.preview', ['token' => $draft->token]);
    }

    // STEP 2: preview
    public function preview(Request $request, string $token)
    {
        $draft = PosterDraft::where('token', $token)->firstOrFail();

        $sessionToken = $request->session()->get('poster_draft_token');
        if ($sessionToken !== $token) {
            abort(403, 'This draft does not belong to your session.');
        }

        return view('poster.preview', compact('draft'));
    }

    // STEP 2: final submit → posters table, keep drafts as backup
    public function submit(Request $request, string $token)
    {
        $draft = PosterDraft::where('token', $token)->firstOrFail();

        $sessionToken = $request->session()->get('poster_draft_token');
        if ($sessionToken !== $token) {
            abort(403, 'This draft does not belong to your session.');
        }

        // Idempotency: prevent multiple poster rows for same draft token
        $existing = Poster::where('draft_token', $draft->token)->first();
        if ($existing) {
            // already submitted earlier
            $request->session()->forget('poster_draft_token');
            return redirect()->route('poster.success', ['id' => $existing->id]);
        }

        $poster = Poster::create([
            'draft_token' => $draft->token,

            // Copy all the same fields
            'sector'       => $draft->sector,
            'nationality'  => $draft->nationality,
            'title'        => $draft->title,

            'lead_name'    => $draft->lead_name,
            'lead_email'   => $draft->lead_email,
            'lead_org'     => $draft->lead_org,
            'lead_ccode'   => $draft->lead_ccode,
            'lead_phone'   => $draft->lead_phone,
            'lead_addr'    => $draft->lead_addr,
            'lead_city'    => $draft->lead_city,
            'lead_state'   => $draft->lead_state,
            'lead_country' => $draft->lead_country,
            'lead_zip'     => $draft->lead_zip,

            'pp_name'      => $draft->pp_name,
            'pp_email'     => $draft->pp_email,
            'pp_org'       => $draft->pp_org,
            'pp_website'   => $draft->pp_website,
            'pp_ccode'     => $draft->pp_ccode,
            'pp_phone'     => $draft->pp_phone,
            'pp_addr'      => $draft->pp_addr,
            'pp_city'      => $draft->pp_city,
            'pp_state'     => $draft->pp_state,
            'pp_country'   => $draft->pp_country,
            'pp_zip'       => $draft->pp_zip,

            'co_auth_name_1' => $draft->co_auth_name_1,
            'co_auth_name_2' => $draft->co_auth_name_2,
            'co_auth_name_3' => $draft->co_auth_name_3,
            'co_auth_name_4' => $draft->co_auth_name_4,

            'acc_co_auth_name_1' => $draft->acc_co_auth_name_1,
            'acc_co_auth_name_2' => $draft->acc_co_auth_name_2,
            'acc_co_auth_name_3' => $draft->acc_co_auth_name_3,
            'acc_co_auth_name_4' => $draft->acc_co_auth_name_4,

            'theme'         => $draft->theme,
            'abstract_text' => $draft->abstract_text,

            'sess_abstract_path'          => $draft->sess_abstract_path,
            'sess_abstract_original_name' => $draft->sess_abstract_original_name,
            'sess_abstract_size'          => $draft->sess_abstract_size,
            'sess_abstract_mime'          => $draft->sess_abstract_mime,

            'lead_auth_cv_path'           => $draft->lead_auth_cv_path,
            'lead_auth_cv_original_name'  => $draft->lead_auth_cv_original_name,
            'lead_auth_cv_size'           => $draft->lead_auth_cv_size,
            'lead_auth_cv_mime'           => $draft->lead_auth_cv_mime,

            'paymode'         => $draft->paymode,
            'currency'        => $draft->currency,
            'base_amount'     => $draft->base_amount,
            'discount_code'   => $draft->discount_code,
            'discount_amount' => $draft->discount_amount,
            'gst_amount'      => $draft->gst_amount,
            'processing_fee'  => $draft->processing_fee,
            'total_amount'    => $draft->total_amount,

            'acc_count'         => $draft->acc_count,
            'acc_unit_cost'     => $draft->acc_unit_cost,
            'additional_charge' => $draft->additional_charge,

            'status' => 'submitted',
        ]);

        // Mark draft as submitted (backup remains)
        $draft->update(['status' => 'submitted']);

        // Clear session token
        $request->session()->forget('poster_draft_token');

        return redirect()->route('poster.success', ['id' => $poster->id]);
    }

    // STEP 3: success
    public function success(int $id)
    {
        $poster = Poster::findOrFail($id);
        return view('poster.success', compact('poster'));
    }

    private function handleUploads(Request $request, array $data): array
    {
        // sess_abstract file
        if ($request->hasFile('sess_abstract')) {
            $file = $request->file('sess_abstract');
            $path = $file->store('sess_abstract', 'public');

            $data['sess_abstract_path'] = $path;
            $data['sess_abstract_original_name'] = $file->getClientOriginalName();
            $data['sess_abstract_size'] = $file->getSize();
            $data['sess_abstract_mime'] = $file->getMimeType();
        }

        // lead_auth_cv file
        if ($request->hasFile('lead_auth_cv')) {
            $file = $request->file('lead_auth_cv');
            $path = $file->store('lead_auth_cv', 'public');

            $data['lead_auth_cv_path'] = $path;
            $data['lead_auth_cv_original_name'] = $file->getClientOriginalName();
            $data['lead_auth_cv_size'] = $file->getSize();
            $data['lead_auth_cv_mime'] = $file->getMimeType();
        }

        return $data;
    }

    // AJAX: check if email exists in posters or drafts
    public function checkEmail(Request $request)
    {
        $email = strtolower(trim((string) $request->query('email')));

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'ok' => false,
                'message' => 'Invalid email.',
                'exists' => false,
            ], 422);
        }

        // Cache key (short TTL to keep it fresh)
        $cacheKey = 'poster_email_exists:' . sha1($email);

        $exists = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($email) {
            // Check in posters (final) first (most important)
            $inPosters = \App\Models\Poster::query()
                ->where('lead_email', $email)
                ->orWhere('pp_email', $email)
                ->exists();

            if ($inPosters) return true;

            // Optional: also block if present in drafts
            // $inDrafts = \App\Models\PosterDraft::query()
            //     ->where('lead_email', $email)
            //     ->orWhere('pp_email', $email)
            //     ->exists();

            // return $inDrafts;
            return false;
        });

        return response()->json([
            'ok' => true,
            'exists' => $exists,
            'message' => $exists ? 'Email is already registered.' : 'Email is available.',
        ]);
    }

    // Count non-empty accompanying co-authors
    private function countAccompanying(array $data): int
    {
        $fields = [
            'acc_co_auth_name_1',
            'acc_co_auth_name_2',
            'acc_co_auth_name_3',
            'acc_co_auth_name_4',
        ];

        $count = 0;
        foreach ($fields as $f) {
            if (!empty(trim((string)($data[$f] ?? '')))) {
                $count++;
            }
        }
        return $count;
    }

    private function money(float $v): float
    {
        return round($v, 2);
    }
}
