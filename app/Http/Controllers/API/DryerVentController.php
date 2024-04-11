<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\DryerVent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class DryerVentController extends BaseController
{
    public function index()
    {
        try {
            $dryer_vents = DryerVent::all();
            return $this->sendResponse('DryerVents retrieved successfully', $dryer_vents);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'exit_point' => 'required|in:0-10 Feet Off the Ground,10+ Feet Off the Ground,Rooftop',
                'price' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors(), 422);
            }

            $data = $validator->validated();
            $data['created_by'] = auth()->id();
            $dryer_vent = DryerVent::create($data);
            return $this->sendResponse('DryerVent created successfully', $dryer_vent);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function show($id)
    {
        try {
            $dryer_vent = DryerVent::findOrFail($id);
            return $this->sendResponse('DryerVent retrieved successfully', $dryer_vent);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dryer_vent = DryerVent::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'exit_point' => 'in:0-10 Feet Off the Ground,10+ Feet Off the Ground,Rooftop',
                'price' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors(), 422);
            }

            $data = $validator->validated();
            $data['updated_by'] = auth()->id();
            $dryer_vent->update($data);
            return $this->sendResponse('DryerVent updated successfully', $dryer_vent);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $dryer_vent = DryerVent::findOrFail($id);
            $dryer_vent->delete();
            return $this->sendResponse('DryerVent deleted successfully', $dryer_vent);
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }
}
