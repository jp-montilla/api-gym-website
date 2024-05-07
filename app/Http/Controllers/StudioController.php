<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Models\Studio;
use App\Http\Requests\StoreStudioRequest;
use App\Http\Requests\UpdateStudioRequest;
use App\Http\Resources\StudioResource;
use App\Interfaces\StudioRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StudioController extends Controller
{

    private StudioRepositoryInterface $studioRepositoryInterface;    

    public function __construct(StudioRepositoryInterface $studioRepositoryInterface)
    {
        $this->studioRepositoryInterface = $studioRepositoryInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->studioRepositoryInterface->index();
        return ApiResponseClass::sendResponse(StudioResource::collection($data),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudioRequest $request)
    {
        $details = [
            'name' => $request->name,
            'image' => $request->file('image'),
            'location' => $request->location,
            'description' => $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'mobile_number' => $request->contact['mobile_number'],
            'email' => $request->contact['email']
        ];
        
        DB::beginTransaction();
        try{
            $record = $this->studioRepositoryInterface->store($details);
            DB::commit();
            return ApiResponseClass::sendResponse(new StudioResource($record),'Studio Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $studio = $this->studioRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new StudioResource($studio),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Studio $studio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudioRequest $request, $id)
    {
        $updateDetails = [
            'name' => $request->name,
            'image' => $request->file('image'),
            'location' => $request->location,
            'description' => $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ];
        $contactDetails = [
            'mobile_number' => $request->contact['mobile_number'],
            'email' => $request->contact['email']
        ];
        DB::beginTransaction();
        try{
            $studio = $this->studioRepositoryInterface->update($updateDetails,$contactDetails,$id);
            DB::commit();
            return ApiResponseClass::sendResponse(new StudioResource($studio),'Studio Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->studioRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Studio Delete Successful','',201);
    }
}
