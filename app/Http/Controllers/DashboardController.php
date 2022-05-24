<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Checkup;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Schedule;
use App\Models\Appointmen;
use App\Models\Pharmacist;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardAdmin(Request $request)
    {
        $title = "Dashboard Saya";
        $countPatient = Patient::all()->count();
        $countDoctor = Doctor::all()->count();
        $countMedicine = Medicine::all()->count();
        $countBook = Appointmen::where('status', 'Antrian')->count();
        if(!empty($request->input('name') && $request->input('date'))) {
            $namePatient = Patient::where('name', 'LIKE', '%'.$request->input('name').'%')->first();
            $patientIn = Appointmen::where('status', 'Antrian')
                                ->where('patient_id', $namePatient->id)
                                ->whereDate('date_book', 'LIKE', $request->input('date'))
                                ->paginate(7);
            
        } elseif(!empty($request->input('name')) && empty($request->input('date'))) {
            // return 'ada name';
            $namePatient = Patient::where('name', 'LIKE', '%'.$request->input('name').'%')->first();
            if(!empty($namePatient)) {
                $patientIn = Appointmen::where('status', 'Antrian')
                                ->where('patient_id', 'LIKE', $namePatient->id)
                                ->paginate(7);
            } else {
                $patientIn = Appointmen::where('status', 'Antrian')
                        ->paginate(7);
            }
        }
        elseif(!empty($request->input('date')) && empty($request->input('name'))) {
            // return 'ada date';
            $patientIn = Appointmen::where('status', 'Antrian')
                                ->whereDate('date_book', 'LIKE', $request->input('date'))
                                ->paginate(7);
        } 
        else {
            $patientIn = Appointmen::where('status', 'Antrian')
                        ->paginate(7);
        }
        $checkup = Checkup::where('paid', 0)->oldest()->paginate(7, ["*"], 'payment');
        // dd($patientIn);
        return view('pages.admin.dashboard', compact('title', 'countPatient', 'countDoctor', 'countMedicine', 'countBook', 'checkup', 'patientIn'));
    }

    public function dashboardPatient()
    {
        $title = "Dashboard Saya";
        $data = Patient::find(Auth::guard('patient')->user()->id);
        $requestAppointment = Appointmen::where('patient_id', $data->id)
                                ->where('status', 'Antrian')
                                ->get();
        // dd($requestAppointment->isEmpty() ? "yes" : "no");
        return view('pages.patient.dashboard', compact('title', 'data', 'requestAppointment'));
    }

    public function dashboardDoctor()
    {
        $title = "Dashboard Dokter";
        $data = Doctor::find(Auth::guard('doctor')->user()->id);
        $countRequest = Appointmen::where('doctor_id', Auth::guard('doctor')->user()->id)
                            ->where('status', 'Dipanggil')->count();
        $schedule = Schedule::where('doctor_id', Auth::guard('doctor')->user()->id)
                            ->whereDate('date' ,'<', Carbon::now())
                            ->count();
        $countCheckup = Checkup::where('doctor_id', $data->id)->count();
        return view('pages.doctor.dashboard', compact('title', 'data', 'countRequest', 'schedule', 'countCheckup'));
    }

    public function dashboardPharmacist()
    {
        $dateNow = Carbon::now();
        
        $title = "Dashboard Apoteker";
        $medicine = Medicine::where('date_expired', '<', $dateNow)->get();

        $countMedicine = Medicine::all()->count();
        $sumMedicine = Medicine::all()->sum('quantity');
        $sumStockOut = Prescription::all()->sum('amount');
        
        $stockLess = Medicine::where('quantity', '<', 10)->get();
        $data = Pharmacist::find(Auth::guard('pharmacist')->user()->id);
        return view('pages.pharmacist.dashboard', compact('title', 'data', 'medicine', 'stockLess', 'countMedicine', 'sumMedicine', 'sumStockOut'));
    }
}







