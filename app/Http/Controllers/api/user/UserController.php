<?php

namespace App\Http\Controllers\api\user;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    public function currentUser()
    {
        //return response(['currentUser' => 'this is my message']);
        return Auth::user();
    }
    public function userAddress($id)
    {
        $user =  User::find($id);

        if ($user){
            $userAddress =  User::find($id)->UserAddress()->get();
            if(!$userAddress->isEmpty()) {
                return $userAddress;
            }else{
               return userAddress::create(['user_id' => $user->id, 'address' =>'default Info']);

//                return response(['status' => '404',
//                    'error' => 'address is not found']);
            }

        }else {
            return response(['status' => '404',
                'error' => 'info is not found']);
        }
    }
    //---------------------
    public function logout()
    {
        //$request->user()->token()->revoke();
        Auth::user()->token()->revoke();
        // $request->user()->token()->revoke();
        // Auth::user()->token();
        return response()->json(['message' => 'User logged out successfully']);
    }//end logout()


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(['currentUser' => 'this is my message']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function updateAddress(Request $request)
    {
        $userAddress = userAddress::findOrFail( $request['id']);
//        request()->validate([
//            'ohip' => ['required', 'string', 'min:4']
//        ]);
        $data = $request->all();
        $userAddress->update($data);
        return $userAddress;

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return response(['user_id' => $id]);
        $user = User::find($id);
        if ($user){
            return $user;
        }else{
            return response(['status' => '404',
                'error' => 'info is not found']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}