<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Pharmacist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Patient::factory()->count(100)->create();

        Pharmacist::create(["name" => "Bryan", "gender" => "Pria", "birthday" => "1995/01/03", "address" => "Jl. Pahlawan", "phone" => "+622701816715", "email" => "bryan@gmail.com", "username" => "bryan", "password" => Hash::make("apoteker")]);
        Pharmacist::create(["name" => "Adityo Artiryani", "gender" => "Pria", "birthday" => "1993/07/10", "address" => "Jl. Dharma sakti no. 2", "phone" => "+6244445512937", "email" => "adityo_artiryani@gmail.com", "username" => "adityo", "password" => Hash::make("apoteker")]);
        Pharmacist::create(["name" => "Bimo Herdianto", "gender" => "Pria", "birthday" => "1996/11/21", "address" => "Jl. Soekarno Hatta no. 41", "phone" => "+624299173153", "email" => "bimo_herdianto@gmail.com", "username" => "bimo", "password" => Hash::make("apoteker")]);
        Pharmacist::create(["name" => "Widya Oktaviani", "gender" => "Perempuan", "birthday" => "1998/11/28", "address" => "Jl. Baiduri no. 232", "phone" => "+6283471614598", "email" => "widya_oktaviani@gmail.com", "username" => "widya", "password" => Hash::make("apoteker")]);
        Pharmacist::create(["name" => "Kania Halimah", "gender" => "Perempuan", "birthday" => "2000/06/11", "address" => "Jl. Sukajadi no. 858", "phone" => "+6224444516715", "email" => "kania_halimah@gmail.com", "username" => "kania", "password" => Hash::make("apoteker")]);
        Pharmacist::create(["name" => "Laila Yolanda", "gender" => "Perempuan", "birthday" => "1998/11/24", "address" => "Jl. Taman Raya no. 27", "phone" => "+629843368079", "email" => "laila_yolanda@gmail.com", "username" => "laila", "password" => Hash::make("apoteker")]);
        Pharmacist::create(["name" => "Jaiman Lazuardi", "gender" => "Pria", "birthday" => "1994/02/21", "address" => "Jl. HOS Cjokroaminoto ", "phone" => "+6248113054895", "email" => "jaiman_lazuardi@gmail.com", "username" => "jaiman", "password" => Hash::make("apoteker")]);

        Doctor::create(["name" => "Dr. Fanni", "gender" => "Perempuan", "birthday" => "1990/01/01", "address" => "Jl. Durian", "phone" => "+625340409090", "email" => "dr_fani@gmail.com", "username" => "dr_fani", "password" => Hash::make("doctor")]);
        Doctor::create(["name" => "Dr. Henry", "gender" => "Pria", "birthday" => "1987/02/03", "address" => "Jl. Sisingamangaraja", "phone" => "+625340409090", "email" => "dr_henry@gmail.com", "username" => "dr_henry", "password" => Hash::make("doctor")]);
        Doctor::create(["name" => "Dr. Wahyu", "gender" => "Pria", "birthday" => "1995/05/11", "address" => "Jl. Sudirman", "phone" => "+625340409090", "email" => "dr_wahyu@gmail.com", "username" => "dr_wahyu", "password" => Hash::make("doctor")]);
        Doctor::create(["name" => "Dr. Chelsea", "gender" => "Perempuan", "birthday" => "1999/08/15", "address" => "Jl. Jendral Sudirman", "phone" => "+625340409090", "email" => "dr_chelsea@gmail.com", "username" => "dr_chelsea", "password" => Hash::make("doctor")]);
        Doctor::create(["name" => "Dr. Martha", "gender" => "Perempuan", "birthday" => "1997/04/21", "address" => "Jl. Pattimura", "phone" => "+625340409090", "email" => "dr_martha@gmail.com", "username" => "dr_martha", "password" => Hash::make("doctor")]);
        Doctor::create(["name" => "Dr. Ferdinan", "gender" => "Pria", "birthday" => "1980/11/12", "address" => "Jl. Soekarno Hatta", "phone" => "+625340409090", "email" => "dr_ferdinan@gmail.com", "username" => "dr_ferdinan", "password" => Hash::make("doctor")]);

        User::create(["name" => "Administrator", "email" => "administrator@gmail.com", "username" => "admin", "password" => Hash::make("admin")]);
    }
}
