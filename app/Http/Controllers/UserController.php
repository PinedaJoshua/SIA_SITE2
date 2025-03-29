<?php
namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserJob;
use App\Traits\ApiResponser;
use DB;

Class UserController extends Controller {
     use ApiResponser;

     private $request;
     
     public function __construct(Request $request){
         $this->request = $request;
     }
     public function getUsers(){
        // $users = DB::connection('mysql')
         //->select("Select * from tbl_user");

         $users = User :: all();
         return response()->json([$users], 200);
     }

     public function index()
     {
        $users = User::all();

        return $this->successResponse($users);
     }

     public function add(Request $request){
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
            'jobid' => "required|numeric|min:1|not_in:0",
        ];

        $this->validate($request, $rules);

        //Validate if Jobid is found in the table tbluserjob
        $userjob = UserJob::findOrFail($request->jobid);
        $users = User::create($request->all());
        return $this->successResponse($users, Response::HTTP_CREATED); 

    } 
     public function show($id){
        //$user = User::findOrFail($id);
        $user = User::where('id', $id)->first();
        if($user){
        return $this->successResponse($user);
        }
        {
                return $this->errorResponse('User not found', Response::HTTP_NOT_FOUND);
        }
     }
     public function update(Request $request, $id)
     {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',
        ];
        $this->validate($request, $rules);
        $user = User::findOrFail($id);

        $user->fill($request->all());

        if($user->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();
        return $this->successResponse($user);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->errorResponse('User ID does not exist', Response::HTTP_NOT_FOUND);
        }

        $user->delete();
        return $this->successResponse(['message' => 'User deleted successfully']);
    }
     


}