<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Checkup;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Schedule;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Appointmen;
use App\Models\Laboratory;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    public function schedule()
    {
        $title = "Jadwal Saya";
        $data = Doctor::find(Auth::guard('doctor')->user()->id);
        $schedule = Schedule::where('doctor_id', Auth::guard('doctor')->user()->id)->get();
        return view('pages.doctor.schedule', compact('title', 'data', 'schedule'));
    }

    public function patientIn(Request $request)
    {
        if($request->input('search_data')){
            $patientRequest = Appointmen::where('doctor_id', Auth::guard('doctor')->user()->id)
                            ->where('status', 'Dipanggil')
                            ->whereDate('date_book', 'LIKE', Carbon::parse($request->search_data))  
                            ->get();
        } else {
            $patientRequest = Appointmen::where('doctor_id', Auth::guard('doctor')->user()->id)
                            ->where('status', 'Dipanggil')
                            ->orderBy('date_book')->oldest()->get();
        }
        $title = "Pasien Masuk";
        $data = Doctor::find(Auth::guard('doctor')->user()->id);
        
        return view('pages.doctor.patient', compact('title', 'data', 'patientRequest'));
    }

    public function checkups($id)
    {
        $title = 'Pemeriksaan Pasien';
        $appointment = Appointmen::where('id', $id)->first();
        $medicine = Medicine::all();
        $data = Doctor::find(Auth::guard('doctor')->user()->id);
        $checkup = Checkup::where('doctor_id', $data->id)
                    ->where('appointmen_id', $id)
                    ->first();
        if($checkup == null) {
            $prescription = null;
        } else {
            $prescription = Prescription::where('checkup_id', $checkup->id)->get();
        }
        if($checkup == null) {
            $laboratory = null;
        } else {
            $laboratory = Laboratory::where('checkup_id', $checkup->id)->get();
        }
        return view('pages.doctor.checkup', compact('title', 'data', 'appointment', 'checkup', 'laboratory', 'medicine', 'prescription'));
    }

    public function checkupResult($appointment_id, $patient_id, $doctor_id)
    {
        $dateNow = Carbon::now();
        $dateNow = Carbon::now();
        if($dateNow->month < 10) {
            $month = '0'.$dateNow->month;
        } else {
            $month = $dateNow->month;
        }

        if($dateNow->hour < 10) {
            $hour = '0'.$dateNow->hour;
        } else {
            $hour = $dateNow->hour;
        }

        if($dateNow->minute < 10) {
            $minute = '0'.$dateNow->minute;
        } else {
            $minute = $dateNow->minute;
        }

        if($dateNow->second < 10) {
            $second = '0'.$dateNow->second;
        } else {
            $second = $dateNow->second;
        }
        $number = 'RM-'.$dateNow->year.$month.$hour.$minute.$second;

        Checkup::create([
            'no_medical_record' => $number,
            'appointmen_id' => $appointment_id,
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'date_checkup' => request()->date_checkup,
            'grievance' => request()->grievance,
            'service_price' => request()->service_price,
            'result_diagnoses' => request()->result_diagnoses
        ]);

        Appointmen::where('id', $appointment_id)->update([
            'status' => 'Selesai',
        ]);

        return redirect()->back()->with('success', 'Data pemeriksaan berhasil disimpan.');

    }

    public function resultLab()
    {
        Laboratory::create([
            'checkup_id' => request()->checkup_id,
            'name_lab' => request()->name_lab,
            'grade' => request()->grade,
        ]);

        return redirect()->back()->with('success', 'Hasil laboratorium berhasil ditambah.');
    }

    public function prescription(Request $request, $checkupID)
    {
        Prescription::create([
            'checkup_id' => $checkupID,
            'medicine_id' => $request->medicine_id,
            'amount' => $request->amount,
            'total_cost' => $request->total_cost,
            'recipe' => $request->recipe
        ]);
        Medicine::findOrFail($request->medicine_id)->decrement('quantity', $request->amount);

        return redirect()->back()->with('success','Resep obat berhasil ditambahkan.');
    }

    public function unitID($id)
    {
        $data = Medicine::where('id', $id)->first();
        return response()->json($data);
    }

    public function checkupHistory(Request $request)
    {
        $title = "Riwayat Pemeriksaan Pasien";
        $data = Doctor::find(Auth::guard('doctor')->user()->id);
        if($request->input('search_data')) {
            $patientName = Patient::where('name', 'LIKE', $request->search_data)->first();
            // dd($patientName);
            if(!empty($patientName)) {
                $checkup = Checkup::where('patient_id',$patientName->id)
                            ->where('doctor_id', $data->id)
                            ->orWhere('no_medical_record', 'LIKE', '%'.$request->search_data.'%')
                            ->paginate(7);
            } else {
                $checkup = Checkup::where('no_medical_record', 'LIKE', '%'.$request->search_data.'%')
                                    ->where('doctor_id', $data->id)
                                    ->paginate(7);
            }
        }
        elseif(!empty($request->input('filter_with_date'))) {
            $checkup = Checkup::whereDate('date_checkup', 'LIKE', $request->filter_with_date)
                                ->where('doctor_id', $data->id)
                                ->paginate(7);
        }
        else {
            $checkup = Checkup::where('doctor_id', Auth::guard('doctor')->user()->id)->paginate(7);
        }
        return view('pages.doctor.list_checkup', compact('title', 'data', 'checkup'));
    }

    public function download($id)
    {
        $dateNow = Carbon::now();
        $laboratory = Laboratory::where('checkup_id', $id)->get();
        $checkup = Checkup::where('id', $id)->first();
        $pdf = PDF::loadview('pages.doctor.file_checkup', compact('checkup', 'laboratory', 'dateNow'))->setPaper('A4', 'portrait');
        return $pdf->stream("".$checkup->no_medical_record.".pdf");
    }

    public function downloadRecipe($id)
    {
        $prescription = Prescription::where('checkup_id', $id)->get();
        $checkup = Checkup::where('id', $id)->first();
        $dateNow = Carbon::now();
        $pdf = PDF::loadview('pages.doctor.recipe_medical', compact('checkup', 'prescription', 'dateNow'))->setPaper('A4', 'portrait');
        return $pdf->stream("recipe_medical.pdf");
    }

    public function pullback($id)
    {
        $prescription = Prescription::find($id);
        Medicine::where('id', $prescription->medicine_id)->increment('quantity', $prescription->amount);
        $prescription->delete();
        return redirect()->back()->with("success", "Oke, obat berhasil di tarik.");
    }
    public function profileDoctor()
    {
        $title = "Profile Saya";
        $data = Doctor::find(Auth::guard('doctor')->user()->id);
        return view('pages.doctor.profile_doctor', compact('title', 'data'));
    }
}
