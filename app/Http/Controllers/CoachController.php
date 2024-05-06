<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Models\Coach;
use App\Http\Requests\CoachRequest\StoreCoachRequest;
use App\Http\Requests\CoachRequest\UpdateCoachRequest;
use App\Http\Resources\CoachResource;
use App\Interfaces\CoachRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CoachController extends Controller
{

    private CoachRepositoryInterface $coachRepositoryInterface;    

    public function __construct(CoachRepositoryInterface $coachRepositoryInterface)
    {
        $this->coachRepositoryInterface = $coachRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->coachRepositoryInterface->index();
        return ApiResponseClass::sendResponse(CoachResource::collection($data),'',200);
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
    public function store(StoreCoachRequest $request)
    {
        
        $details = [
            'name' => $request->name,
            'image' => $request->file('image'),
            'about' => $request->about,
            'experiences' => $request->experiences,
            'achievements' => $request->achievements,
            'studio_id' => $request->studio_id,
            'gallery' => $request->file('gallery'),
            'studio_id' => $request->studio_id
        ];

        DB::beginTransaction();
        try{
            $record = $this->coachRepositoryInterface->store($details);
            DB::commit();
            return ApiResponseClass::sendResponse(new CoachResource($record),'Coach Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coach $coaches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coach $coaches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoachRequest $request, Coach $coaches)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coach $coaches)
    {
        //
    }
}
