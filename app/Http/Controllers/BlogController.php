<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\BlogRequest\StoreBlogRequest;
use App\Http\Requests\BlogRequest\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Interfaces\BlogRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    private BlogRepositoryInterface $blogRepositoryInterface;    

    public function __construct(BlogRepositoryInterface $blogRepositoryInterface)
    {
        $this->blogRepositoryInterface = $blogRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->blogRepositoryInterface->index();
        return ApiResponseClass::sendResponse(BlogResource::collection($data),'',200);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $details = [
            'title' => $request->title,
            'image' => $request->file('image'),
            'content' => $request->content,
        ];

        DB::beginTransaction();
        try{
            $blog = $this->blogRepositoryInterface->store($details);
            DB::commit();
            return ApiResponseClass::sendResponse(new BlogResource($blog),'Blog Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->blogRepositoryInterface->getById($id);
        return ApiResponseClass::sendResponse(new BlogResource($data),'',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        $details = [
            'title' => $request->title,
            'image' => $request->file('image'),
            'content' => $request->content,
        ];
        DB::beginTransaction();
        try{
            $blog = $this->blogRepositoryInterface->update($details,$id);
            DB::commit();
            return ApiResponseClass::sendResponse(new BlogResource($blog),'Blog Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->blogRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Blog Delete Successful','',201);
    }
}
