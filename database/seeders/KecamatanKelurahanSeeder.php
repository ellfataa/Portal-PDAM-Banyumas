<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class KecamatanKelurahanSeeder extends Seeder
{
    public function run(): void
    {
        // Simpan daftar kecamatan
        $kecamatanList = [
            1 => 'Lumbir',
            2 => 'Wangon',
            3 => 'Jatilawang',
            4 => 'Rawalo',
            5 => 'Kebasen',
            6 => 'Kemranjen',
            7 => 'Sumpiuh',
            8 => 'Tambak',
            9 => 'Somagede',
            10 => 'Kalibagor',
            11 => 'Banyumas',
            12 => 'Patikraja',
            13 => 'Purwojati',
            14 => 'Ajibarang',
            15 => 'Gumelar',
            16 => 'Pekuncen',
            17 => 'Cilongok',
            18 => 'Karanglewas',
            19 => 'Kedungbanteng',
            20 => 'Baturraden',
            21 => 'Sumbang',
            22 => 'Kembaran',
            23 => 'Sokaraja',
            24 => 'Purwokerto Selatan',
            25 => 'Purwokerto Barat',
            26 => 'Purwokerto Timur',
            27 => 'Purwokerto Utara',
        ];

        // Insert kecamatan
        foreach ($kecamatanList as $id => $nama) {
            Kecamatan::create(['id' => $id, 'nama' => $nama]);
        }

        // Data lengkap kelurahan dengan kecamatan_id
        $kelurahans = [
            // Ajibarang (14)
            ['nama' => 'Ajibarang Kulon', 'kecamatan_id' => 14],
            ['nama' => 'Ajibarang Wetan', 'kecamatan_id' => 14],
            ['nama' => 'Banjarsari', 'kecamatan_id' => 14],
            ['nama' => 'Ciberung', 'kecamatan_id' => 14],
            ['nama' => 'Darmakradenan', 'kecamatan_id' => 14],
            ['nama' => 'Jingkang', 'kecamatan_id' => 14],
            ['nama' => 'Kalibenda', 'kecamatan_id' => 14],
            ['nama' => 'Karangbawang', 'kecamatan_id' => 14],
            ['nama' => 'Kracak', 'kecamatan_id' => 14],
            ['nama' => 'Lesmana', 'kecamatan_id' => 14],
            ['nama' => 'Pancasan', 'kecamatan_id' => 14],
            ['nama' => 'Pancurendang', 'kecamatan_id' => 14],
            ['nama' => 'Pandansari', 'kecamatan_id' => 14],
            ['nama' => 'Sawangan', 'kecamatan_id' => 14],
            ['nama' => 'Tipar Kidul', 'kecamatan_id' => 14],

            // Banyumas (11)
            ['nama' => 'Binangun', 'kecamatan_id' => 11],
            ['nama' => 'Danaraja', 'kecamatan_id' => 11],
            ['nama' => 'Dawuhan', 'kecamatan_id' => 11],
            ['nama' => 'Kalisube', 'kecamatan_id' => 11],
            ['nama' => 'Karangrau', 'kecamatan_id' => 11],
            ['nama' => 'Kedunggede', 'kecamatan_id' => 11],
            ['nama' => 'Kedunguter', 'kecamatan_id' => 11],
            ['nama' => 'Kejawar', 'kecamatan_id' => 11],
            ['nama' => 'Papringan', 'kecamatan_id' => 11],
            ['nama' => 'Pasinggangan', 'kecamatan_id' => 11],
            ['nama' => 'Pekunden', 'kecamatan_id' => 11],
            ['nama' => 'Sudagaran', 'kecamatan_id' => 11],

            // Baturraden (20)
            ['nama' => 'Karang Tengah', 'kecamatan_id' => 20],
            ['nama' => 'Karangmangu', 'kecamatan_id' => 20],
            ['nama' => 'Karangsalam Lor', 'kecamatan_id' => 20],
            ['nama' => 'Kebumen', 'kecamatan_id' => 20],
            ['nama' => 'Kemutug Kidul', 'kecamatan_id' => 20],
            ['nama' => 'Kemutug Lor', 'kecamatan_id' => 20],
            ['nama' => 'Ketenger', 'kecamatan_id' => 20],
            ['nama' => 'Kutasari', 'kecamatan_id' => 20],
            ['nama' => 'Pamijen', 'kecamatan_id' => 20],
            ['nama' => 'Pandak', 'kecamatan_id' => 20],
            ['nama' => 'Purwosari', 'kecamatan_id' => 20],
            ['nama' => 'Rempoah', 'kecamatan_id' => 20],

            // Cilongok (17)
            ['nama' => 'Batuanten', 'kecamatan_id' => 17],
            ['nama' => 'Cikidang', 'kecamatan_id' => 17],
            ['nama' => 'Cilongok', 'kecamatan_id' => 17],
            ['nama' => 'Cipete', 'kecamatan_id' => 17],
            ['nama' => 'Gununglurah', 'kecamatan_id' => 17],
            ['nama' => 'Jatisaba', 'kecamatan_id' => 17],
            ['nama' => 'Kalisari', 'kecamatan_id' => 17],
            ['nama' => 'Karanglo', 'kecamatan_id' => 17],
            ['nama' => 'Karangtengah', 'kecamatan_id' => 17],
            ['nama' => 'Kasegeran', 'kecamatan_id' => 17],
            ['nama' => 'Langgongsari', 'kecamatan_id' => 17],
            ['nama' => 'Pageraji', 'kecamatan_id' => 17],
            ['nama' => 'Panembangan', 'kecamatan_id' => 17],
            ['nama' => 'Panusupan', 'kecamatan_id' => 17],
            ['nama' => 'Pejogol', 'kecamatan_id' => 17],
            ['nama' => 'Pernasidi', 'kecamatan_id' => 17],
            ['nama' => 'Rancamaya', 'kecamatan_id' => 17],
            ['nama' => 'Sambirata', 'kecamatan_id' => 17],
            ['nama' => 'Sokawera', 'kecamatan_id' => 17],
            ['nama' => 'Sudimara', 'kecamatan_id' => 17],

            // Gumelar (15)
            ['nama' => 'Cihonje', 'kecamatan_id' => 15],
            ['nama' => 'Cilangkap', 'kecamatan_id' => 15],
            ['nama' => 'Gancang', 'kecamatan_id' => 15],
            ['nama' => 'Gumelar', 'kecamatan_id' => 15],
            ['nama' => 'Karangkemojing', 'kecamatan_id' => 15],
            ['nama' => 'Kedungurang', 'kecamatan_id' => 15],
            ['nama' => 'Paningkaban', 'kecamatan_id' => 15],
            ['nama' => 'Samudra', 'kecamatan_id' => 15],
            ['nama' => 'Samudra Kulon', 'kecamatan_id' => 15],
            ['nama' => 'Tlaga', 'kecamatan_id' => 15],

            // Kalibagor (10)
            ['nama' => 'Kalibagor', 'kecamatan_id' => 10],
            ['nama' => 'Kalicupak Kidul', 'kecamatan_id' => 10],
            ['nama' => 'Kalicupak Lor', 'kecamatan_id' => 10],
            ['nama' => 'Kaliori', 'kecamatan_id' => 10],
            ['nama' => 'Kalisogra Wetan', 'kecamatan_id' => 10],
            ['nama' => 'Karangdadap', 'kecamatan_id' => 10],
            ['nama' => 'Pajerukan', 'kecamatan_id' => 10],
            ['nama' => 'Pekaja', 'kecamatan_id' => 10],
            ['nama' => 'Petir', 'kecamatan_id' => 10],
            ['nama' => 'Srowot', 'kecamatan_id' => 10],
            ['nama' => 'Suro', 'kecamatan_id' => 10],
            ['nama' => 'Wlahar Wetan', 'kecamatan_id' => 10],

            // Karanglewas (18)
            ['nama' => 'Babakan', 'kecamatan_id' => 18],
            ['nama' => 'Jipang', 'kecamatan_id' => 18],
            ['nama' => 'Karanggude Kulon', 'kecamatan_id' => 18],
            ['nama' => 'Karangkemiri', 'kecamatan_id' => 18],
            ['nama' => 'Karanglewas Kidul', 'kecamatan_id' => 18],
            ['nama' => 'Kediri', 'kecamatan_id' => 18],
            ['nama' => 'Pangebatan', 'kecamatan_id' => 18],
            ['nama' => 'Pasir Kulon', 'kecamatan_id' => 18],
            ['nama' => 'Pasir Lor', 'kecamatan_id' => 18],
            ['nama' => 'Pasir Wetan', 'kecamatan_id' => 18],
            ['nama' => 'Singasari', 'kecamatan_id' => 18],
            ['nama' => 'Sunyalangu', 'kecamatan_id' => 18],
            ['nama' => 'Tamansari', 'kecamatan_id' => 18],

            // Kebasen (5)
            ['nama' => 'Adisana', 'kecamatan_id' => 5],
            ['nama' => 'Bangsa', 'kecamatan_id' => 5],
            ['nama' => 'Cindaga', 'kecamatan_id' => 5],
            ['nama' => 'Gambarsari', 'kecamatan_id' => 5],
            ['nama' => 'Kalisalak', 'kecamatan_id' => 5],
            ['nama' => 'Kaliwedi', 'kecamatan_id' => 5],
            ['nama' => 'Karangsari', 'kecamatan_id' => 5],
            ['nama' => 'Kebasen', 'kecamatan_id' => 5],
            ['nama' => 'Mandirancan', 'kecamatan_id' => 5],
            ['nama' => 'Randegan', 'kecamatan_id' => 5],
            ['nama' => 'Sawangan', 'kecamatan_id' => 5],
            ['nama' => 'Tumiyang', 'kecamatan_id' => 5],

            // Kedungbanteng (19)
            ['nama' => 'Baseh', 'kecamatan_id' => 19],
            ['nama' => 'Beji', 'kecamatan_id' => 19],
            ['nama' => 'Dawuhan Kulon', 'kecamatan_id' => 19],
            ['nama' => 'Dawuhan Wetan', 'kecamatan_id' => 19],
            ['nama' => 'Kalikesur', 'kecamatan_id' => 19],
            ['nama' => 'Kalisalak', 'kecamatan_id' => 19],
            ['nama' => 'Karangnangka', 'kecamatan_id' => 19],
            ['nama' => 'Karangsalam Kidul', 'kecamatan_id' => 19],
            ['nama' => 'Kebocoran', 'kecamatan_id' => 19],
            ['nama' => 'Kedung Banteng', 'kecamatan_id' => 19],
            ['nama' => 'Keniten', 'kecamatan_id' => 19],
            ['nama' => 'Kutaliman', 'kecamatan_id' => 19],
            ['nama' => 'Melung', 'kecamatan_id' => 19],
            ['nama' => 'Windujaya', 'kecamatan_id' => 19],

            // Kembaran (22)
            ['nama' => 'Bantarwuni', 'kecamatan_id' => 22],
            ['nama' => 'Bojongsari', 'kecamatan_id' => 22],
            ['nama' => 'Dukuhwaluh', 'kecamatan_id' => 22],
            ['nama' => 'Karangsari', 'kecamatan_id' => 22],
            ['nama' => 'Karangsoka', 'kecamatan_id' => 22],
            ['nama' => 'Karangtengah', 'kecamatan_id' => 22],
            ['nama' => 'Kembaran', 'kecamatan_id' => 22],
            ['nama' => 'Kramat', 'kecamatan_id' => 22],
            ['nama' => 'Ledug', 'kecamatan_id' => 22],
            ['nama' => 'Linggasari', 'kecamatan_id' => 22],
            ['nama' => 'Pliken', 'kecamatan_id' => 22],
            ['nama' => 'Purbadana', 'kecamatan_id' => 22],
            ['nama' => 'Purwodadi', 'kecamatan_id' => 22],
            ['nama' => 'Sambeng Kulon', 'kecamatan_id' => 22],
            ['nama' => 'Sambeng Wetan', 'kecamatan_id' => 22],
            ['nama' => 'Tambaksari Kidul', 'kecamatan_id' => 22],

            // Kemranjen (6)
            ['nama' => 'Alasmalang', 'kecamatan_id' => 6],
            ['nama' => 'Grujugan', 'kecamatan_id' => 6],
            ['nama' => 'Karanggintung', 'kecamatan_id' => 6],
            ['nama' => 'Karangjati', 'kecamatan_id' => 6],
            ['nama' => 'Karangsalam', 'kecamatan_id' => 6],

            // Jatilawang (3)
            ['nama' => 'Adisara', 'kecamatan_id' => 3],
            ['nama' => 'Bantar', 'kecamatan_id' => 3],
            ['nama' => 'Gentawangi', 'kecamatan_id' => 3],
            ['nama' => 'Gunung Wetan', 'kecamatan_id' => 3],
            ['nama' => 'Karanganyar', 'kecamatan_id' => 3],
            ['nama' => 'Karanglewas', 'kecamatan_id' => 3],
            ['nama' => 'Kedungwringin', 'kecamatan_id' => 3],
            ['nama' => 'Margasana', 'kecamatan_id' => 3],
            ['nama' => 'Pekuncen', 'kecamatan_id' => 3],
            ['nama' => 'Tinggarjaya', 'kecamatan_id' => 3],
            ['nama' => 'Tunjung', 'kecamatan_id' => 3],

            // Lumbir (1)
            ['nama' => 'Besuki', 'kecamatan_id' => 1],
            ['nama' => 'Canduk', 'kecamatan_id' => 1],
            ['nama' => 'Cidora', 'kecamatan_id' => 1],
            ['nama' => 'Cingebul', 'kecamatan_id' => 1],
            ['nama' => 'Cirahab', 'kecamatan_id' => 1],
            ['nama' => 'Dermaji', 'kecamatan_id' => 1],
            ['nama' => 'Karanggayam', 'kecamatan_id' => 1],
            ['nama' => 'Kedunggede', 'kecamatan_id' => 1],
            ['nama' => 'Lumbir', 'kecamatan_id' => 1],
            ['nama' => 'Parungkamal', 'kecamatan_id' => 1],

            // Patikraja (12)
            ['nama' => 'Karanganyar', 'kecamatan_id' => 12],
            ['nama' => 'Karangendep', 'kecamatan_id' => 12],
            ['nama' => 'Kedungrandu', 'kecamatan_id' => 12],
            ['nama' => 'Kedungwringin', 'kecamatan_id' => 12],
            ['nama' => 'Kedungwuluh Kidul', 'kecamatan_id' => 12],
            ['nama' => 'Kedungwuluh Lor', 'kecamatan_id' => 12],
            ['nama' => 'Notog', 'kecamatan_id' => 12],
            ['nama' => 'Patikraja', 'kecamatan_id' => 12],
            ['nama' => 'Pegalongan', 'kecamatan_id' => 12],
            ['nama' => 'Sawangan Wetan', 'kecamatan_id' => 12],
            ['nama' => 'Sidabowa', 'kecamatan_id' => 12],
            ['nama' => 'Sokawera Kidul', 'kecamatan_id' => 12],
            ['nama' => 'Wlahar Kulon', 'kecamatan_id' => 12],

            // Pekuncen (16)
            ['nama' => 'Banjaranyar', 'kecamatan_id' => 16],
            ['nama' => 'Candinegara', 'kecamatan_id' => 16],
            ['nama' => 'Cibangkong', 'kecamatan_id' => 16],
            ['nama' => 'Cikawung', 'kecamatan_id' => 16],
            ['nama' => 'Cikembulan', 'kecamatan_id' => 16],
            ['nama' => 'Glempang', 'kecamatan_id' => 16],
            ['nama' => 'Karangkemiri', 'kecamatan_id' => 16],
            ['nama' => 'Karangklesem', 'kecamatan_id' => 16],
            ['nama' => 'Krajan', 'kecamatan_id' => 16],
            ['nama' => 'Kranggan', 'kecamatan_id' => 16],
            ['nama' => 'Pasiraman Kidul', 'kecamatan_id' => 16],
            ['nama' => 'Pasiraman Lor', 'kecamatan_id' => 16],
            ['nama' => 'Pekuncen', 'kecamatan_id' => 16],
            ['nama' => 'Petahunan', 'kecamatan_id' => 16],
            ['nama' => 'Semedo', 'kecamatan_id' => 16],
            ['nama' => 'Tumiyang', 'kecamatan_id' => 16],

            // Purwojati (13)
            ['nama' => 'Gerduren', 'kecamatan_id' => 13],
            ['nama' => 'Kaliputih', 'kecamatan_id' => 13],
            ['nama' => 'Kalitapen', 'kecamatan_id' => 13],
            ['nama' => 'Kaliurip', 'kecamatan_id' => 13],
            ['nama' => 'Kaliwangi', 'kecamatan_id' => 13],
            ['nama' => 'Karangmangu', 'kecamatan_id' => 13],
            ['nama' => 'Karangtalun Kidul', 'kecamatan_id' => 13],
            ['nama' => 'Karangtalun Lor', 'kecamatan_id' => 13],
            ['nama' => 'Klapasawit', 'kecamatan_id' => 13],
            ['nama' => 'Purwojati', 'kecamatan_id' => 13],

            // Purwokerto Barat (25)
            ['nama' => 'Bantarsoka', 'kecamatan_id' => 25],
            ['nama' => 'Karanglewas Lor', 'kecamatan_id' => 25],
            ['nama' => 'Kedungwuluh', 'kecamatan_id' => 25],
            ['nama' => 'Kober', 'kecamatan_id' => 25],
            ['nama' => 'Pasir Kidul', 'kecamatan_id' => 25],
            ['nama' => 'Pasirmuncang', 'kecamatan_id' => 25],
            ['nama' => 'Rejasari', 'kecamatan_id' => 25],

            // Purwokerto Selatan (24)
            ['nama' => 'Berkoh', 'kecamatan_id' => 24],
            ['nama' => 'Karangklesem', 'kecamatan_id' => 24],
            ['nama' => 'Karangpucung', 'kecamatan_id' => 24],
            ['nama' => 'Purwokerto Kidul', 'kecamatan_id' => 24],
            ['nama' => 'Purwokerto Kulon', 'kecamatan_id' => 24],
            ['nama' => 'Tanjung', 'kecamatan_id' => 24],
            ['nama' => 'Teluk', 'kecamatan_id' => 24],

            // Purwokerto Timur (26)
            ['nama' => 'Arcawinangun', 'kecamatan_id' => 26],
            ['nama' => 'Kranji', 'kecamatan_id' => 26],
            ['nama' => 'Mersi', 'kecamatan_id' => 26],
            ['nama' => 'Purwokerto Lor', 'kecamatan_id' => 26],
            ['nama' => 'Purwokerto Wetan', 'kecamatan_id' => 26],
            ['nama' => 'Sokanegara', 'kecamatan_id' => 26],

            // Purwokerto Utara (27)
            ['nama' => 'Bancarkembar', 'kecamatan_id' => 27],
            ['nama' => 'Bobosan', 'kecamatan_id' => 27],
            ['nama' => 'Grendeng', 'kecamatan_id' => 27],
            ['nama' => 'Karangwangkal', 'kecamatan_id' => 27],
            ['nama' => 'Pabuaran', 'kecamatan_id' => 27],
            ['nama' => 'Purwanegara', 'kecamatan_id' => 27],
            ['nama' => 'Sumampir', 'kecamatan_id' => 27],

            // Rawalo (4)
            ['nama' => 'Banjarparakan', 'kecamatan_id' => 4],
            ['nama' => 'Losari', 'kecamatan_id' => 4],
            ['nama' => 'Menganti', 'kecamatan_id' => 4],
            ['nama' => 'Pesawahan', 'kecamatan_id' => 4],
            ['nama' => 'Rawalo', 'kecamatan_id' => 4],
            ['nama' => 'Sanggreman', 'kecamatan_id' => 4],
            ['nama' => 'Sidamulih', 'kecamatan_id' => 4],
            ['nama' => 'Tambaknegara', 'kecamatan_id' => 4],
            ['nama' => 'Tipar', 'kecamatan_id' => 4],

            // Sokaraja (23)
            ['nama' => 'Banjaranyar', 'kecamatan_id' => 23],
            ['nama' => 'Banjarsari Kidul', 'kecamatan_id' => 23],
            ['nama' => 'Jompo Kulon', 'kecamatan_id' => 23],
            ['nama' => 'Kalikidang', 'kecamatan_id' => 23],
            ['nama' => 'Karangduren', 'kecamatan_id' => 23],
            ['nama' => 'Karangkedawung', 'kecamatan_id' => 23],
            ['nama' => 'Karangnanas', 'kecamatan_id' => 23],
            ['nama' => 'Karangrau', 'kecamatan_id' => 23],
            ['nama' => 'Kedondong', 'kecamatan_id' => 23],
            ['nama' => 'Klahang', 'kecamatan_id' => 23],
            ['nama' => 'Lemberang', 'kecamatan_id' => 23],
            ['nama' => 'Pamijen', 'kecamatan_id' => 23],
            ['nama' => 'Sokaraja Kidul', 'kecamatan_id' => 23],
            ['nama' => 'Sokaraja Kulon', 'kecamatan_id' => 23],
            ['nama' => 'Sokaraja Lor', 'kecamatan_id' => 23],
            ['nama' => 'Sokaraja Tengah', 'kecamatan_id' => 23],
            ['nama' => 'Sokaraja Wetan', 'kecamatan_id' => 23],
            ['nama' => 'Wiradadi', 'kecamatan_id' => 23],

            // Somagede (9)
            ['nama' => 'Kanding', 'kecamatan_id' => 9],
            ['nama' => 'Kemawi', 'kecamatan_id' => 9],
            ['nama' => 'Klinting', 'kecamatan_id' => 9],
            ['nama' => 'Piasa Kulon', 'kecamatan_id' => 9],
            ['nama' => 'Plana', 'kecamatan_id' => 9],
            ['nama' => 'Sokawera', 'kecamatan_id' => 9],
            ['nama' => 'Somagede', 'kecamatan_id' => 9],

            // Sumbang (21)
            ['nama' => 'Banjarsari Kulon', 'kecamatan_id' => 21],
            ['nama' => 'Banjarsari Wetan', 'kecamatan_id' => 21],
            ['nama' => 'Banteran', 'kecamatan_id' => 21],
            ['nama' => 'Ciberem', 'kecamatan_id' => 21],
            ['nama' => 'Datar', 'kecamatan_id' => 21],
            ['nama' => 'Gandatapa', 'kecamatan_id' => 21],
            ['nama' => 'Karangcegak', 'kecamatan_id' => 21],
            ['nama' => 'Karanggintung', 'kecamatan_id' => 21],
            ['nama' => 'Karangturi', 'kecamatan_id' => 21],
            ['nama' => 'Kawungcarang', 'kecamatan_id' => 21],
            ['nama' => 'Kebanggan', 'kecamatan_id' => 21],
            ['nama' => 'Kedungmalang', 'kecamatan_id' => 21],
            ['nama' => 'Kotayasa', 'kecamatan_id' => 21],
            ['nama' => 'Limpakuwus', 'kecamatan_id' => 21],
            ['nama' => 'Sikapat', 'kecamatan_id' => 21],
            ['nama' => 'Silado', 'kecamatan_id' => 21],
            ['nama' => 'Sumbang', 'kecamatan_id' => 21],
            ['nama' => 'Susukan', 'kecamatan_id' => 21],
            ['nama' => 'Tambaksogra', 'kecamatan_id' => 21],

            // Sumpiuh (7)
            ['nama' => 'Banjarpanepen', 'kecamatan_id' => 7],
            ['nama' => 'Bogangin', 'kecamatan_id' => 7],
            ['nama' => 'Karanggedang', 'kecamatan_id' => 7],
            ['nama' => 'Kemiri', 'kecamatan_id' => 7],
            ['nama' => 'Ketanda', 'kecamatan_id' => 7],
            ['nama' => 'Kuntili', 'kecamatan_id' => 7],
            ['nama' => 'Lebeng', 'kecamatan_id' => 7],
            ['nama' => 'Nusadadi', 'kecamatan_id' => 7],
            ['nama' => 'Pandak', 'kecamatan_id' => 7],
            ['nama' => 'Selandaka', 'kecamatan_id' => 7],
            ['nama' => 'Selanegara', 'kecamatan_id' => 7],
            ['nama' => 'Kebokura', 'kecamatan_id' => 7],
            ['nama' => 'Kradenan', 'kecamatan_id' => 7],
            ['nama' => 'Sumpiuh', 'kecamatan_id' => 7],

            // Tambak (8)
            ['nama' => 'Karangpetir', 'kecamatan_id' => 8],
            ['nama' => 'Karangpucung', 'kecamatan_id' => 8],
            ['nama' => 'Kamulyan', 'kecamatan_id' => 8],

            // Wangon (2)
            ['nama' => 'Banteran', 'kecamatan_id' => 2],
            ['nama' => 'Cikakak', 'kecamatan_id' => 2],
            ['nama' => 'Jambu', 'kecamatan_id' => 2],
            ['nama' => 'Jurangbahas', 'kecamatan_id' => 2],
            ['nama' => 'Klapagading', 'kecamatan_id' => 2],
            ['nama' => 'Klapagading Kulon', 'kecamatan_id' => 2],
            ['nama' => 'Pangadegan', 'kecamatan_id' => 2],
            ['nama' => 'Wangon', 'kecamatan_id' => 2],
        ];

        // Insert kelurahan
        foreach ($kelurahans as $data) {
            Kelurahan::create($data);
        }
    }
}