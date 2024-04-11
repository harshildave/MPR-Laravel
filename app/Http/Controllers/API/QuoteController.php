<?php

namespace App\Http\Controllers\API;

use App\Models\DryerVent;
use Exception;
use Validator;
use App\Models\AirDuct;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;

class QuoteController extends BaseController
{
    public function getQuotes(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'no_of_furnace' => 'required',
                'square_footage' => 'required',
                'furnace_location' => 'sometimes',
                'exit_point' => 'sometimes'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors(), 422);
            }
            $airduct = AirDuct::select('price_no_location', 'price_side_by_side', 'price_different_location')
                ->where('no_of_furnace', $request->no_of_furnace)
                ->where('square_footage_min', '<=', $request->square_footage)
                ->where('square_footage_max', '>=', $request->square_footage)
                ->first();

            if ($airduct) {
                $data['air_duct_cleaning_price'] = $airduct->price_no_location;
                if (isset($request->furnace_location) && $request->furnace_location != "") {
                    $data['air_duct_cleaning_price'] = $airduct->price_different_location;
                    if ($request->furnace_location == 'side-by-side')
                        $data['air_duct_cleaning_price'] = $airduct->price_side_by_side;
                }
                $data['total'] = $data['air_duct_cleaning_price'];
                if (isset($request->exit_point) && $request->exit_point != '') {
                    $dryer_vent = DryerVent::where('exit_point', $request->exit_point)->first();
                    if ($dryer_vent) {
                        $data['dryer_vent_cleaning_price'] = $dryer_vent->price;
                        $data['total'] += $data['dryer_vent_cleaning_price'];
                    }
                }
                return $this->sendResponse('Quote calculated Successfully', $data);
            }

            return $this->sendError('Quote cannot be calculated');
        } catch (Exception $e) {
            return $this->sendError('Error Exception : ' . $e->getMessage(), [], 500);
        }
    }
}
