<?php
namespace App\Http\Controllers\Staff\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;

class LoginController extends Controller
{  
    public function login()
    {
        if(View::exists('staff.auth.login'))
        {
            return view('staff.auth.login');
        }
        abort(Response::HTTP_NOT_FOUND);
    }

    public function processLogin(Request $request)
    {
        
         $credentials = $request->except(['_token']);
      
         if($this->isStaffActive($request->email)){
           // dd('now you are here!');
              //dd($credentials);
             if(Auth::guard('staff')->attempt($credentials))
            { 
                 //dd('you made it');
                //auth('staff')->attempt($credentials));
                 return redirect(RouteServiceProvider::STAFF);
            }

            

            return redirect()->action([
                LoginController::class,
                'login'
            ])->with('message','Credentials not matced in our records!');
         }

         return redirect()->action([
            LoginController::class,
            'login'
        ])->with('message','You are not an active doctors!');
     }

     public function isStaffActive($email) : bool
    {   
        $staff = Staff::whereEmail($email)->IsActive()->exists();


        if($staff)
        {
            return true;
        }
        return false;
    }

}
?>