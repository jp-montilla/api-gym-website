<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\FAQRequest\StoreFaqRequest;
use App\Http\Requests\FAQRequest\UpdateFaqRequest;
use App\Http\Resources\FAQResource;
use App\Interfaces\FAQRepositoryInterface;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FAQController extends Controller
{

    private FAQRepositoryInterface $faqRepositoryInterface;

    public function __construct(FAQRepositoryInterface $faqRepositoryInterface)
    {
        $this->faqRepositoryInterface = $faqRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->faqRepositoryInterface->index();
        return ApiResponseClass::sendResponse(FAQResource::collection($data),'',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request)
    {
        $details = [
            'question' => $request->question,
            'answer' => $request->answer,
        ];
        DB::beginTransaction();
        try{
            $faq = $this->faqRepositoryInterface->store($details);
            DB::commit();
            return ApiResponseClass::sendResponse(new FAQResource($faq),'FAQ Create Successful', 201);
        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->faqRepositoryInterface->getById($id);
        return ApiResponseClass::sendResponse(new FAQResource($data),'',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, $id)
    {
        $details = [
            'question' => $request->question,
            'answer' => $request->answer,
        ];
        DB::beginTransaction();
        try{
            $faq = $this->faqRepositoryInterface->update($details,$id);
            DB::commit();
            return ApiResponseClass::sendResponse(new FAQResource($faq),'FAQ Update Successful', 201);
        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->faqRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('FAQ Delete Successful','',201);
    }
}
