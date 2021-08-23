<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Objeto;

class FrontController extends Controller
{
        public function folders()
        {
            try {
                $data = Objeto::all();
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'errors' => $e->getMessage()
                ]);
            }
        }

        public function foldertree()
        {
            try {
                 $data = Objeto::tree();
                //$data = Objeto::all();
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'errors' => $e->getMessage()
                ]);
            }
        }


        public function resource($id)
        {
            try {
                $data = Objeto::where('parent_id')->orWhere('id', $id)->get();
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'errors' => $e->getMessage()
                ]);
            }
        }

        public function create(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'fails',
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors()->toArray(),
                ]);
            }

            $objeto = new Objeto([
                'name' => $request->name,
            ]);

            $objeto->save();

            return response()->json([
                'status' => 200,
                'data'   => $objeto,
            ]);
        }

        public function update(Request $request, $id)
        {
            try {
                $data = Objeto::find($id);

                if(!$data) {
                    return response()->json([
                        'status' => 204,
                        'errors' => 'No data'
                    ]);
                }

                $duplicate = Objeto::where('name', $request->name)->get();

                if((count($duplicate) != 0) && ($duplicate[0]['id'] != $id)) {
                    return response()->json([
                        'status' => 400,
                        'error' => 'Duplicate data',
                    ]);
                }else{
                    $data->update($request->all());

                    return response()->json([
                        'status' => 200,
                        'data' => $data,
                    ]);
                }

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'errors' => $e->getMessage()
                ]);
            }
        }

        public function destroy($id)
        {
            try {
                $data = Objeto::find($id);

                if(!$data) {
                    return response()->json([
                        'status' => 204,
                        'errors' => 'No data'
                    ]);
                }else {
                    $count = Objeto::where('parent_id', $id)->get();
                    if(count($count) != 0) {
                        return response()->json([
                            'status' => 204,
                            'errors' => 'Category has children'
                        ]);
                    }
                }

                $data->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Delete successfully'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'errors' => $e->getMessage()
                ]);
            }
        }
    }
