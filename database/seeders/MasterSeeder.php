<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusAttendance;
use App\Models\StatusDoc;
use App\Models\Subdistrict;
use App\Models\User;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusAttendance::create([
            'name' => 'Ijin'
        ]);
        StatusAttendance::create([
            'name' => 'Sakit'
        ]);
        StatusAttendance::create([
            'name' => 'Hari Libur'
        ]);

        Status::create([
            'name' => 'Belum Entri'
        ]);
        Status::create([
            'name' => 'Sedang Entri'
        ]);
        Status::create([
            'name' => 'Selesai Entri'
        ]);

        StatusDoc::create([
            'name' => 'Clean'
        ]);
        StatusDoc::create([
            'name' => 'Warning'
        ]);
        StatusDoc::create([
            'name' => 'Error'
        ]);

        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'user', 'guard_name' => 'web']);

        $superuser = User::create([
            "name" => 'Administrator',
            "email" => "admin",
            "password" => bcrypt('123456')
        ]);
        $superuser->assignRole('admin');

        $user1 = User::create([
            "name" => 'User 1',
            "email" => "user1",
            "password" => bcrypt('123456')
        ]);
        $user1->assignRole('user');

        $user2 = User::create([
            "name" => 'User 2',
            "email" => "user2",
            "password" => bcrypt('123456')
        ]);
        $user2->assignRole('user');

        $user3 = User::create([
            "name" => 'User 3',
            "email" => "user3",
            "password" => bcrypt('123456')
        ]);
        $user3->assignRole('user');

        $superuser = User::create([
            'name' => "Abd.Holiq",
            'email' => "Abdholiq",
            'password' => bcrypt("Abdholiq")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Agung Muhammad Zahid",
            'email' => "Zahidagung",
            'password' => bcrypt("Zahidagung")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Ahmad Nur Bustomi",
            'email' => "ANBustomi",
            'password' => bcrypt("ANBustomi")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Annisa fitriana",
            'email' => "4nnisa03",
            'password' => bcrypt("4nnisa03")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Arji",
            'email' => "arji01",
            'password' => bcrypt("arji01")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Bima Yudha Dwi Putra",
            'email' => "Bimayudhadwiputra",
            'password' => bcrypt("Bimayudhadwiputra")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Dahlia Cucu putra pahlawan",
            'email' => "Dahliacucu29",
            'password' => bcrypt("Dahliacucu29")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "DANDY PROBOWIJAYANTO",
            'email' => "dandyez",
            'password' => bcrypt("dandyez")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Diana Noviarika",
            'email' => "Diana Noviarika",
            'password' => bcrypt("Diana Noviarika")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "diana puji rahayu",
            'email' => "diana puji",
            'password' => bcrypt("diana puji")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "FERDI DWI PRASETYO",
            'email' => "FERDIDWIPRASETYO",
            'password' => bcrypt("FERDIDWIPRASETYO")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Foni miliana sandra",
            'email' => "Fonimiliana",
            'password' => bcrypt("Fonimiliana")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Imam wahyudi",
            'email' => "Masyudi76",
            'password' => bcrypt("Masyudi76")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "IRFAN AMRULLAH",
            'email' => "irfanamr96",
            'password' => bcrypt("irfanamr96")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "M. Lukas",
            'email' => "Muklasalaska",
            'password' => bcrypt("Muklasalaska")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "MAIMUNA",
            'email' => "maidanil",
            'password' => bcrypt("maidanil")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "MUHAMMAD ANDI FATCHUROZI",
            'email' => "Andifatchurozi21",
            'password' => bcrypt("Andifatchurozi21")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Muhammad Maulana Ishaq",
            'email' => "Ishaqmaulana_21",
            'password' => bcrypt("Ishaqmaulana_21")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Nurhudah Kamarullah",
            'email' => "Nurhudah_Kamarullah",
            'password' => bcrypt("Nurhudah_Kamarullah")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Puput kus endang",
            'email' => "Puputke",
            'password' => bcrypt("Puputke")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Saifudin",
            'email' => "Saifudin BPS",
            'password' => bcrypt("Saifudin BPS")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Syaiful hadi",
            'email' => "syaifulh1080",
            'password' => bcrypt("syaifulh1080")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Wulan Ramadhani",
            'email' => "wulanramadhani0402",
            'password' => bcrypt("wulanramadhani0402")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Abbas Al Faruqy",
            'email' => "Abbas Al Faruqy",
            'password' => bcrypt("Abbas Al Faruqy")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "ACHMAD AGUS FAISOL",
            'email' => "Achmad Agus Faisol",
            'password' => bcrypt("Achmad Agus Faisol")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "ACHMAD IMRON MASDUKI",
            'email' => "achmadimronmasduki",
            'password' => bcrypt("achmadimronmasduki")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Achmad Ridlo Ilahi",
            'email' => "Achmad ridlo ilahi",
            'password' => bcrypt("Achmad ridlo ilahi")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Adam Malik",
            'email' => "adam1707malik",
            'password' => bcrypt("adam1707malik")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Adhaji Ilham Muhamad",
            'email' => "ADHAJI",
            'password' => bcrypt("ADHAJI")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Alvin Kurnia Hamdana",
            'email' => "Alvin_hamdana",
            'password' => bcrypt("Alvin_hamdana")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "alvira devi karina hakim",
            'email' => "Alvira29",
            'password' => bcrypt("Alvira29")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Amara Deviana Chanigo",
            'email' => "amaradevi",
            'password' => bcrypt("amaradevi")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Amirul hariyanto",
            'email' => "amirulhariyanto",
            'password' => bcrypt("amirulhariyanto")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Andi Cahya Santoso",
            'email' => "BuronanMertua",
            'password' => bcrypt("BuronanMertua")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Annasya Mia Darmayani",
            'email' => "annasya mia",
            'password' => bcrypt("annasya mia")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "ARDIAN NOVALDHI",
            'email' => "Ardian1311",
            'password' => bcrypt("Ardian1311")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Ari Mulyanto",
            'email' => "arimulya69374",
            'password' => bcrypt("arimulya69374")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Ayu Nurma Yunita",
            'email' => "ayunurma30",
            'password' => bcrypt("ayunurma30")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Bambang Mudiono",
            'email' => "bambang",
            'password' => bcrypt("bambang")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "DANI SUKRI HANAPI",
            'email' => "Danisukri",
            'password' => bcrypt("Danisukri")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Daniel Salahudin",
            'email' => "Daniel10",
            'password' => bcrypt("Daniel10")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Deviana Novita Sari",
            'email' => "Deviana Novita Sari",
            'password' => bcrypt("Deviana Novita Sari")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Dewi Amira",
            'email' => "dewiamira",
            'password' => bcrypt("dewiamira")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Dewi Qomara Dona",
            'email' => "donnadewi",
            'password' => bcrypt("donnadewi")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Dia Islamiyah",
            'email' => "Diaislamiyah",
            'password' => bcrypt("Diaislamiyah")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "DIAZ RIZKYA PUTRA",
            'email' => "Diazrizkyaputra",
            'password' => bcrypt("Diazrizkyaputra")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "DIMAS JORGHI PRADANA",
            'email' => "Dimas2106",
            'password' => bcrypt("Dimas2106")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Dita Ayu Lutfiana",
            'email' => "ditayuu",
            'password' => bcrypt("ditayuu")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "DONNY PRATAMA YUNIOR",
            'email' => "donnypratama4438",
            'password' => bcrypt("donnypratama4438")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Dwi Rizqi Anjirfaghnawi",
            'email' => "Drizanjir_",
            'password' => bcrypt("Drizanjir_")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "EKA YUNIAR LESTARI",
            'email' => "ekayuniar17",
            'password' => bcrypt("ekayuniar17")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Enis Wulandari",
            'email' => "Enis_Wulandari",
            'password' => bcrypt("Enis_Wulandari")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Fahrur riyazatur rofiqoh",
            'email' => "Fahrur19",
            'password' => bcrypt("Fahrur19")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "FAJRIYATUL MUTAMMIMAH",
            'email' => "Fajriyamth",
            'password' => bcrypt("Fajriyamth")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Faradila Sahara",
            'email' => "Faradilasahara",
            'password' => bcrypt("Faradilasahara")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Farah Jihan Khairun Nisa'",
            'email' => "farah921",
            'password' => bcrypt("farah921")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "FATICHATURROHMAH ISLAMIYAH",
            'email' => "Faticha",
            'password' => bcrypt("Faticha")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Febby Dwi Kandina Putri",
            'email' => "Febbykandi",
            'password' => bcrypt("Febbykandi")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Fina Rohmatul Ummah",
            'email' => "FinaRohmatulUmmah",
            'password' => bcrypt("FinaRohmatulUmmah")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Firman Ika Yusmalah Sugiati",
            'email' => "firmanika",
            'password' => bcrypt("firmanika")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "FIRMANSYAH ALDILLAH",
            'email' => "Aldillah",
            'password' => bcrypt("Aldillah")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Frisilia Eka Fitriani",
            'email' => "Frisiliaeka",
            'password' => bcrypt("Frisiliaeka")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Ginanjar Samodro Widodo",
            'email' => "anjarsan",
            'password' => bcrypt("anjarsan")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "IBNU HIDAYAT",
            'email' => "Hidayat_12",
            'password' => bcrypt("Hidayat_12")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "IFTAH RIZKIE VIDIAN",
            'email' => "IFTAH_RIZKIE_VIDIAN",
            'password' => bcrypt("IFTAH_RIZKIE_VIDIAN")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Ika Ardining Putri",
            'email' => "ikaaputri",
            'password' => bcrypt("ikaaputri")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "IKA SEPTIANA PUTRI",
            'email' => "ikasept",
            'password' => bcrypt("ikasept")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Ilham Aldin Hidayat",
            'email' => "Ilham290",
            'password' => bcrypt("Ilham290")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "ILHAM KURNIAWAN",
            'email' => "ilham1982",
            'password' => bcrypt("ilham1982")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Inayatul Wulandari",
            'email' => "Ina_wulan06",
            'password' => bcrypt("Ina_wulan06")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Indri Widya Kurniawati",
            'email' => "IndriWidya",
            'password' => bcrypt("IndriWidya")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Irvan Rachmad Ananto",
            'email' => "IrvanRhmd",
            'password' => bcrypt("IrvanRhmd")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Ivan Budi Tantra",
            'email' => "ivan",
            'password' => bcrypt("ivan")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Khairorrosi",
            'email' => "Khairorrosi",
            'password' => bcrypt("Khairorrosi")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Khusnul Arifin",
            'email' => "ksnlarifin",
            'password' => bcrypt("ksnlarifin")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Lesdi Harto Irawan",
            'email' => "Lesdi",
            'password' => bcrypt("Lesdi")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "LISA SHERLY CHOLIQA",
            'email' => "Lisa",
            'password' => bcrypt("Lisa")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "M ZAKI IMAMUL MURTADLO",
            'email' => "zakimuhammad",
            'password' => bcrypt("zakimuhammad")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "M. CHOIRUL AMIN AL HAKIKI",
            'email' => "aminalhakiki",
            'password' => bcrypt("aminalhakiki")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "M. Kamil",
            'email' => "Kamil21",
            'password' => bcrypt("Kamil21")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "maulana ishak wibawa mukti",
            'email' => "maulana_ishak",
            'password' => bcrypt("maulana_ishak")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "MAULANA JIBRIL AL ISA",
            'email' => "mjai",
            'password' => bcrypt("mjai")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Mochammad Iqbal Dewa Dharma",
            'email' => "IqbalDewa",
            'password' => bcrypt("IqbalDewa")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "MOH. FIKRI DERMAWAN",
            'email' => "Fsan29",
            'password' => bcrypt("Fsan29")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Moh. Nanang Qosyim",
            'email' => "Nanangdamai123",
            'password' => bcrypt("Nanangdamai123")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Mohammad sholehuddin",
            'email' => "LEEHOE",
            'password' => bcrypt("LEEHOE")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Mufidatun Nisa'",
            'email' => "Mnisa",
            'password' => bcrypt("Mnisa")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Muh. Hasan Digo Firnando",
            'email' => "Digo",
            'password' => bcrypt("Digo")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Muhamad Wahid Setiawan",
            'email' => "wahidsetiawan",
            'password' => bcrypt("wahidsetiawan")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Muhammad Bagoes Ariefani",
            'email' => "Bagus_aja",
            'password' => bcrypt("Bagus_aja")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Muhammad Cahyo Saputro",
            'email' => "Muhammadcahyo",
            'password' => bcrypt("Muhammadcahyo")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Muhammad Hafid",
            'email' => "hafidrdw_11",
            'password' => bcrypt("hafidrdw_11")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Muhammad Rido Hartono",
            'email' => "ridohartono98",
            'password' => bcrypt("ridohartono98")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Muhammad Sholehudin",
            'email' => "leonfaza",
            'password' => bcrypt("leonfaza")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Muhammad Syaiful Rizal",
            'email' => "091294iil",
            'password' => bcrypt("091294iil")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Nabila Izza Syakira",
            'email' => "NabilaSyakira",
            'password' => bcrypt("NabilaSyakira")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "nabila nur faizah",
            'email' => "Nabilafaizah",
            'password' => bcrypt("Nabilafaizah")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Nadia Fahira Salsabila",
            'email' => "nadiafahiras",
            'password' => bcrypt("nadiafahiras")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Nadia lutfiana dewi rahmawati",
            'email' => "nadiadewi",
            'password' => bcrypt("nadiadewi")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "NADYA MAURENA WAFIYANTI",
            'email' => "nadyamaurena",
            'password' => bcrypt("nadyamaurena")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Neva Yolandasari",
            'email' => "Nevays99",
            'password' => bcrypt("Nevays99")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Nining Ayu Widiastuti",
            'email' => "niningayuw",
            'password' => bcrypt("niningayuw")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Nur ananda cahyati",
            'email' => "Nandacahyaa",
            'password' => bcrypt("Nandacahyaa")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Nurhasanah",
            'email' => "nurhasanah",
            'password' => bcrypt("nurhasanah")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "NURRAMADHAN ARWINDA",
            'email' => "dhani.09",
            'password' => bcrypt("dhani.09")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Nurul Azizah",
            'email' => "azizahuyung",
            'password' => bcrypt("azizahuyung")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Odelia Eka Prameswari",
            'email' => "odeliaeka",
            'password' => bcrypt("odeliaeka")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Pitra Surya Pradipta",
            'email' => "pitraaasuryaaa",
            'password' => bcrypt("pitraaasuryaaa")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Rafri Bayu Raharjo",
            'email' => "Rafri31",
            'password' => bcrypt("Rafri31")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Rahmawati",
            'email' => "Rahmawati2830",
            'password' => bcrypt("Rahmawati2830")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "REGI RESTA AFYUDA",
            'email' => "Regiresta22",
            'password' => bcrypt("Regiresta22")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Rendy Perdana Arizona",
            'email' => "Rendy_Perdana_A",
            'password' => bcrypt("Rendy_Perdana_A")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Rias Kusumawati",
            'email' => "rias88",
            'password' => bcrypt("rias88")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "RIKE MAYA HANDAYANI",
            'email' => "RIKE_MAYA_HANDAYANI",
            'password' => bcrypt("RIKE_MAYA_HANDAYANI")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Rodiatul munawaroh",
            'email' => "Rmunawaroh17",
            'password' => bcrypt("Rmunawaroh17")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "S.Teguh Ekarzaen",
            'email' => "ekarzaen",
            'password' => bcrypt("ekarzaen")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "SALMAN AL FARISI",
            'email' => "alfarisi9914",
            'password' => bcrypt("alfarisi9914")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Siska Mudrika",
            'email' => "Siskamudrika",
            'password' => bcrypt("Siskamudrika")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "sohebatul mukarromah",
            'email' => "soheb26",
            'password' => bcrypt("soheb26")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Syamsudin",
            'email' => "Udin666",
            'password' => bcrypt("Udin666")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Taufik Hidayat",
            'email' => "Opikopik",
            'password' => bcrypt("Opikopik")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Urifa",
            'email' => "Rivaanggraeni96",
            'password' => bcrypt("Rivaanggraeni96")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Wiwik hulaifah",
            'email' => "Wiwik.hulaifah",
            'password' => bcrypt("Wiwik.hulaifah")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Yossy Adin Medyanti",
            'email' => "yossyadin0605",
            'password' => bcrypt("yossyadin0605")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Zacky Azriel Bakti",
            'email' => "Zacky123",
            'password' => bcrypt("Zacky123")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Zainul millah",
            'email' => "Zainul0304",
            'password' => bcrypt("Zainul0304")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Zulfa Camilah Islamiyah",
            'email' => "zulfacamilah",
            'password' => bcrypt("zulfacamilah")
        ]);

        //tambahan
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Eva Novita",
            'email' => "EVANO",
            'password' => bcrypt("EVANO")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Miftahul Ilmih",
            'email' => "MIFTAHULILMIH",
            'password' => bcrypt("MIFTAHULILMIH")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Mohammad Yuda Irwansah",
            'email' => "DWI732318",
            'password' => bcrypt("DWI732318")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Riza Dwi Safitri",
            'email' => "RIZA",
            'password' => bcrypt("RIZA")
        ]);
        $superuser->assignRole('user');
        $superuser = User::create([
            'name' => "Ulfi Jahusafat Amanah",
            'email' => "ULFI",
            'password' => bcrypt("ULFI")
        ]);
        $superuser->assignRole('user');

        $sukapura = Subdistrict::create([
            'code' => '010',
            'name' => 'Sukapura'
        ]);

        Village::create([
            'name' => 'Ngadisari',
            'code' => '001',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Sariwani',
            'code' => '002',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Kedasih',
            'code' => '003',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Pakel',
            'code' => '004',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Ngepung',
            'code' => '005',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Sukapura',
            'code' => '006',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Sapikerep',
            'code' => '007',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Wonokerto',
            'code' => '008',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Ngadirejo',
            'code' => '009',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Ngadas',
            'code' => '010',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Jetak',
            'code' => '011',
            'subdistrict_id' => $sukapura->id
        ]);
        Village::create([
            'name' => 'Wonoroto',
            'code' => '012',
            'subdistrict_id' => $sukapura->id
        ]);

        $sumber = Subdistrict::create([
            'code' => '020',
            'name' => 'Sumber'
        ]);
        Village::create([
            'name' => 'Ledokombo',
            'code' => '001',
            'subdistrict_id' => $sumber->id
        ]);
        Village::create([
            'name' => 'Pandansari',
            'code' => '002',
            'subdistrict_id' => $sumber->id
        ]);
        Village::create([
            'name' => 'Sumberanom',
            'code' => '003',
            'subdistrict_id' => $sumber->id
        ]);
        Village::create([
            'name' => 'Wonokerso',
            'code' => '004',
            'subdistrict_id' => $sumber->id
        ]);
        Village::create([
            'name' => 'Gemito',
            'code' => '005',
            'subdistrict_id' => $sumber->id
        ]);
        Village::create([
            'name' => 'Tukul',
            'code' => '006',
            'subdistrict_id' => $sumber->id
        ]);
        Village::create([
            'name' => 'Sumber',
            'code' => '007',
            'subdistrict_id' => $sumber->id
        ]);
        Village::create([
            'name' => 'Cepoko',
            'code' => '008',
            'subdistrict_id' => $sumber->id
        ]);
        Village::create([
            'name' => 'Rambaan',
            'code' => '009',
            'subdistrict_id' => $sumber->id
        ]);

        $kuripan = Subdistrict::create([
            'code' => '030',
            'name' => 'Kuripan'
        ]);
        Village::create([
            'name' => 'Wonosari',
            'code' => '001',
            'subdistrict_id' => $kuripan->id
        ]);
        Village::create([
            'name' => 'Jatisari',
            'code' => '002',
            'subdistrict_id' => $kuripan->id
        ]);
        Village::create([
            'name' => 'Kedawung',
            'code' => '003',
            'subdistrict_id' => $kuripan->id
        ]);
        Village::create([
            'name' => 'Karangrejo',
            'code' => '004',
            'subdistrict_id' => $kuripan->id
        ]);
        Village::create([
            'name' => 'Resongo',
            'code' => '005',
            'subdistrict_id' => $kuripan->id
        ]);
        Village::create([
            'name' => 'Wringinanom',
            'code' => '006',
            'subdistrict_id' => $kuripan->id
        ]);
        Village::create([
            'name' => 'Menyono',
            'code' => '007',
            'subdistrict_id' => $kuripan->id
        ]);

        $bantaran = Subdistrict::create([
            'code' => '040',
            'name' => 'Bantaran'
        ]);
        Village::create([
            'name' => 'Karanganyar',
            'code' => '001',
            'subdistrict_id' => $bantaran->id
        ]);
        Village::create([
            'name' => 'Bantaran',
            'code' => '002',
            'subdistrict_id' => $bantaran->id
        ]);
        Village::create([
            'name' => 'Gunung Tugel',
            'code' => '003',
            'subdistrict_id' => $bantaran->id
        ]);
        Village::create([
            'name' => 'Kedungrejo',
            'code' => '004',
            'subdistrict_id' => $bantaran->id
        ]);
        Village::create([
            'name' => 'Besuk',
            'code' => '005',
            'subdistrict_id' => $bantaran->id
        ]);
        Village::create([
            'name' => 'Patokan',
            'code' => '006',
            'subdistrict_id' => $bantaran->id
        ]);
        Village::create([
            'name' => 'Legundi',
            'code' => '007',
            'subdistrict_id' => $bantaran->id
        ]);
        Village::create([
            'name' => 'Tempuran',
            'code' => '008',
            'subdistrict_id' => $bantaran->id
        ]);
        Village::create([
            'name' => 'Kropak',
            'code' => '009',
            'subdistrict_id' => $bantaran->id
        ]);
        Village::create([
            'name' => 'Kramatagung',
            'code' => '010',
            'subdistrict_id' => $bantaran->id
        ]);
        $leces = Subdistrict::create([
            'code' => '050',
            'name' => 'Leces'
        ]);
        Village::create([
            'name' => 'Tigasan Kulon',
            'code' => '001',
            'subdistrict_id' => $leces->id
        ]);
        Village::create([
            'name' => 'Tigasan Wetan',
            'code' => '002',
            'subdistrict_id' => $leces->id
        ]);
        Village::create([
            'name' => 'Malasan Kulon',
            'code' => '003',
            'subdistrict_id' => $leces->id
        ]);
        Village::create([
            'name' => 'Leces',
            'code' => '004',
            'subdistrict_id' => $leces->id
        ]);
        Village::create([
            'name' => 'Pondok Wuluh',
            'code' => '005',
            'subdistrict_id' => $leces->id
        ]);
        Village::create([
            'name' => 'Kerpangan',
            'code' => '006',
            'subdistrict_id' => $leces->id
        ]);
        Village::create([
            'name' => 'Sumber Kedawung',
            'code' => '007',
            'subdistrict_id' => $leces->id
        ]);
        Village::create([
            'name' => 'Clarak',
            'code' => '008',
            'subdistrict_id' => $leces->id
        ]);
        Village::create([
            'name' => 'Jorongan',
            'code' => '009',
            'subdistrict_id' => $leces->id
        ]);
        Village::create([
            'name' => 'Warujinggo',
            'code' => '010',
            'subdistrict_id' => $leces->id
        ]);
        $tegalsiwalan = Subdistrict::create([
            'code' => '060',
            'name' => 'Tegal Siwalan'
        ]);
        Village::create([
            'name' => 'Malasan Wetan',
            'code' => '001',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Gunung Bekel',
            'code' => '002',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Tegalsono',
            'code' => '003',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Bulujaran Kidul',
            'code' => '004',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Bulujaran Lor',
            'code' => '005',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Paras',
            'code' => '006',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Tegalsiwalan',
            'code' => '007',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Banjarsawah',
            'code' => '008',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Sumber Bulu',
            'code' => '009',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Sumber Kledung',
            'code' => '010',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Blado Kulon',
            'code' => '011',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        Village::create([
            'name' => 'Tegal Mojo',
            'code' => '012',
            'subdistrict_id' => $tegalsiwalan->id
        ]);
        $banyuanyar = Subdistrict::create([
            'code' => '070',
            'name' => 'Banyuanyar'
        ]);
        Village::create([
            'name' => 'Gunung Geni',
            'code' => '001',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Liprak Kidul',
            'code' => '002',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Sentulan',
            'code' => '003',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Gading Kulon',
            'code' => '004',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Klenang Kidul',
            'code' => '005',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Klenang Lor',
            'code' => '006',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Tarokan',
            'code' => '007',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Liprak Wetan',
            'code' => '008',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Liprak Kulon',
            'code' => '009',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Banyuanyar Kidul',
            'code' => '010',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Blado Wetan',
            'code' => '011',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Banyuanyar Tengah',
            'code' => '012',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Pendil',
            'code' => '013',
            'subdistrict_id' => $banyuanyar->id
        ]);
        Village::create([
            'name' => 'Alas Sapi',
            'code' => '014',
            'subdistrict_id' => $banyuanyar->id
        ]);

        $tiris = Subdistrict::create([
            'code' => '080',
            'name' => 'Tiris'
        ]);
        Village::create([
            'name' => 'Tlogosari',
            'code' => '001',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Andungsari',
            'code' => '002',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Tlogoargo',
            'code' => '003',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Andungbiru',
            'code' => '004',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Tiris',
            'code' => '005',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Ranuagung',
            'code' => '006',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Segaran',
            'code' => '007',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Ranugedang',
            'code' => '008',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Jangkang',
            'code' => '009',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Wedusan',
            'code' => '010',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Racek',
            'code' => '011',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Pesawahan',
            'code' => '012',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Pedagangan',
            'code' => '013',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Rejing',
            'code' => '014',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Tegalwatu',
            'code' => '015',
            'subdistrict_id' => $tiris->id
        ]);
        Village::create([
            'name' => 'Tulupari',
            'code' => '016',
            'subdistrict_id' => $tiris->id
        ]);
        $krucil = Subdistrict::create([
            'code' => '090',
            'name' => 'Krucil'
        ]);
        Village::create([
            'name' => 'Sumberduren',
            'code' => '001',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Roto',
            'code' => '002',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Kertosuko',
            'code' => '003',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Tambelang',
            'code' => '004',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Krucil',
            'code' => '005',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Bermi',
            'code' => '006',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Kalianan',
            'code' => '007',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Watu Panjang',
            'code' => '008',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Guyangan',
            'code' => '009',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Betek',
            'code' => '010',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Krobongan',
            'code' => '011',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Seneng',
            'code' => '012',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Pandanlaras',
            'code' => '013',
            'subdistrict_id' => $krucil->id
        ]);
        Village::create([
            'name' => 'Plaosan',
            'code' => '014',
            'subdistrict_id' => $krucil->id
        ]);
        $gading = Subdistrict::create([
            'code' => '100',
            'name' => 'Gading'
        ]);
        Village::create([
            'name' => 'Condong',
            'code' => '001',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Jurangrejo',
            'code' => '002',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Ranuwurung',
            'code' => '003',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Gading Wetan',
            'code' => '004',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Bulupandak',
            'code' => '005',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Keben',
            'code' => '006',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Renteng',
            'code' => '007',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Duren',
            'code' => '008',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Betek Taman',
            'code' => '009',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Batur',
            'code' => '010',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Sentul',
            'code' => '011',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Dandang',
            'code' => '012',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Kertosono',
            'code' => '013',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Prasi',
            'code' => '014',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Nogosaren',
            'code' => '015',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Wangkal',
            'code' => '016',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Mojolegi',
            'code' => '017',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Kaliacar',
            'code' => '018',
            'subdistrict_id' => $gading->id
        ]);
        Village::create([
            'name' => 'Sumbersecang',
            'code' => '019',
            'subdistrict_id' => $gading->id
        ]);
        $pakuniran = Subdistrict::create([
            'code' => '110',
            'name' => 'Pakuniran'
        ]);
        Village::create([
            'name' => 'Ranon',
            'code' => '001',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Kedungsumur',
            'code' => '002',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Gunggungan Kidul',
            'code' => '003',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Kalidandan',
            'code' => '004',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Blimbing',
            'code' => '005',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Gondosuli',
            'code' => '006',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Kertonegoro',
            'code' => '007',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Bimo',
            'code' => '008',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Pakuniran',
            'code' => '009',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Patemon',
            'code' => '010',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Gunggungan Lor',
            'code' => '011',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Sogaan',
            'code' => '012',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Sumberkembar',
            'code' => '013',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Alaspandan',
            'code' => '014',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Bucor Wetan',
            'code' => '015',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Bucor Kulon',
            'code' => '016',
            'subdistrict_id' => $pakuniran->id
        ]);
        Village::create([
            'name' => 'Glagah',
            'code' => '017',
            'subdistrict_id' => $pakuniran->id
        ]);
        $kotaanyar = Subdistrict::create([
            'code' => '120',
            'name' => 'Kota Anyar'
        ]);
        Village::create([
            'name' => 'Sumbercenteng',
            'code' => '001',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Sambirapak Kidul',
            'code' => '002',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Sidomulyo',
            'code' => '003',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Tambakukir',
            'code' => '004',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Curahtemu',
            'code' => '005',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Pasembon',
            'code' => '006',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Sidorejo',
            'code' => '007',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Sambirampak Lor',
            'code' => '008',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Sukorejo',
            'code' => '009',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Talkandang',
            'code' => '010',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Kedungrejoso',
            'code' => '011',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Triwungan',
            'code' => '012',
            'subdistrict_id' => $kotaanyar->id
        ]);
        Village::create([
            'name' => 'Kotaanyar',
            'code' => '013',
            'subdistrict_id' => $kotaanyar->id
        ]);
        $paiton = Subdistrict::create([
            'code' => '130',
            'name' => 'Paiton'
        ]);
        Village::create([
            'name' => 'Jabungwetan',
            'code' => '001',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Kalikajar Kulon',
            'code' => '002',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Kalikajar Wetan',
            'code' => '003',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Alas Tengah',
            'code' => '004',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Pandean',
            'code' => '005',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Patunjungan',
            'code' => '006',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Taman',
            'code' => '007',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Plampang',
            'code' => '008',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Sidodadi',
            'code' => '009',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Jabung Candi',
            'code' => '010',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Jabung Sisir',
            'code' => '011',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Randumerak',
            'code' => '012',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Randudatah',
            'code' => '013',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Karanganyar',
            'code' => '014',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Pondok Kelor',
            'code' => '015',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Sukodadi',
            'code' => '016',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Paiton',
            'code' => '017',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Sumberanyar',
            'code' => '018',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Sumberejo',
            'code' => '019',
            'subdistrict_id' => $paiton->id
        ]);
        Village::create([
            'name' => 'Bhinar',
            'code' => '020',
            'subdistrict_id' => $paiton->id
        ]);
        $besuk = Subdistrict::create([
            'code' => '140',
            'name' => 'Besuk'
        ]);
        Village::create([
            'name' => 'Matekan',
            'code' => '001',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Krampilan',
            'code' => '002',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Klampokan',
            'code' => '003',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Jambangan',
            'code' => '004',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Kecik',
            'code' => '005',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Bago',
            'code' => '006',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Alasnyiur',
            'code' => '007',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Sindetanyar',
            'code' => '008',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Sindetlami',
            'code' => '009',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Sumurdalam',
            'code' => '010',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Besuk Kidul',
            'code' => '011',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Besuk Agung',
            'code' => '012',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Randujalak',
            'code' => '013',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Alas Tengah',
            'code' => '014',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Alas Kandang',
            'code' => '015',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Alas Sumur Lor',
            'code' => '016',
            'subdistrict_id' => $besuk->id
        ]);
        Village::create([
            'name' => 'Sumberan',
            'code' => '017',
            'subdistrict_id' => $besuk->id
        ]);
        $kraksaan = Subdistrict::create([
            'code' => '150',
            'name' => 'Kraksaan'
        ]);
        Village::create([
            'name' => 'Kregenan',
            'code' => '001',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Rondokuning',
            'code' => '002',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Semampir',
            'code' => '003',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Bulu',
            'code' => '004',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Sidomukti',
            'code' => '005',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Kraksaan Wetan',
            'code' => '006',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Rangkang',
            'code' => '007',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Kandangjati Kulon',
            'code' => '008',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Kandangjati Wetan',
            'code' => '009',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Alassumur Kulon',
            'code' => '010',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Sumberlele',
            'code' => '011',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Taman Sari',
            'code' => '012',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Asembakor',
            'code' => '013',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Kebon Agung',
            'code' => '014',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Sidopekso',
            'code' => '015',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Patokan',
            'code' => '016',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Asembagus',
            'code' => '017',
            'subdistrict_id' => $kraksaan->id
        ]);
        Village::create([
            'name' => 'Kalibuntu',
            'code' => '018',
            'subdistrict_id' => $kraksaan->id
        ]);
        $krejengan = Subdistrict::create([
            'code' => '160',
            'name' => 'Krejengan'
        ]);
        Village::create([
            'name' => 'Opo Opo',
            'code' => '001',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Rawan',
            'code' => '002',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Seboro',
            'code' => '003',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Karangren',
            'code' => '004',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Kedungcaluk',
            'code' => '005',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Sokaan',
            'code' => '006',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Dawuhan',
            'code' => '007',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Gebangan',
            'code' => '008',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Widoro',
            'code' => '009',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Sumberkatimoho',
            'code' => '010',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Krejengan',
            'code' => '011',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Kamalkuning',
            'code' => '012',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Tanjungsari',
            'code' => '013',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Patemon',
            'code' => '014',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Temenggungan',
            'code' => '015',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Jatiurip',
            'code' => '016',
            'subdistrict_id' => $krejengan->id
        ]);
        Village::create([
            'name' => 'Sentong',
            'code' => '017',
            'subdistrict_id' => $krejengan->id
        ]);
        $pajarakan = Subdistrict::create([
            'code' => '170',
            'name' => 'Pajarakan'
        ]);
        Village::create([
            'name' => 'Seloguding Kulon',
            'code' => '001',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Seloguding Wetan',
            'code' => '002',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Ketompen',
            'code' => '003',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Karangbong',
            'code' => '004',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Karang Pranti',
            'code' => '005',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Gejugan',
            'code' => '006',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Karanggeger',
            'code' => '007',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Tanjung',
            'code' => '008',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Pajarakan Kulon',
            'code' => '009',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Sukokerto',
            'code' => '010',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Sukomulyo',
            'code' => '011',
            'subdistrict_id' => $pajarakan->id
        ]);
        Village::create([
            'name' => 'Penambangan',
            'code' => '012',
            'subdistrict_id' => $pajarakan->id
        ]);
        $maron = Subdistrict::create([
            'code' => '180',
            'name' => 'Maron'
        ]);
        Village::create([
            'name' => 'Sumberpoh',
            'code' => '001',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Sumberdawe',
            'code' => '002',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Brabe',
            'code' => '003',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Maron Kidul',
            'code' => '004',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Gerongan',
            'code' => '005',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Satrean',
            'code' => '006',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Brani Wetan',
            'code' => '007',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Brani Kulon',
            'code' => '008',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Maron Wetan',
            'code' => '009',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Maron Kulon',
            'code' => '010',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Kedungsari',
            'code' => '011',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Pegalangan Kidul',
            'code' => '012',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Burmbungan Kidul',
            'code' => '013',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Wonorejo',
            'code' => '014',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Puspan',
            'code' => '015',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Ganting Wetan',
            'code' => '016',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Ganting Kulon',
            'code' => '017',
            'subdistrict_id' => $maron->id
        ]);
        Village::create([
            'name' => 'Suko',
            'code' => '018',
            'subdistrict_id' => $maron->id
        ]);
        $gending = Subdistrict::create([
            'code' => '190',
            'name' => 'Gending'
        ]);
        Village::create([
            'name' => 'Banyuanyar Lor',
            'code' => '001',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Sumber Kerang',
            'code' => '002',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Sebaung',
            'code' => '003',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Pikatan',
            'code' => '004',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Bulang',
            'code' => '005',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Brumbungan Lor',
            'code' => '006',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Jatiadi',
            'code' => '007',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Klaseman',
            'code' => '008',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Pesisir',
            'code' => '009',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Randupitu',
            'code' => '010',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Gending',
            'code' => '011',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Pajurangan',
            'code' => '012',
            'subdistrict_id' => $gending->id
        ]);
        Village::create([
            'name' => 'Curahsawo',
            'code' => '013',
            'subdistrict_id' => $gending->id
        ]);
        $dringu = Subdistrict::create([
            'code' => '200',
            'name' => 'Dringu'
        ]);
        Village::create([
            'name' => 'Ngepoh',
            'code' => '001',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Sumberagung',
            'code' => '002',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Sumbersuko',
            'code' => '003',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Watuwungkuk',
            'code' => '004',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Sekarkare',
            'code' => '005',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Mranggonlawang',
            'code' => '006',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Tegalrejo',
            'code' => '007',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Kalirejo',
            'code' => '008',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Kedungdalem',
            'code' => '009',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Tamansari',
            'code' => '010',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Randuputih',
            'code' => '011',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Kalisalam',
            'code' => '012',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Dringu',
            'code' => '013',
            'subdistrict_id' => $dringu->id
        ]);
        Village::create([
            'name' => 'Pabean',
            'code' => '014',
            'subdistrict_id' => $dringu->id
        ]);
        $wonomerto = Subdistrict::create([
            'code' => '210',
            'name' => 'Wonomerto'
        ]);
        Village::create([
            'name' => 'Patalan',
            'code' => '001',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Jrebeng',
            'code' => '002',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Wonorejo',
            'code' => '003',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Tunggak Creme',
            'code' => '004',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Pohsangit Tengah',
            'code' => '005',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Kareng Kidul',
            'code' => '006',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Kedungsupit',
            'code' => '007',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Pohsangit Lor',
            'code' => '008',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Pohsangit Ngisor',
            'code' => '009',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Sepuhgempol',
            'code' => '010',
            'subdistrict_id' => $wonomerto->id
        ]);
        Village::create([
            'name' => 'Sumberkare',
            'code' => '011',
            'subdistrict_id' => $wonomerto->id
        ]);
        $lumbang = Subdistrict::create([
            'code' => '220',
            'name' => 'Lumbang'
        ]);
        Village::create([
            'name' => 'Sapih',
            'code' => '001',
            'subdistrict_id' => $lumbang->id
        ]);
        Village::create([
            'name' => 'Negororejo',
            'code' => '002',
            'subdistrict_id' => $lumbang->id
        ]);
        Village::create([
            'name' => 'Branggah',
            'code' => '003',
            'subdistrict_id' => $lumbang->id
        ]);
        Village::create([
            'name' => 'Lambangkuning',
            'code' => '004',
            'subdistrict_id' => $lumbang->id
        ]);
        Village::create([
            'name' => 'Palangbesi',
            'code' => '005',
            'subdistrict_id' => $lumbang->id
        ]);
        Village::create([
            'name' => 'Boto',
            'code' => '006',
            'subdistrict_id' => $lumbang->id
        ]);
        Village::create([
            'name' => 'Wonogoro',
            'code' => '007',
            'subdistrict_id' => $lumbang->id
        ]);
        Village::create([
            'name' => 'Lumbang',
            'code' => '008',
            'subdistrict_id' => $lumbang->id
        ]);
        Village::create([
            'name' => 'Tandon Sentul',
            'code' => '009',
            'subdistrict_id' => $lumbang->id
        ]);
        Village::create([
            'name' => 'Purut',
            'code' => '010',
            'subdistrict_id' => $lumbang->id
        ]);
        $tongas = Subdistrict::create([
            'code' => '230',
            'name' => 'Tongas'
        ]);
        Village::create([
            'name' => 'Pamatan',
            'code' => '001',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Sumberkramat',
            'code' => '002',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Seumberrejo',
            'code' => '003',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Sumendi',
            'code' => '004',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Bayeman',
            'code' => '005',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Dungun',
            'code' => '006',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Curahdringu',
            'code' => '007',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Wringinanom',
            'code' => '008',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Tongas Wetan',
            'code' => '009',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Tongas Kulon',
            'code' => '010',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Curah Tulis',
            'code' => '011',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Klampok',
            'code' => '012',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Tanjungrejo',
            'code' => '013',
            'subdistrict_id' => $tongas->id
        ]);
        Village::create([
            'name' => 'Tambakrejo',
            'code' => '014',
            'subdistrict_id' => $tongas->id
        ]);
        $sumberasih = Subdistrict::create([
            'code' => '240',
            'name' => 'Sumberasih'
        ]);
        Village::create([
            'name' => 'Munengkidul',
            'code' => '001',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Pohsangitleres',
            'code' => '002',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Laweyan',
            'code' => '003',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Muneng',
            'code' => '004',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Jangur',
            'code' => '005',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Sumberbendo',
            'code' => '006',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Mentor',
            'code' => '007',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Sumurmati',
            'code' => '008',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Pesisir',
            'code' => '009',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Lemahkembar',
            'code' => '010',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Ambulu',
            'code' => '011',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Banjarsari',
            'code' => '012',
            'subdistrict_id' => $sumberasih->id
        ]);
        Village::create([
            'name' => 'Gili Ketapang',
            'code' => '013',
            'subdistrict_id' => $sumberasih->id
        ]);
    }
}
