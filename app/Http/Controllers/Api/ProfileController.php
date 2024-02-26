<?php

namespace App\Http\Controllers\Api;

use App\Constants\Position;
use App\Http\Controllers\Controller;
use App\Models\CandidatePosition;
use App\Models\CandidateStatus;
use App\Transformers\ProfileTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Can;

/**
 * @group Profile
 */
class ProfileController extends Controller
{
    protected $successStatus = 200;

    /**
     * Profile
     *
     * This endpoint will be used to get the profile of the user.
     *
     * @response {
     * "message": "Profile fetched successfully.",
     * "status": true,
     * "data": {
     *     "id": 128,
     *     "full_name": "SWARNADWIP NATH",
     *     "email": "SWARNADWIP@EXCELLISIT.NET",
     *     "phone": "+918653996036",
     *     "enter_by": "Admin Admin",
     *     "status": "ACTIVE",
     *     "passport_no": null,
     *     "mode_of_registration": "CALLING",
     *     "referred_by": "Dilip Kumar Das",
     *     "last_updated_at": "08.02.2024",
     *     "gender": "MALE",
     *     "dob": "10.08.2000",
     *     "age": 23,
     *     "education": "GRADUATES",
     *     "other_education": null,
     *     "alternate_contact_no": null,
     *     "whatapp_no": "+918653996036",
     *     "city": "KOLKATA",
     *     "religion": "HINDU",
     *     "ecr_type": "ECR",
     *     "english_speak": "GOOD",
     *     "arabic_speak": "NO",
     *     "gulf_return": 1,
     *     "indian_experience": "1 YEAR EXPERIENCE IN LARAVEL",
     *     "gulf_experience": null,
     *     "poition_applied_for": "WEB DEVELOPER",
     *     "position_applied_for_1": null,
     *     "position_applied_for_2": null,
     *     "created_at": "2024-02-08 10:18:18"
     *   }
     * }
     */

