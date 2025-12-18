<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estimate;
use Illuminate\Http\Request;

class EstimateApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function personal_information(Request $request)
    {
        try {

            $datas = [];
            $datas['first_name'] = $request->first_name;
            $datas['last_name'] = $request->last_name;
            $datas['phone'] = $request->phone;
            $finaldata = json_encode($datas);
            Estimate::create([
                'personal_information' => $datas,
            ]);

            return response()->json([
                'success' => 'true',
                'message' => 'Personal Information Added SuccessFully !',
                'data' => $datas,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function general_enquery(Request $request)
    {
        try {
            $datas = [];
            $datas['length'] = $request->length;
            $datas['width'] = $request->width;
            $datas['state'] = $request->state;
            $datas['district'] = $request->district;
            $datas['type']= $request->type;
            if ($datas['type'] == 'general') {
                Estimate::create([
                    'general_enquiry' => $datas,
                ]);
                 return response()->json([
                'success' => 'true',
                'message' => ' Added General Enquery SuccessFully !',
                'data' => $datas,
            ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function pemiums_enquery(Request $request) {
        try {
            $datas = [];
            $datas['length'] = $request->length;
            $datas['width'] = $request->width;
            $datas['state'] = $request->state;
            $datas['district'] = $request->district;
            $datas['type']= $request->type;
            if ($datas['type'] == 'premium') {
                Estimate::create([
                    'premium_enquiry' => $datas,
                ]);
                 return response()->json([
                'success' => 'true',
                'message' => ' Added Premium Enquiry SuccessFully !',
                'data' => $datas,
            ]);
            
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);

        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
