<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\AirDuct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class AirDuctController extends BaseController
{
    public function index()
    {
        try {
            $air_ducts = AirDuct::all();
            return $this->sendResponse('AirDucts retrieved successfully', $air_ducts);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'no_of_furnace' => 'required|in:1,2,3+',
                'square_footage_min' => 'required|integer',
                'square_footage_max' => 'required|integer',
                'price_side_by_side' => 'nullable|numeric',
                'price_different_location' => 'nullable|numeric',
                'price_no_location' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors(), 422);
            }

            $data = $validator->validated();
            $data['created_by'] = auth()->id();
            $air_duct = AirDuct::create($data);
            return $this->sendResponse('AirDuct created successfully', $air_duct);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function show($id)
    {
        try {
            $air_duct = AirDuct::findOrFail($id);
            return $this->sendResponse('AirDuct retrieved successfully', $air_duct);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $air_duct = AirDuct::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'no_of_furnace' => 'in:1,2,3+',
                'square_footage_min' => 'integer',
                'square_footage_max' => 'integer',
                'price_side_by_side' => 'nullable|numeric',
                'price_different_location' => 'nullable|numeric',
                'price_no_location' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors(), 422);
            }

            $data = $validator->validated();
            $data['updated_by'] = auth()->id();
            $air_duct->update($data);
            return $this->sendResponse('AirDuct updated successfully', $air_duct);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $air_duct = AirDuct::findOrFail($id);
            $air_duct->delete();
            return $this->sendResponse('AirDuct deleted successfully', $air_duct);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }
}