    public function my(Request $request)
    {
        try {
            $user = $request->user();
            $user = fractal($user, new ProfileTransformer())->toArray()['data'];
            return response()->json(['message' => 'Profile fetched successfully.', 'status' => true, 'data' => $user], $this->successStatus);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }

    /**
     * Update Profile
     *
     * This endpoint will be used to update the profile of the user.
     * @bodyParam full_name string required Full Name of the user. Example: John Doe
     * @bodyParam cnadidate_status_id integer required Candidate Status ID. Example: 1
     * @bodyParam email string Email of the user. Example:
     * @bodyParam position_applied_for_1 integer required Position Applied For 1. Example: 1
     * @bodyParam position_applied_for_2 integer Position Applied For 2. Example: 2
     * @bodyParam position_applied_for_3 integer Position Applied For 3. Example: 3
     * @bodyParam alternate_contact_no integer Alternate Contact Number of the user. Example: 9876543210
     * @bodyParam whatapp_no integer Whatapp Number of the user. Example: 9876543210
     * @bodyParam passport_number string Passport Number of the user. Example: A1234567
     * @bodyParam gender string Gender of the user. Example: MALE, FEMALE, OTHER
     * @bodyParam date_of_birth date Date of Birth of the user. Example: 2000-01-01
     * @bodyParam mode_of_registration string Mode of Registration of the user. Example: CALLING, WALK-IN
     * @bodyParam source string Source of the user. Example: TELECALLING, REFERANCE, FACEBOOK, INSTAGRAM, OTHER
     * @bodyParam education string Education of the user. Example: 5TH PASS, 8TH PASS, 10TH PASS, HIGHER SECONDARY, GRADUATES, MASTERS
     * @bodyParam other_education string Other Education of the user. Example: Other Education
     * @bodyParam religion string Religion of the user. Example: HINDU, ISLAM, CHRISTIAN, BUDDHIST, SIKH, JAIN, OTHER
     * @bodyParam ecr_type string ECR Type of the user. Example: ECR, ECNR
     * @bodyParam english_speak string English Speak of the user. Example: GOOD, BASIC, POOR, NO
     * @bodyParam arabic_speak string Arabic Speak of the user. Example: GOOD, BASIC, POOR, NO
     * @response {
     * "message": "Profile updated successfully.",
     * "status": true,
     *     "id": 128,
     *     "full_name": "SWARNADWIP NATH",
     *     "email": "SWARNADWIP@EXCELLISIT.NET",
     *     "phone": "+918653996036",
     *     "enter_by": "Admin Admin",
     *     "status": "ACTIVE",
     *     "passport_no": null,
     *     "mode_of_registration": "CALLING",
     *     "referred_by": "Dilip Kumar Das",
     *     "last_updated_at": "08.02.2024",
     *     "gender": "MALE",
     *     "dob": "10.08.2000",
     *     "age": 23,
     *     "education": "GRADUATES",
     *     "other_education": null,
     *     "alternate_contact_no": null,
     *     "whatapp_no": "+918653996036",
     *     "city": "KOLKATA",
     *     "religion": "HINDU",
     *     "ecr_type": "ECR",
     *     "english_speak": "GOOD",
     *     "arabic_speak": "NO",
     *     "gulf_return": 1,
     *     "indian_experience": "1 YEAR EXPERIENCE IN LARAVEL",
     *     "gulf_experience": null,
     *     "poition_applied_for": "WEB DEVELOPER",
     *     "position_applied_for_1": null,
     *     "position_applied_for_2": null,
     *     "created_at": "2024-02-08 10:18:18"
     *   }
     * }
     */

    public function update(Request $request)
    {
        // return $request->user()->id;
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'cnadidate_status_id' => 'required|exists:candidate_statuses,id',
            'email' => 'nullable|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:candidates,email,' . $request->user()->id,
            'position_applied_for_1' => 'required|exists:candidate_positions,id',
            'position_applied_for_2' => 'nullable|exists:candidate_positions,id',
            'position_applied_for_3' => 'nullable|exists:candidate_positions,id',
            'alternate_contact_no' => 'nullable|digits:10',
            'whatapp_no' => 'nullable|regex:/^\+91\d{10}$/',
            'passport_number' => 'nullable|regex:/^[A-Za-z]\d{7}$/',
            'gender' => 'nullable|in:MALE,FEMALE,OTHER',
            'date_of_birth' => 'nullable|date_format:Y-m-d',
            'mode_of_registration' => 'nullable|in:CALLING,WALK-IN',
            'source' => 'nullable|in:TELECALLING,REFERANCE,FACEBOOK,INSTAGRAM,OTHER',
            'education' => 'nullable|in:5TH PASS,8TH PASS,10TH PASS,HIGHER SECONDARY,GRADUATES,MASTERS',
            'other_education' => 'nullable',
            'religion' => 'nullable|in:HINDU,ISLAM,CHRISTIAN,BUDDHIST,SIKH,JAIN,OTHER',
            'ecr_type' => 'nullable|in:ECR,ECNR',
            'english_speak' => 'nullable|in:GOOD,BASIC,POOR,NO',
            'arabic_speak' => 'nullable|in:GOOD,BASIC,POOR,NO',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
        }

        try {
            $user = $request->user();
            $user->update($request->all());
            $user = fractal($user, new ProfileTransformer())->toArray()['data'];
            return response()->json(['message' => 'Profile updated successfully.', 'status' => true, 'data' => $user], $this->successStatus);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }

    /**
     * Edit Profile
     *
     * This endpoint will be used to edit the profile of the user.
     * @response {
     * "message": "Profile fetched successfully.",
     * "status": true,
     *"data": {
     *        "status": {
     *            "1": "ACTIVE",
     *            "2": "IN-ACTIVE",
     *            "3": "BLACK LIST",
     *            "4": "SELECTED",
     *            "5": "BACKED OUT",
     *            "6": "UNDER MEDICAL",
     *            "7": "FIT",
     *            "8": "UNFIT",
     *            "9": "AWAITING VISA",
     *            "10": "AWAITING DEPLOYMENT",
     *            "11": "DEPLOYED"
     *        },
     *        "mode_of_registration": [
     *            "CALLING",
     *            "WALK-IN"
     *        ],
     *        "source": [
     *            "TELECALLING",
     *            "REFERANCE",
     *            "FACEBOOK",
     *            "INSTAGRAM",
     *            "OTHER"
     *        ],
     *        "gender": [
     *            "MALE",
     *            "FEMALE",
     *            "OTHER"
     *        ],
     *        "education": [
     *            "5TH PASS",
     *            "8TH PASS",
     *            "10TH PASS",
     *            "HIGHER SECONDARY",
     *            "GRADUATES",
     *            "MASTERS"
     *        ],
     *        "positions": {
     *            "1": "AC TECHNICIAN SPLIT & WINDOW",
     *            "2": "ACCOUNTANT",
     *            "3": "ALUMINIUM FABRICATOR",
     *            "4": "ANIMAL WARDEN",
     *            "5": "ANY HELPER",
     *            "6": "ARABIC CHEF",
     *            "7": "AREA RESTAURANT MANAGER",
     *            "8": "ASST. ELECTRICIAN",
     *            "9": "ASST. COOK",
     *            "10": "ASST. PLUMBER",
     *            "11": "ASST. RESTAURANT MANAGER",
     *            "12": "ASST. SUPERVISOR",
     *            "13": "ASST. WAITER",
     *            "14": "AUTO AC TECHNICIAN",
     *            "15": "AUTO ELECTRICIAN",
     *            "16": "AUTO MOBILE ENG",
     *            "17": "AUTO MOBILE TECHNICIAN",
     *            "18": "AUTO CAD",
     *            "19": "CDP",
     *            "20": "CHEF",
     *            "21": "D-CDP",
     *            "22": "BAKERY & PASTRY MAN",
     *            "23": "SOUS CHEF",
     *            "24": "BAKERY MAN",
     *            "25": "MANAGER",
     *            "26": "BANQUET SUPERVISOR",
     *            "27": "BARTENDER",
     *            "28": "BARBER FEMALE",
     *            "29": "BARBER MALE",
     *            "30": "BARISTA",
     *            "31": "BELL BOY",
     *            "32": "BIKE MECHANIC",
     *            "33": "BOILER OPERATOR",
     *            "34": "BOUNCER",
     *            "35": "BULLDOZER OPERATOR",
     *            "36": "BUSSER",
     *            "37": "BUTCHER",
     *            "38": "BUTCHER & SLAUGHTERER",
     *            "39": "BUTCHER MACHINE CUTTER",
     *            "40": "CABLE JOINTER",
     *            "41": "CAMP BOSS",
     *            "42": "CAPTAIN",
     *            "43": "CASHIER",
     *            "44": "CATERING SUPERVISOR",
     *            "45": "CDP",
     *            "46": "CHAPATI MAKER",
     *            "47": "CHARTERED ACCOUNTANT",
     *            "48": "CIVIL ENGG",
     *            "49": "CIVIL FOREMAN",
     *            "50": "HELPER",
     *            "51": "CIVIL SUPERVISOR",
     *            "52": "COBBLER",
     *            "53": "COLD KITCHEN CHEF",
     *            "54": "COMPUTER EMBROIDER",
     *            "55": "COMPUTER ENGINEER",
     *            "56": "COMPUTER HARDWARE & NETWORKING",
     *            "57": "COMPUTER OPERATOR",
     *            "58": "COMPUTER TECHNICIAN",
     *            "59": "CONTINENTAL CHEF",
     *            "60": "CRANE OPERATOR",
     *            "61": "DELIVERY BOY",
     *            "62": "DENTER",
     *            "63": "DIALYSIS MACHINE TECHNICIAN",
     *            "64": "DOCTOR",
     *            "65": "DOCUMENT CONTROLLER",
     *            "66": "DRAFTSMAN CIVIL",
     *            "67": "DRAFTSMAN MECHANICAL",
     *            "68": "DRAUGHTSMEN",
     *            "69": "DUCT ERECTOR",
     *            "70": "DUCT FABRICATOR",
     *            "71": "DUCT INSULATOR",
     *            "72": "DUCTMAN",
     *            "73": "ELECTRICAL ENGINEER",
     *            "74": "ELECTRICAL SUPERVISOR",
     *            "75": "ELECTRICIAN 220",
     *            "76": "ELECTRICIAN 220 & 440",
     *            "77": "ELECTRICIAN 440",
     *            "78": "ELECTRICIAN PANEL BOARD",
     *            "79": "ELECTRICAL TECHNICIAN",
     *            "80": "EXCAVATOR OPERATOR",
     *            "81": "EXECUTIVE CHEF",
     *            "82": "F & B SERVICE",
     *            "83": "F & B SUPERVISOR",
     *            "84": "FEMALE NURSE",
     *            "85": "FINISHING CARPENTER",
     *            "86": "GARDENER",
     *            "87": "WELDER",
     *            "88": "COOK",
     *            "89": "GENTS TAILOR",
     *            "90": "GLASS DESIGNER",
     *            "91": "GOLD SMITH",
     *            "92": "GRAPHIC DESIGNER",
     *            "93": "GYM TRAINER",
     *            "94": "HOST",
     *            "95": "HOUSEKEEPER",
     *            "96": "HOUSEKEEPING SUPERVISOR",
     *            "97": "HR",
     *            "98": "HR MANAGER",
     *            "99": "HV DRIVER",
     *            "100": "HVAC CHILLER PLANT",
     *            "101": "HVAC FOREMAN",
     *            "102": "HVAC TECHNICIAN",
     *            "103": "IATA OFFICER",
     *            "104": "CHEF",
     *            "105": "INSTRUMENT TECHNICIAN",
     *            "106": "INTERIOR DESIGNER",
     *            "107": "IT ENGINEER",
     *            "108": "JCB OPERATOR",
     *            "109": "JUICE MAKER",
     *            "110": "KITCHEN STEWARD",
     *            "111": "LADIES TAILOR",
     *            "112": "LAND SURVEYOR",
     *            "113": "LAPTOP TECHNICIAN",
     *            "114": "LAUNDRY BOY",
     *            "115": "LAUNDRY SUPERVISOR",
     *            "116": "LIFT TECHNICIAN",
     *            "117": "LMV DRIVER",
     *            "118": "LOADING & UNLOADING",
     *            "119": "LOGISTIC MANAGER",
     *            "120": "LOGISTIC OFFICER",
     *            "121": "LOGISTIC SUPERVISOR",
     *            "122": "MACHINE EMBROIDER",
     *            "123": "MALE NURSE",
     *            "124": "MECHANICAL ENGINEER",
     *            "125": "HELPER",
     *            "126": "MECHANICAL SUPERVISOR",
     *            "127": "MERCHANDISER",
     *            "128": "MOBILE CRANE OPERATOR",
     *            "129": "MOBILE HARDWARE TECHNICIAN",
     *            "130": "MOBILE SOFTWARE TECHNICIAN",
     *            "131": "MOCKTAIL",
     *            "132": "OFFICE BOY",
     *            "133": "OFFICE MACHINE OPERATOR",
     *            "134": "PACKERS",
     *            "135": "PARATHA MAKER",
     *            "136": "PEST CONTROL",
     *            "137": "LMV MECHANIC PETROL",
     *            "138": "LMV MECHANIC DIESEL",
     *            "139": "HV MECHANIC PETROL",
     *            "140": "HV MECHANIC DIESEL",
     *            "141": "PHARMACIST",
     *            "142": "PHOTOGRAPHER",
     *            "143": "PIPE FITTER",
     *            "144": "PIZZA MAKER",
     *            "145": "PLUMBER",
     *            "146": "POCLAIN OPERATOR",
     *            "147": "POP",
     *            "148": "QURAAN HAFEEZ",
     *            "149": "RCC FITTER",
     *            "150": "RECEPTIONIST",
     *            "151": "REFRIGERATION TECHNICIAN",
     *            "152": "RESTAURANT MANAGER",
     *            "153": "RESTAURANT SHIFT MANAGER",
     *            "154": "RESTAURANT SUPERVISOR",
     *            "155": "RIGGER",
     *            "156": "ROOM BOY",
     *            "157": "RUNNER",
     *            "158": "SAFETY ENGINEER",
     *            "159": "SAFETY OFFICER",
     *            "160": "SALAD MAKER",
     *            "161": "SALES MANAGER",
     *            "162": "MANAGER",
     *            "163": "SCAFFOLDER",
     *            "164": "SCREEN PRINTER",
     *            "165": "SECURITY GUARD",
     *            "166": "SENIOR WAITER",
     *            "167": "SERVICE CREW",
     *            "168": "SERVICE QUALITY CONTROLLER",
     *            "169": "FOOD QUALITY CONTROLLER",
     *            "170": "SHUTTERING CARPENTER",
     *            "171": "SOFA MAKER",
     *            "172": "SOFTWARE DEVELOPER",
     *            "173": "SOUS CHEF",
     *            "174": "COOK",
     *            "175": "SPRAY PAINTER",
     *            "176": "STEEL FABRICATOR",
     *            "177": "STEEL FIXER",
     *            "178": "STEWARD",
     *            "179": "POTTER",
     *            "180": "STOREKEEPER",
     *            "181": "TEACHER",
     *            "182": "TELE CALLER",
     *            "183": "CHEF",
     *            "184": "MASON",
     *            "185": "TIMEKEEPER",
     *            "186": "TOWER CRANE OPERATOR",
     *            "187": "DRIVER",
     *            "188": "TYRE TECHNICIAN",
     *            "189": "UTILITY OPERATOR",
     *            "190": "WAITER",
     *            "191": "WALL PAINTER",
     *            "192": "WAREHOUSE MANAGER",
     *            "193": "WAREHOUSE SUPERVISOR",
     *            "194": "WEB DEVELOPER",
     *            "195": "WELDER",
     *            "196": "XRAY TECHNICIAN",
     *            "197": "Web Development",
     *            "198": "Graphics Designer",
     *            "199": "STORE MANAGER",
     *            "200": "UNKNOWN",
     *            "201": "CREW TRAINER",
     *            "202": "TANDOOR CHEF",
     *            "203": "TANDOOR COOK",
     *            "204": "SALESMAN",
     *            "205": "TROLLY BOY",
     *            "206": "WATER PUREFIRE TECHNICION",
     *            "207": "house keeping",
     *            "208": "clenear",
     *            "209": "DATA ENTERY",
     *            "210": "CARPENTER",
     *            "211": "DATA ANALYSIS",
     *            "212": "TEAM LEADER",
     *            "213": "PRODUCTION ENGINER",
     *            "214": "QUALITY CHECK",
     *            "215": "BACK OFFICE"
     *        },
     *        "city": [
     *            "ADILABAD",
     *            "AGRA",
     *            "AHMEDABAD",
     *            "AHMEDNAGAR",
     *            "AIZAWL",
     *            "AJITGARH (MOHALI)",
     *            "AJMER",
     *            "AKOLA",
     *            "ALAPPUZHA",
     *            "ALIGARH",
     *            "ALIRAJPUR",
     *            "ALLAHABAD",
     *            "ALMORA",
     *            "ALWAR",
     *            "AMBALA",
     *            "AMBEDKAR NAGAR",
     *            "AMRAVATI",
     *            "AMRELI DISTRICT",
     *            "AMRITSAR",
     *            "ANAND",
     *            "ANANTAPUR",
     *            "ANANTNAG",
     *            "ANGUL",
     *            "ANJAW",
     *            "ANUPPUR",
     *            "ARARIA",
     *            "ARIYALUR",
     *            "ARWAL",
     *            "ASHOK NAGAR",
     *            "AURAIYA",
     *            "AURANGABAD",
     *            "AURANGABAD",
     *            "AZAMGARH",
     *            "BADGAM",
     *            "BAGALKOT",
     *            "BAGESHWAR",
     *            "BAGPAT",
     *            "BAHRAICH",
     *            "BAKSA",
     *            "BALAGHAT",
     *            "BALANGIR",
     *            "BALASORE",
     *            "BALLIA",
     *            "BALRAMPUR",
     *            "BANASKANTHA",
     *            "BANDA",
     *            "BANDIPORA",
     *            "BANGALORE",
     *            "BANKA",
     *            "BANKURA",
     *            "BANSWARA",
     *            "BARABANKI",
     *            "BARAMULLA",
     *            "BARAN",
     *            "BARDHAMAN",
     *            "BAREILLY",
     *            "BARGARH (BARAGARH)",
     *            "BARMER",
     *            "BARNALA",
     *            "BARPETA",
     *            "BARWANI",
     *            "BASTAR",
     *            "BASTI",
     *            "BATHINDA",
     *            "BEED",
     *            "BEGUSARAI",
     *            "BELGAUM",
     *            "BELLARY",
     *            "BETUL",
     *            "BHADRAK",
     *            "BHAGALPUR",
     *            "BHANDARA",
     *            "BHARATPUR",
     *            "BHARUCH",
     *            "BHAVNAGAR",
     *            "BHILWARA",
     *            "BHIND",
     *            "BHIWANI",
     *            "BHOJPUR",
     *            "BHOPAL",
     *            "BIDAR",
     *            "BIJAPUR",
     *            "BIJAPUR",
     *            "BIJNOR",
     *            "BIKANER",
     *            "BILASPUR",
     *            "BILASPUR",
     *            "BIRBHUM",
     *            "BISHNUPUR",
     *            "BOKARO",
     *            "BONGAIGAON",
     *            "BOUDH (BAUDA)",
     *            "BUDAUN",
     *            "BULANDSHAHR",
     *            "BULDHANA",
     *            "BUNDI",
     *            "BURHANPUR",
     *            "BUXAR",
     *            "CACHAR",
     *            "CENTRAL DELHI",
     *            "CHAMARAJNAGAR",
     *            "CHAMBA",
     *            "CHAMOLI",
     *            "CHAMPAWAT",
     *            "CHAMPHAI",
     *            "CHANDAULI",
     *            "CHANDEL",
     *            "CHANDIGARH",
     *            "CHANDRAPUR",
     *            "CHANGLANG",
     *            "CHATRA",
     *            "CHENNAI",
     *            "CHHATARPUR",
     *            "CHHATRAPATI SHAHUJI MAHARAJ NAGAR",
     *            "CHHINDWARA",
     *            "CHIKKABALLAPUR",
     *            "CHIKKAMAGALURU",
     *            "CHIRANG",
     *            "CHITRADURGA",
     *            "CHITRAKOOT",
     *            "CHITTOOR",
     *            "CHITTORGARH",
     *            "CHURACHANDPUR",
     *            "CHURU",
     *            "COIMBATORE",
     *            "COOCH BEHAR",
     *            "CUDDALORE",
     *            "CUTTACK",
     *            "DADRA AND NAGAR HAVELI",
     *            "DAHOD",
     *            "DAKSHIN DINAJPUR",
     *            "DAKSHINA KANNADA",
     *            "DAMAN",
     *            "DAMOH",
     *            "DANTEWADA",
     *            "DARBHANGA",
     *            "DARJEELING",
     *            "DARRANG",
     *            "DATIA",
     *            "DAUSA",
     *            "DAVANAGERE",
     *            "DEBAGARH (DEOGARH)",
     *            "DEHRADUN",
     *            "DEOGHAR",
     *            "DEORIA",
     *            "DEWAS",
     *            "DHALAI",
     *            "DHAMTARI",
     *            "DHANBAD",
     *            "DHAR",
     *            "DHARMAPURI",
     *            "DHARWAD",
     *            "DHEMAJI",
     *            "DHENKANAL",
     *            "DHOLPUR",
     *            "DHUBRI",
     *            "DHULE",
     *            "DIBANG VALLEY",
     *            "DIBRUGARH",
     *            "DIMA HASAO",
     *            "DIMAPUR",
     *            "DINDIGUL",
     *            "DINDORI",
     *            "DIU",
     *            "DODA",
     *            "DUMKA",
     *            "DUNGAPUR",
     *            "DURG",
     *            "EAST CHAMPARAN",
     *            "EAST DELHI",
     *            "EAST GARO HILLS",
     *            "EAST KHASI HILLS",
     *            "EAST SIANG",
     *            "EAST SIKKIM",
     *            "EAST SINGHBHUM",
     *            "ELURU",
     *            "ERNAKULAM",
     *            "ERODE",
     *            "ETAH",
     *            "ETAWAH",
     *            "FAIZABAD",
     *            "FARIDABAD",
     *            "FARIDKOT",
     *            "FARRUKHABAD",
     *            "FATEHABAD",
     *            "FATEHGARH SAHIB",
     *            "FATEHPUR",
     *            "FAZILKA",
     *            "FIROZABAD",
     *            "FIROZPUR",
     *            "GADAG",
     *            "GADCHIROLI",
     *            "GAJAPATI",
     *            "GANDERBAL",
     *            "GANDHINAGAR",
     *            "GANGANAGAR",
     *            "GANJAM",
     *            "GARHWA",
     *            "GAUTAM BUDDH NAGAR",
     *            "GAYA",
     *            "GHAZIABAD",
     *            "GHAZIPUR",
     *            "GIRIDIH",
     *            "GOALPARA",
     *            "GODDA",
     *            "GOLAGHAT",
     *            "GONDA",
     *            "GONDIA",
     *            "GOPALGANJ",
     *            "GORAKHPUR",
     *            "GULBARGA",
     *            "GUMLA",
     *            "GUNA",
     *            "GUNTUR",
     *            "GURDASPUR",
     *            "GURGAON",
     *            "GWALIOR",
     *            "HAILAKANDI",
     *            "HAMIRPUR",
     *            "HAMIRPUR",
     *            "HANUMANGARH",
     *            "HARDA",
     *            "HARDOI",
     *            "HARIDWAR",
     *            "HASSAN",
     *            "HAVERI DISTRICT",
     *            "HAZARIBAG",
     *            "HINGOLI",
     *            "HISSAR",
     *            "HOOGHLY",
     *            "HOSHANGABAD",
     *            "HOSHIARPUR",
     *            "HOWRAH",
     *            "HYDERABAD",
     *            "HYDERABAD",
     *            "IDUKKI",
     *            "IMPHAL EAST",
     *            "IMPHAL WEST",
     *            "INDORE",
     *            "JABALPUR",
     *            "JAGATSINGHPUR",
     *            "JAINTIA HILLS",
     *            "JAIPUR",
     *            "JAISALMER",
     *            "JAJPUR",
     *            "JALANDHAR",
     *            "JALAUN",
     *            "JALGAON",
     *            "JALNA",
     *            "JALORE",
     *            "JALPAIGURI",
     *            "JAMMU",
     *            "JAMNAGAR",
     *            "JAMTARA",
     *            "JAMUI",
     *            "JANJGIR-CHAMPA",
     *            "JASHPUR",
     *            "JAUNPUR DISTRICT",
     *            "JEHANABAD",
     *            "JHABUA",
     *            "JHAJJAR",
     *            "JHALAWAR",
     *            "JHANSI",
     *            "JHARSUGUDA",
     *            "JHUNJHUNU",
     *            "JIND",
     *            "JODHPUR",
     *            "JORHAT",
     *            "JUNAGADH",
     *            "JYOTIBA PHULE NAGAR",
     *            "KABIRDHAM (FORMERLY KAWARDHA)",
     *            "KADAPA",
     *            "KAIMUR",
     *            "KAITHAL",
     *            "KAKINADA",
     *            "KALAHANDI",
     *            "KAMRUP",
     *            "KAMRUP METROPOLITAN",
     *            "KANCHIPURAM",
     *            "KANDHAMAL",
     *            "KANGRA",
     *            "KANKER",
     *            "KANNAUJ",
     *            "KANNUR",
     *            "KANPUR",
     *            "KANSHI RAM NAGAR",
     *            "KANYAKUMARI",
     *            "KAPURTHALA",
     *            "KARAIKAL",
     *            "KARAULI",
     *            "KARBI ANGLONG",
     *            "KARGIL",
     *            "KARIMGANJ",
     *            "KARIMNAGAR",
     *            "KARNAL",
     *            "KARUR",
     *            "KASARAGOD",
     *            "KATHUA",
     *            "KATIHAR",
     *            "KATNI",
     *            "KAUSHAMBI",
     *            "KENDRAPARA",
     *            "KENDUJHAR (KEONJHAR)",
     *            "KHAGARIA",
     *            "KHAMMAM",
     *            "KHANDWA (EAST NIMAR)",
     *            "KHARGONE (WEST NIMAR)",
     *            "KHEDA",
     *            "KHORDHA",
     *            "KHOWAI",
     *            "KHUNTI",
     *            "KINNAUR",
     *            "KISHANGANJ",
     *            "KISHTWAR",
     *            "KODAGU",
     *            "KODERMA",
     *            "KOHIMA",
     *            "KOKRAJHAR",
     *            "KOLAR",
     *            "KOLASIB",
     *            "KOLHAPUR",
     *            "KOLKATA",
     *            "KOLLAM",
     *            "KOPPAL",
     *            "KORAPUT",
     *            "KORBA",
     *            "KORIYA",
     *            "KOTA",
     *            "KOTTAYAM",
     *            "KOZHIKODE",
     *            "KRISHNA",
     *            "KULGAM",
     *            "KULLU",
     *            "KUPWARA",
     *            "KURNOOL",
     *            "KURUKSHETRA",
     *            "KURUNG KUMEY",
     *            "KUSHINAGAR",
     *            "KUTCH",
     *            "LAHAUL AND SPITI",
     *            "LAKHIMPUR",
     *            "LAKHIMPUR KHERI",
     *            "LAKHISARAI",
     *            "LALITPUR",
     *            "LATEHAR",
     *            "LATUR",
     *            "LAWNGTLAI",
     *            "LEH",
     *            "LOHARDAGA",
     *            "LOHIT",
     *            "LOWER DIBANG VALLEY",
     *            "LOWER SUBANSIRI",
     *            "LUCKNOW",
     *            "LUDHIANA",
     *            "LUNGLEI",
     *            "MADHEPURA",
     *            "MADHUBANI",
     *            "MADURAI",
     *            "MAHAMAYA NAGAR",
     *            "MAHARAJGANJ",
     *            "MAHASAMUND",
     *            "MAHBUBNAGAR",
     *            "MAHE",
     *            "MAHENDRAGARH",
     *            "MAHOBA",
     *            "MAINPURI",
     *            "MALAPPURAM",
     *            "MALDAH",
     *            "MALKANGIRI",
     *            "MAMIT",
     *            "MANDI",
     *            "MANDLA",
     *            "MANDSAUR",
     *            "MANDYA",
     *            "MANSA",
     *            "MARIGAON",
     *            "MATHURA",
     *            "MAU",
     *            "MAYURBHANJ",
     *            "MEDAK",
     *            "MEERUT",
     *            "MEHSANA",
     *            "MEWAT",
     *            "MIRZAPUR",
     *            "MOGA",
     *            "MOKOKCHUNG",
     *            "MON",
     *            "MORADABAD",
     *            "MORENA",
     *            "MUMBAI",
     *            "MUNGER",
     *            "MURSHIDABAD",
     *            "MUZAFFARNAGAR",
     *            "MUZAFFARPUR",
     *            "MYSORE",
     *            "NABARANGPUR",
     *            "NADIA",
     *            "NAGAON",
     *            "NAGAPATTINAM",
     *            "NAGAUR",
     *            "NAGPUR",
     *            "NAINITAL",
     *            "NALANDA",
     *            "NALBARI",
     *            "NALGONDA",
     *            "NAMAKKAL",
     *            "NANDED",
     *            "NANDURBAR",
     *            "NARAYANPUR",
     *            "NARMADA",
     *            "NARSINGHPUR",
     *            "NASHIK",
     *            "NAVSARI",
     *            "NAWADA",
     *            "NAWANSHAHR",
     *            "NAYAGARH",
     *            "NEEMUCH",
     *            "NELLORE",
     *            "NEW DELHI",
     *            "NILGIRIS",
     *            "NIZAMABAD",
     *            "NORTH 24 PARGANAS",
     *            "NORTH DELHI",
     *            "NORTH EAST DELHI",
     *            "NORTH GOA",
     *            "NORTH SIKKIM",
     *            "NORTH TRIPURA",
     *            "NORTH WEST DELHI",
     *            "NUAPADA",
     *            "ONGOLE",
     *            "OSMANABAD",
     *            "PAKUR",
     *            "PALAKKAD",
     *            "PALAMU",
     *            "PALI",
     *            "PALWAL",
     *            "PANCHKULA",
     *            "PANCHMAHAL",
     *            "PANCHSHEEL NAGAR DISTRICT (HAPUR)",
     *            "PANIPAT",
     *            "PANNA",
     *            "PAPUM PARE",
     *            "PARBHANI",
     *            "PASCHIM MEDINIPUR",
     *            "PATAN",
     *            "PATHANAMTHITTA",
     *            "PATHANKOT",
     *            "PATIALA",
     *            "PATNA",
     *            "PAURI GARHWAL",
     *            "PERAMBALUR",
     *            "PHEK",
     *            "PILIBHIT",
     *            "PITHORAGARH",
     *            "PONDICHERRY",
     *            "POONCH",
     *            "PORBANDAR",
     *            "PRATAPGARH",
     *            "PRATAPGARH",
     *            "PUDUKKOTTAI",
     *            "PULWAMA",
     *            "PUNE",
     *            "PURBA MEDINIPUR",
     *            "PURI",
     *            "PURNIA",
     *            "PURULIA",
     *            "RAEBARELI",
     *            "RAICHUR",
     *            "RAIGAD",
     *            "RAIGARH",
     *            "RAIPUR",
     *            "RAISEN",
     *            "RAJAURI",
     *            "RAJGARH",
     *            "RAJKOT",
     *            "RAJNANDGAON",
     *            "RAJSAMAND",
     *            "RAMABAI NAGAR (KANPUR DEHAT)",
     *            "RAMANAGARA",
     *            "RAMANATHAPURAM",
     *            "RAMBAN",
     *            "RAMGARH",
     *            "RAMPUR",
     *            "RANCHI",
     *            "RATLAM",
     *            "RATNAGIRI",
     *            "RAYAGADA",
     *            "REASI",
     *            "REWA",
     *            "REWARI",
     *            "RI BHOI",
     *            "ROHTAK",
     *            "ROHTAS",
     *            "RUDRAPRAYAG",
     *            "RUPNAGAR",
     *            "SABARKANTHA",
     *            "SAGAR",
     *            "SAHARANPUR",
     *            "SAHARSA",
     *            "SAHIBGANJ",
     *            "SAIHA",
     *            "SALEM",
     *            "SAMASTIPUR",
     *            "SAMBA",
     *            "SAMBALPUR",
     *            "SANGLI",
     *            "SANGRUR",
     *            "SANT KABIR NAGAR",
     *            "SANT RAVIDAS NAGAR",
     *            "SARAN",
     *            "SATARA",
     *            "SATNA",
     *            "SAWAI MADHOPUR",
     *            "SEHORE",
     *            "SENAPATI",
     *            "SEONI",
     *            "SERAIKELA KHARSAWAN",
     *            "SERCHHIP",
     *            "SHAHDOL",
     *            "SHAHJAHANPUR",
     *            "SHAJAPUR",
     *            "SHAMLI",
     *            "SHEIKHPURA",
     *            "SHEOHAR",
     *            "SHEOPUR",
     *            "SHIMLA",
     *            "SHIMOGA",
     *            "SHIVPURI",
     *            "SHOPIAN",
     *            "SHRAVASTI",
     *            "SIBSAGAR",
     *            "SIDDHARTHNAGAR",
     *            "SIDHI",
     *            "SIKAR",
     *            "SIMDEGA",
     *            "SINDHUDURG",
     *            "SINGRAULI",
     *            "SIRMAUR",
     *            "SIROHI",
     *            "SIRSA",
     *            "SITAMARHI",
     *            "SITAPUR",
     *            "SIVAGANGA",
     *            "SIWAN",
     *            "SOLAN",
     *            "SOLAPUR",
     *            "SONBHADRA",
     *            "SONIPAT",
     *            "SONITPUR",
     *            "SOUTH 24 PARGANAS",
     *            "SOUTH DELHI",
     *            "SOUTH GARO HILLS",
     *            "SOUTH GOA",
     *            "SOUTH SIKKIM",
     *            "SOUTH TRIPURA",
     *            "SOUTH WEST DELHI",
     *            "SRI MUKTSAR SAHIB",
     *            "SRIKAKULAM",
     *            "SRINAGAR",
     *            "SUBARNAPUR (SONEPUR)",
     *            "SULTANPUR",
     *            "SUNDERGARH",
     *            "SUPAUL",
     *            "SURAT",
     *            "SURENDRANAGAR",
     *            "SURGUJA",
     *            "TAMENGLONG",
     *            "TARN TARAN",
     *            "TAWANG",
     *            "TEHRI GARHWAL",
     *            "THANE",
     *            "THANJAVUR",
     *            "THE DANGS",
     *            "THENI",
     *            "THIRUVANANTHAPURAM",
     *            "THOOTHUKUDI",
     *            "THOUBAL",
     *            "THRISSUR",
     *            "TIKAMGARH",
     *            "TINSUKIA",
     *            "TIRAP",
     *            "TIRUCHIRAPPALLI",
     *            "TIRUNELVELI",
     *            "TIRUPUR",
     *            "TIRUVALLUR",
     *            "TIRUVANNAMALAI",
     *            "TIRUVARUR",
     *            "TONK",
     *            "TUENSANG",
     *            "TUMKUR",
     *            "UDAIPUR",
     *            "UDALGURI",
     *            "UDHAM SINGH NAGAR",
     *            "UDHAMPUR",
     *            "UDUPI",
     *            "UJJAIN",
     *            "UKHRUL",
     *            "UMARIA",
     *            "UNA",
     *            "UNNAO",
     *            "UPPER SIANG",
     *            "UPPER SUBANSIRI",
     *            "UTTAR DINAJPUR",
     *            "UTTARA KANNADA",
     *            "UTTARKASHI",
     *            "VADODARA",
     *            "VAISHALI",
     *            "VALSAD",
     *            "VARANASI",
     *            "VELLORE",
     *            "VIDISHA",
     *            "VILUPPURAM",
     *            "VIRUDHUNAGAR",
     *            "VISAKHAPATNAM",
     *            "VIZIANAGARAM",
     *            "VYARA",
     *            "WARANGAL",
     *            "WARDHA",
     *            "WASHIM",
     *            "WAYANAD",
     *            "WEST CHAMPARAN",
     *            "WEST DELHI",
     *            "WEST GARO HILLS",
     *            "WEST KAMENG",
     *            "WEST KHASI HILLS",
     *            "WEST SIANG",
     *            "WEST SIKKIM",
     *            "WEST SINGHBHUM",
     *            "WEST TRIPURA",
     *            "WOKHA",
     *            "YADGIR",
     *            "YAMUNA NAGAR",
     *            "YANAM",
     *            "YAVATMAL",
     *            "ZUNHEBOTO"
     *        ],
     *        "religion": [
     *            "HINDU",
     *            "ISLAM",
     *            "CHRISTIAN",
     *            "BUDDHIST",
     *            "SIKH",
     *            "JAIN",
     *            "OTHER"
     *        ],
     *        "ecr_type": [
     *            "ECR",
     *            "ECNR"
     *        ],
     *        "english_speak": [
     *            "GOOD",
     *            "BASIC",
     *            "POOR",
     *            "NO"
     *        ],
     *        "arabic_speak": [
     *            "GOOD",
     *            "BASIC",
     *            "POOR",
     *            "NO"
     *        ]
     *    }
     * }
     */

    public function edit(Request $request)
    {
        try {
            $data['status'] = CandidateStatus::get()->pluck('name', 'id');
            $data['mode_of_registration'] = ['CALLING', 'WALK-IN'];
            $data['source'] = ['TELECALLING', 'REFERANCE', 'FACEBOOK', 'INSTAGRAM', 'OTHER'];
            $data['gender'] = ['MALE', 'FEMALE', 'OTHER'];
            $data['education'] = ['5TH PASS', '8TH PASS', '10TH PASS', 'HIGHER SECONDARY', 'GRADUATES', 'MASTERS'];
            $data['positions'] = CandidatePosition::pluck('name', 'id');
            $data['city'] = Position::getCity();
            $data['religion'] = ['HINDU', 'ISLAM', 'CHRISTIAN', 'BUDDHIST', 'SIKH', 'JAIN', 'OTHER'];
            $data['ecr_type'] = ['ECR', 'ECNR'];
            $data['english_speak'] = ['GOOD', 'BASIC', 'POOR', 'NO'];
            $data['arabic_speak'] = ['GOOD', 'BASIC', 'POOR', 'NO'];
            return response()->json(['message' => 'Profile fetched successfully.', 'status' => true, 'data' => $data], $this->successStatus);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }
}