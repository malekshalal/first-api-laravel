<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{ use ApiResponseTrait;
    public function index(){
        $posts=PostResource::collection(post::get());
        
        return $this->ApiResponse($posts,'ok',200);

    }
    public function show($id){


        $post=post::find($id);
        if($post){
           
            return $this->ApiResponse(new PostResource($post),'ok',200);
        }else{
            return $this->ApiResponse(null,'this post not fund',404);
        }
        


    }


    public function store(Request $req){

        $validator = Validator::make($req->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->ApiResponse(null,$validator->errors(),400);
        }
    
            




        $post=post::create($req->all());
        if($post){
            return $this->ApiResponse(new PostResource($post),'ok',201);
            
        }


    }




    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $post=Post::find($id);

        if(!$post){
            return $this->apiResponse(null,'The post Not Found',404);
        }

        $post->update($request->all());

        if($post){
            return $this->apiResponse(new PostResource($post),'The post update',201);
        }

    } 
    
    



    public  function destroy($id)
    {
        $post=Post::find($id);

        if(!$post){
            return $this->apiResponse(null,'The post Not Found',404);
        }


        $post->delete($id);
        if($post){
            return $this->ApiResponse(null,"the post delated",201);
        }



    }

}
