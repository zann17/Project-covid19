<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    # method index - get all resources
    public function index()
    {
        # Use model Patieent to select the data
        $patients = Patient::all();

        if ($patients->count() == 0) {
            $data = [
                'message' => 'Data patient is empty'
            ];
            return response()->json($data, 404);
        } else {
            $data = [
                'message' => 'Get all patients',
                'data' => $patients,
            ];

            # menggunakan response json laravel
            # otomatis set header content type json
            # otomatis mengubah data array ke JSON
            # mengatur status code
            return response()->json($data, 200);
        }
    }

    # method store - add resource student
    public function store(Request $request)
    {
        // Membuat validasi
        $validatedData = $request->validate([
            'name' => 'string|required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'status' => 'string|required',
            'in_date_at' => 'date',
            'out_date_at' => 'date'
        ]);

        $patient = Patient::create($validatedData);

        // Response jika resource berhasil ditambahkan (JSON)
        $data = [
            'message' => 'Resource is added successfully',
            'data' => $patient
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $data = Patient::find($id);

        if (!is_numeric($id)) {
            $errorMessage = [
                'message' => "id you entered '$id' is not a number"
            ];
            return response()->json($errorMessage, 404);
        } else if ($data == null) {
            $errorMessage = [
                'message' => "data with id $id doesn't exist"
            ];
            return response()->json($errorMessage, 404);
        }
        return response()->json($data, 200);
    }

    // Memperbarui single resource
    public function update(Request $request, $id)
    {
        // Cari data patient
        $patient = Patient::find($id);

        if ($patient) {
            $input = [
                'name' => $request->name ?? $patient->name,
                'phone' => $request->phone ?? $patient->phone,
                'address' => $request->address ?? $patient->address,
                'status' => $request->status ?? $patient->status,
                'in_date_at' => $request->in_date_at ?? $patient->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patient->out_date_at
            ];

            // Update resource
            $patient->update($input);

            // Response jika resource berhasil di-update (JSON)
            $data = [
                'message' => 'Resource is update successfully',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            // Response jika resource tidak ada (JSON)
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function destroy($id)
    {
        $student = Patient::find($id);

        if ($student) {
            $student->delete();
            $data = [
                "message" => "Student with id $id has succesfully deleted",
                "data" => $student
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                "message" => "delete data failed, data with id $id doesn't exist"
            ];
            return response()->json($data, 404);
        }
    }

     // Search resource by name
     public function search($name)
     {
         // Search patient name 
         $patient = Patient::where('name', $name)->get();
 
         if ($patient->isNotEmpty()) {
             // Response if resource success to search
             $data = [
                 'message' => 'Get searced resource',
                 'data' => $patient
             ];
 
             return response()->json($data, 200);
         } else {
             // Response if resource not success to search
             $data = [
                 'message' => 'Resource not found'
             ];
 
             return response()->json($data, 404);
         }
     }
     
    // Mendapatkan resource yang positif
    public function positive()
    {
        // Mendapatkan resource positive
        $patient = Patient::where('status', '=', 'positive')->get();

        // Menghitung total resource positive
        $total = $patient->count();

        // Response jika resource berhasil
        $data = [
            'message' => 'Get positive resource',
            'total' => $total,
            'data' => $patient
        ];

        return response()->json($data, 200);
    }

    // Mendapatkan resource yang sembuh
    public function recovered()
    {
        // Mendapatkan resource recovered
        $patient = Patient::where('status', '=', 'recovered')->get();

        // Menghitung total resource recovered
        $total = $patient->count();

        // Response jika resource berhasil
        $data = [
            'message' => 'Get recovered resource',
            'total' => $total,
            'data' => $patient
        ];

        return response()->json($data, 200);
    }

    // Mendapatkan resource yang meninggal
    public function dead()
    {
        // Mendapatkan resource dead
        $patient = Patient::where('status', '=', 'dead')->get();

        // Menghitung total resource dead
        $total = $patient->count();

        // Response jika resource berhasil
        $data = [
            'message' => 'Get dead resource',
            'total' => $total,
            'data' => $patient
        ];

        return response()->json($data, 200);
    }
}
