<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Checkup;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Appointmen;
use App\Models\Pharmacist;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function addUser(Request $request)
    {
        $title = "Data User";
        if(!empty($request->input('search_by'))) {
            $patient = Patient::where('name', 'LIKE', '%'.$request->input('search_by').'%')
                        ->paginate(10);
        } else {
            $patient = Patient::paginate(10);
        }
        $doctor = Doctor::paginate(10);
        $pharmacist = Pharmacist::paginate(10);
        return view('pages.admin.add_user', compact('title', 'patient', 'doctor', 'pharmacist'));
    }

    public function insertPatient(Request $request)
    {
        // dd($request);

        if($request->role === "Pasien") {
            $request->validate([
                'username' => 'required|unique:patients',
                'email' => 'required|unique:patients|email:dns',
                'phoneNumber' => 'required|numeric',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'username.required' => 'Username anda masih kosong',
                'email' => 'Email anda tidak dikenali',
                'username.unique' => 'Username anda harus unik',
                'email.required' => 'Email masih kosong',
                'email.unique' => 'Email anda harus unik',
                'username.unique' => 'Email anda harus unik',
                'phoneNumber.required' => 'No telepon masih kosong',
                'phoneNumber.numeric' => 'No telepon harus angka',
                'password.required' => 'Password anda masih kosong',
                'password.min' => 'Password anda minimal 6 karakter',
                'password_confirmation.same' => 'Konfirmasi password anda tidak sesuai',
            ]
        );
    
            Patient::create([
                'name' => $request->name,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'phone' => $request->phoneNumber,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with("success", "Selamat user berhasil ditambah.");
        }
        elseif($request->role === "Dokter")
        {
            $request->validate([
                'username' => 'required|unique:doctors',
                'email' => 'required|unique:doctors|email:dns',
                'phoneNumber' => 'required|numeric',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'username.required' => 'Username anda masih kosong',
                'email' => 'Email anda tidak dikenali',
                'username.unique' => 'Username anda harus unik',
                'email.required' => 'Email masih kosong',
                'email.unique' => 'Email anda harus unik',
                'username.unique' => 'Email anda harus unik',
                'phoneNumber.required' => 'No telepon masih kosong',
                'phoneNumber.numeric' => 'No telepon harus angka',
                'password.required' => 'Password anda masih kosong',
                'password.min' => 'Password anda minimal 6 karakter',
                'password_confirmation.same' => 'Konfirmasi password anda tidak sesuai',
            ]
        );
    
            Doctor::create([
                'name' => $request->name,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'phone' => $request->phoneNumber,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with("success", "Selamat dokter baru berhasil ditambah.");
        }
        else {
            $request->validate([
                'username' => 'required|unique:pharmacist',
                'email' => 'required|unique:pharmacist|email:dns',
                'phoneNumber' => 'required|numeric',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'username.required' => 'Username anda masih kosong',
                'email' => 'Email anda tidak dikenali',
                'username.unique' => 'Username anda harus unik',
                'email.required' => 'Email masih kosong',
                'email.unique' => 'Email anda harus unik',
                'username.unique' => 'Email anda harus unik',
                'phoneNumber.required' => 'No telepon masih kosong',
                'phoneNumber.numeric' => 'No telepon harus angka',
                'password.required' => 'Password anda masih kosong',
                'password.min' => 'Password anda minimal 6 karakter',
                'password_confirmation.same' => 'Konfirmasi password anda tidak sesuai',
            ]
        );
    
            Pharmacist::create([
                'name' => $request->name,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'phone' => $request->phoneNumber,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with("success", "Selamat apoteker baru berhasil ditambah.");
        }
    }
    public function updatePatient(Request $request, $id)
    {
        $request->validate([
            'field_phone' => ['required', 'numeric'],
        ],
        [
            'field_phone.numeric' => 'Nomor telepon harus angka',
        ]);

        Patient::where('id', $id)->update([
            'name' => $request->field_name,
            'gender' => $request->field_gender,
            'birthday' => $request->field_birthday,
            'address' => $request->field_address,
            'email' => $request->email,
            'phone' => $request->field_phone,
            'username' => $request->field_username,
        ]);

        return redirect()->back()->with("success", "Selamat data $request->field_name berhasil di perbaharui");

    }

    public function updateDoctor(Request $request, $id)
    {
        $request->validate([
            'field_phone' => ['required', 'numeric'],
        ],
        [
            'field_phone.numeric' => 'Nomor telepon harus angka',
        ]);

        Doctor::where('id', $id)->update([
            'name' => $request->field_name,
            'gender' => $request->field_gender,
            'birthday' => $request->field_birthday,
            'address' => $request->field_address,
            'email' => $request->email,
            'phone' => $request->field_phone,
            'username' => $request->field_username,
        ]);

        return redirect()->back()->with("success", "Selamat data $request->field_name berhasil di perbaharui");
    }

    public function updatePharmacist(Request $request, $id)
    {
        $request->validate([
            'field_phone' => ['required', 'numeric'],
        ],
        [
            'field_phone.numeric' => 'Nomor telepon harus angka',
        ]);

        Pharmacist::where('id', $id)->update([
            'name' => $request->field_name,
            'gender' => $request->field_gender,
            'birthday' => $request->field_birthday,
            'address' => $request->field_address,
            'email' => $request->email,
            'phone' => $request->field_phone,
            'username' => $request->field_username,
        ]);

        return redirect()->back()->with("success", "Selamat data $request->field_name berhasil di perbaharui");
    }

    public function deletePatient($id)
    {
        $data = Patient::findOrFail($id);
        $data->delete();
        return redirect()->back()->with("success", "Selamat, user $data->name berhasil dihapus pada database.");
    }

    public function deleteDoctor($id)
    {
        $data = Doctor::findOrFail($id);
        $data->delete();
        return redirect()->back()->with("success", "Selamat, $data->name berhasil dihapus pada database.");
    }
    public function deletePharmacist($id)
    {
        $data = Pharmacist::findOrFail($id);
        $data->delete();
        return redirect()->back()->with("success", "Selamat, $data->name berhasil dihapus pada database.");
    }

    public function trash()
    {
        $trashPatient = Patient::onlyTrashed()->paginate(10);
        $trashDoctor = Doctor::onlyTrashed()->paginate(10);
        $trashPharmacist = Pharmacist::onlyTrashed()->paginate(10);
        $title = 'Riwayat Hapus User';
        return view('pages.admin.history_delete', compact('trashDoctor', 'trashPatient', 'trashPharmacist','title'));
    }

    public function payment($id)
    {
        $title = 'Informasi Pembayaran';
        $checkup = Checkup::where('id', $id)->first();
        $prescription = Prescription::where('checkup_id',$id)->get();
        return view('pages.admin.payment', compact('title', 'prescription', 'checkup'));
    }

    public function insertPayment($id)
    {
        $checkup = Checkup::where('id', $id)->first();
        $namePatient = Patient::where('id', $checkup->patient_id)->first();
        $countDataPayment = Payment::all()->count();
        if($countDataPayment == 0) {
            $number = 'PX-0001';
        } else {
            $getLastData = Payment::all()->last();
            $number = 'PX-'.sprintf('%04d', (int)substr($getLastData->no_payment, -4)+1);
        }
        Payment::create([
            'no_payment' => $number,
            'name_patient' => $namePatient->name,
            'checkup_id' => $id,
            'total_cost' => request()->total_payment,
            'paid' => request()->cash,
            'refund' => request()->refund,
        ]);


        Checkup::where('id',$id)->update(['paid' => 1]);
        return redirect()->route('dashboard_admin')->with('success', 'Pembayaran berhasil disimpan');
        
    }

    public function paymentList(Request $request)
    {
        $title = "Daftar Pembayaran";
        if($request->input('search_data')) {
            $payment = Payment::where('name_patient', 'LIKE', $request->search_data)
                        ->orWhere('no_payment', 'LIKE', $request->search_data)
                        ->get();
        } else {

            $payment = Payment::all();
        }
        return view('pages.admin.data_payment', compact('title', 'payment'));
    }

    public function download($id)
    {
        $payment = Payment::where('id',$id)->first();
        $no_seri = 'PX022-'.sprintf('%06d', $payment->id);
        $checkup = Checkup::where('id', $payment->checkup_id)->first();
        $prescription = Prescription::where('checkup_id', $payment->checkup_id)->get();
        $pdf = PDF::loadview('pages.admin.invoice_payment', compact('payment', 'checkup', 'prescription', 'no_seri'))->setPaper('A4', 'portrait');
        return $pdf->stream("Invoice_".$no_seri.".pdf");
    }

    public function call(Request $request, $id)
    {

        // dd(request());
        $data = Appointmen::where('id',$id)->first();
        
        Appointmen::where('id', $id)->update([
            'status' => 'Dipanggil'
        ]);
        $namePatient = $data->patient->name;
        return redirect()->route('dashboard_admin')->with("call", "Oke, $namePatient dipersilahkan masuk keruangan dokter.");
    }

    public function cancelBook($id)
    {
        $data = Appointmen::find($id);
        $data->delete();
        return redirect()->back()->with("success", "Antrian $data->no_order berhasil dicancel.");
    }

    public function trashRestore($id)
    {
        $user = Patient::onlyTrashed()->where('id',$id)->first();
        $user->restore();
        return redirect()->back()->with("success", "Selamat, data berhasil dikembalikan.");
    }
    public function deletePermanent($id)
    {
        Patient::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with("success", "Selamat, data berhasil dihapus secara permanen.");
    }
}





