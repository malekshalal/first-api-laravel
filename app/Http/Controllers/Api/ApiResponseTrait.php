<?php
namespace App\Http\Controllers\Api;


trait ApiResponseTrait
{
    public function ApiResponse($data=null,$msg=null,$status=null){

        $arry=[
            "data"=>$data,
            'message'=>$msg,
            'status'=>$status
        ];
        

        return response($arry,$status);

    }
}



?>