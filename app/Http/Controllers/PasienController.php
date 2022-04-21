<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Schedule;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Appointmen;
use App\Models\Checkup;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function profilePatient()
    {
        $title = "Profile Saya";
        $data = Patient::find(Auth::guard('patient')->user()->id);
        return view('pages.patient.profile_patient', compact('title', 'data'));
    }
    
    public function updateProfile(Request $request, $id)
    {
        $imageName = time().'.'.$request->image->extension(); 
        $request->image->move(public_path('img'), $imageName);
        Patient::where('id', $id)->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'picture' => $imageName,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        
        return redirect()->route('dashboard_patient')->with('success','Selamat data berhasil diperbaharui');
    }

    public function scheduleDoctor(Request $request)
    {
        $dataFind = Carbon::parse($request->search_data);

        if(request()->input('search_data')) {
            $schedule = Schedule::whereDate('date', 'LIKE', $dataFind)->paginate(10);
        } else {
            $schedule = Schedule::paginate(10);
        }
        
        $data = Patient::find(Auth::guard('patient')->user()->id);
        $title = "List Jadwal Dokter";
        return view('pages.patient.schedule_doctor', compact('title', 'data', 'schedule'));
    }

    public function appointment(Request $request)
    {
        $checkDateBook = Carbon::parse($request->date_book);
        $countDate =  Appointmen::where('date_book', '=', $checkDateBook)
                        // ->where('doctor_id', '=', $request->doctor_id) // ditiadakan, saja karna lebih cocok jika disesuaikan dengan pertanggal
                        ->count();
        if($countDate == 0) {
            $number = '0001';
            $noOrder = 'A-'.$number;

            Appointmen::create([
                'no_order' => $noOrder,
                'patient_id' => $request->patient_id,
                'doctor_id' => $request->doctor_id,
                'date_book' => $request->date_book,
                'status' => 'Antrian',
            ]);
            return redirect()->route('schedule_doctor')->with('success','Selamat berhasil booking, silahkan cek nomor antrian anda');
        }
        else {
            $dataGet = Appointmen::where('date_book', '=', $checkDateBook)->get()->last();
            $number = (int)substr($dataGet->no_order, -4) +1;
            $noOrder = 'A-'.sprintf('%04d', $number);
            Appointmen::create([
                'no_order' => $noOrder,
                'patient_id' => $request->patient_id,
                'doctor_id' => $request->doctor_id,
                'date_book' => $request->date_book,
                'status' => 'Antrian',
            ]);
            return redirect()->route('schedule_doctor')->with('success','Selamat berhasil booking, silahkan cek nomor antrian anda');
        }
    }

    public function printNoOrder($id)
    {
        $data = Appointmen::find($id);
        $custom = array(0,0,141.73, 280.77);
        $pdf = PDF::loadview('pages.patient.print_no_order', compact('data'))->setPaper($custom, 'landscape');
        return $pdf->stream("no_antrian.pdf");

        return view('pages.patient.print_no_order', compact('data'));
    }

    public function historyMedical()
    {
        $title = "Riwayat berobat";
        $data = Patient::find(Auth::guard('patient')->user()->id);
        $medicalHistory = Checkup::where('patient_id', $data->id)->paginate(7);
        return view('pages.patient.history_medical', compact('title', 'data', 'medicalHistory'));
    }

    public function historyPrescription($id)
    {
        $title = "Resep obat dokter";
        $dataPrescription = Prescription::where('checkup_id', $id)->get();
        $data = Patient::find(Auth::guard('patient')->user()->id);
        return view('pages.patient.history_prescription', compact('title', 'dataPrescription', 'data'));
    }
}
