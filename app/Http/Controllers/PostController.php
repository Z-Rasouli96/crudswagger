<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    public $postrepository;

    public function __construct(PostRepository $postRepository){
        $this->postrepository = $postRepository;
    }

     /**
      * * @OA\Info(
     *      version="0.0.1",
     *      title="post API Documentation"
     *  )
        * @OA\Post(
        * path="/api/post/insert",
        * operationId="create",
        * tags={"post"},
        * summary="create post",
        * description="post create here",
        *     @OA\RequestBody(
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"title","description"},
        *               @OA\Property(property="title", type="string"),
        *               @OA\Property(property="description", type="string"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="create Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="create Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function create(PostRequest $request){
        $post =$this->postrepository->createPost($request->all());
        return response()->json($post);
        
    }
        /**
         * @OA\Get(
         *     path="/api/post/list",
         *     operationId="listPosts",
         *     tags={"post"},
         *     summary="Get list of posts",
         *     description="Returns a list of posts.",
         *     @OA\Response(
         *         response=200,
         *         description="Successful response",
         *         @OA\JsonContent(
         *             type="array",
         *             @OA\Items(ref="#/components/schemas/Post")
         *         )
         *     ),
         *     @OA\Response(
         *         response=422,
         *         description="Unprocessable Entity",
         *         @OA\JsonContent(
         *             @OA\Property(property="message", type="string"),
         *             @OA\Property(property="errors", type="object")
         *         )
         *     ),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
    public function list() {
        $posts = $this->postrepository->listPost();
        return response()->json($posts);
    }
    
             /**
         * @OA\get(
         *      path="/api/post/{post}/get",
         *      tags={"post"},
         *      summary="get post",
         *      operationId="get",
         *      @OA\Parameter(
         *         name="post",
         *         in="path",
         *         description="ID of post",
         *         required=true,
         *         @OA\Schema(
         *             type="integer",
         *         )
         *     ),
         *      @OA\Response(
         *         response=200,
         *         description="successful operation",
         *      ),
         *      @OA\Response(
         *         response=400,
         *         description="Invalid post supplied"
         *     ),
         *     @OA\Response(
         *         response=404,
         *         description="post not found"
         *     ),
         * )
         *
         */
    public function get(Post $post){
        return response()->json($post);
    }

        /**
         * @OA\Put(
         *      path="/api/post/{post}/update",
         *      tags={"post"},
         *      summary="Update post",
         *      operationId="updatePost",
         *      @OA\Parameter(
         *         name="post",
         *         in="path",
         *         description="ID of the post to update",
         *         required=true,
         *         @OA\Schema(
         *             type="string",
         *         )
         *      ),
         *      @OA\RequestBody(
         *          description="Update a post",
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="application/json",
         *              @OA\Schema(
         *                  type="object",
         *                  @OA\Property(
         *                      property="title",
         *                      description="Title of the post (optional, min 3 chars)",
         *                      type="string",
         *                      minLength=3,
         *                  ),
         *                  @OA\Property(
         *                      property="description",
         *                      description="Description of the post (optional)",
         *                      type="string",
         *                  ),
         *              ),
         *          ),
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="successful operation",
         *      ),
         *      @OA\Response(
         *          response=400,
         *          description="Invalid post supplied"
         *      ),
         *      @OA\Response(
         *          response=404,
         *          description="post not found"
         *      ),
         * )
         */


    public function update(PostRequest $request,Post $post){
        $updatepost = $this->postrepository->updatePost($request->all(),$post);
        return response()->json($updatepost);
    }


         /**
         * @OA\Delete(
         *      path="/api/post/{post}/delete",
         *      tags={"post"},
         *      summary="delete post",
         *      operationId="delete",
         *      @OA\Parameter(
         *         name="post",
         *         in="path",
         *         description="ID of the post to delete",
         *         required=true,
         *         @OA\Schema(
         *             type="integer",
         *         )
         *     ),
         *      @OA\Response(
         *         response=200,
         *         description="successful operation",
         *      ),
         *      @OA\Response(
         *         response=400,
         *         description="Invalid post supplied"
         *     ),
         *     @OA\Response(
         *         response=404,
         *         description="post not found"
         *     ),
         * )
         *
         */

    public function delete(Post $post){
        $this->postrepository->deletePost($post);
        return response()->json("don");
    }
}
