<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Setting
 */
class SettingController extends Controller
{
    protected $successStatus = 200;

    /**
     * Contact Us
     *
     * This endpoint will be used to contact us.
     *
     * @bodyParam first_name string required First Name of the user. Example: John
     * @bodyParam last_name string required Last Name of the user. Example: Doe
     * @bodyParam email string required Email of the user. Example:
     * @bodyParam phone string required Phone of the user. Example: 9876543210
     * @bodyParam message string required Message of the user. Example: Message
     * @response {
     * "message": "Contact us successfully."
     * 'status': true
     * }
     */

    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
        }

        try {
            $contactUs = new ContactUs();
            $contactUs->candidate_id = $request->user()->id;
            $contactUs->first_name = $request->first_name;
            $contactUs->last_name = $request->last_name;
            $contactUs->email = $request->email;
            $contactUs->phone = $request->phone;
            $contactUs->message = $request->message;
            $contactUs->save();
            return response()->json(['message' => 'Contact us successfully.', 'status' => true], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }

    /**
     * Additional Page
     *
     * @response 200{
     *  "message": "Additional page fetch successfulyy",
     * "status": false,
     * "data": [
     *     {
     *         "id": 2,
     *         "page_name": "Terms and Conditions",
     *         "title": "Terms and Condition",
     *         "slug": "terms-and-conditions",
     *         "content": "<h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p><br>&nbsp;</p><h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2>Where can I get some?</h2><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>",
     *         "is_active": 1,
     *         "created_at": "2024-02-16T05:44:32.000000Z",
     *         "updated_at": "2024-02-16T07:45:06.000000Z"
     *     },
     *     {
     *         "id": 1,
     *         "page_name": "Privacy Policy",
     *         "title": "Privacy Policy",
     *         "slug": "privacy-policy",
     *         "content": "<h4><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p><h4><strong>Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC</strong></h4><p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p><h4><strong>1914 translation by H. Rackham</strong></h4><p>\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"</p>",
     *         "is_active": 1,
     *         "created_at": "2024-02-16T05:44:32.000000Z",
     *         "updated_at": "2024-02-16T07:45:38.000000Z"
     *     }
     *  ]
     * }
     */

    public function additionalPage(Request $request)
    {
        try {
            $count = Cms::where('is_active', 1)->count();
            if ($count > 0) {
                $additional_pages = Cms::where('is_active', 1)->orderBy('id', 'desc')->get();
                return response()->json(['message' => 'Additional page fetch successfully', 'status' => true, 'data' => $additional_pages], $this->successStatus);
            } else {
                return response()->json(['message' => 'No page found.', 'status' => false], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }
}
