<?php
use App\Models\Staff;

if(!function_exists('isStaffActive'))
{
    function isStaffActive($email) : bool
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