<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipes = [
            [
                'title' => 'Ayam Woku',
                'description' => 'Ayam Woku adalah masakan tradisional dari Sulawesi Utara yang kaya akan rempah-rempah dan memiliki cita rasa yang pedas dan gurih.',
                'image' => 'images/recipes/ayamwoku.jpg',
                'category' => 'Main Course',
                'rating' => 4.7,
                'likes' => 57,
                'cooking_time' => 40,
                'ingredients' => [
                    '1 ekor ayam, potong-potong',
                    '5 buah bawang merah',
                    '4 siung bawang putih',
                    '3 buah kemiri',
                    '2 batang serai',
                    'Jahe secukupnya',
                    'Lengkuas secukupnya',
                    'Kunyit secukupnya',
                    'Cabai rawit sesuai selera',
                    'Daun kemangi',
                    'Garam dan gula secukupnya'
                ],
                'instructions' => [
                    'Cuci ayam kemudian Rebus ayam sampai dagingnya matang.',
                    'Haluskan bumbu kemudian tumis sampai harum.',
                    'Jika sudah harum masukan ayam, beri sedikit air, gula, garam, dan masako masak sampai ayamnya meresap.',
                    'Jika airnya sudah menyusut masukan kemanggi aduk sebentar.',
                    'Jika sudah matang siap disajikan.'
                ],
                'video_url' => 'https://youtu.be/FbLiC_ha0S4?si=2EZaDcaL5d-ml4eh',
                'status' => 'publish'
            ],
            [
                'title' => 'Ayam Kecap',
                'description' => 'Potongan ayam yang dimasak dengan bumbu kecap manis khas Indonesia, dipadukan dengan bawang bombay, cabai, dan rempah pilihan. Rasanya manis gurih, cocok disantap dengan nasi hangat.',
                'image' => 'images/recipes/ayamkecap.jpg',
                'category' => 'Main Course',
                'rating' => 4.5,
                'likes' => 89,
                'cooking_time' => 30,
                'ingredients' => [
                    '4 siung bawang merah',
                    '2 siung bawang putih',
                    '1 ruas jahe',
                    '1 ruas lengkuas',
                    '5 lembar daun jeruk',
                    '1 batang sereh, geprek',
                    '2-3 sdm kecap manis',
                    '1 cabai merah besar',
                    '4 cabai keriting',
                    '2 sdm kecap asin',
                    'Air secukupnya',
                    '2 sdm margarin',
                    '500 gram ayam potong (bagian paha atas)',
                    'Jeruk nipis'
                ],
                'instructions' => [
                    'Cuci bersih ayam dan balurkan dengan jeruk nipis. Kemudian, diamkan beberapa saat.',
                    'Goreng ayam setengah matang.',
                    'Haluskan bawang merah, bawang putih, jahe, dan lengkuas. Setelah halus, tumis hingga harum.',
                    'Masukkan sereh, daun jeruk, cabai merah besar, dan cabai keriting. Kemudian, masukkan air.',
                    'Setelah air menyusut, masukkan ayam yang sudah digoreng setengah matang.',
                    'Setelah ayam matang, masukkan kecap manis dan kecap asin. Kemudian koreksi rasanya.',
                    'Jika rasa sudah pas, biarkan air menyusut. Sesekali aduk agar semua bumbu dan rempah tercampur. Ayam siap disajikan.'
                ],
                'video_url' => 'https://youtu.be/30tUKHBl8cg?si=2WrD-wyqDIEPS-LS',
                'status' => 'publish'
            ],
            [
                'title' => 'Pindang Serani Ikan Patin',
                'description' => 'Sup ikan khas pesisir Jepara dengan kuah bening segar. Menggunakan ikan patin yang lembut, dipadukan dengan irisan tomat, serai, jahe, dan daun kemangi yang memberikan aroma sedap dan rasa asam pedas menyegarkan.',
                'image' => 'images/recipes/pindangserani.jpg',
                'category' => 'Main Course',
                'rating' => 4.2,
                'likes' => 34,
                'cooking_time' => 45,
                'ingredients' => [
                    '500 gram ikan patin',
                    '1 buah jeruk nipis',
                    '1 sdt garam',
                    '10 siung bawang merah',
                    '5 siung bawang putih',
                    '1 ruas jahe',
                    '1 ruas kunyit',
                    '3 buah cabai merah besar',
                    '2 batang sereh',
                    '1 ruas lengkuas',
                    '3 lembar daun salam',
                    '3 lembar daun jeruk',
                    '8 buah belimbing wuluh',
                    '2 buah tomat merah',
                    '5 buah cabai rawit merah',
                    '1,5 liter air matang',
                    '1 sdm garam',
                    '1 sdm kaldu jamur',
                    '1 sdm gula pasir',
                    '2 sdm air asam jawa'
                ],
                'instructions' => [
                    'Cuci bersih ikan patin, lalu marinasi dengan garam dan perasan air jeruk nipis. Diamkan selama 10 menit.',
                    'Blender bumbu halus, lalu sisihkan.',
                    'Tumis bumbu aromatik sampai harum, lalu masukkan bumbu halus. Masak hingga bumbu pecah minyak.',
                    'Setelah bumbu mulai pecah minyak, tambahkan air matang dan masak hingga mendidih.',
                    'Masukkan bumbu-bumbu lainnya, lalu koreksi rasa. Setelah sesuai, masukkan ikan patin dan masak hingga air mendidih kembali.',
                    'Masukkan tomat dan belimbing wuluh, lalu masak hingga ikan matang.',
                    'Terakhir, masukkan daun kemangi dan aduk rata. Pindang Serani siap dinikmati!'
                ],
                'video_url' => 'https://youtu.be/iTTUfia_mdo?si=gw99z3ZE1ajPSYeu',
                'status' => 'publish'
            ],
            [
                'title' => 'Pudding Regal',
                'description' => 'Puding lembut berlapis biskuit Marie Regal, disajikan dingin dengan saus susu atau karamel. Teksturnya creamy dan manis, cocok untuk penutup yang memanjakan lidah.',
                'image' => 'images/recipes/puddingregal.jpeg',
                'category' => 'Dessert',
                'rating' => 4.8,
                'likes' => 67,
                'cooking_time' => 25,
                'ingredients' => [
                    '1 bungkus Nutrijell Pudding Susu Belgian Chocolate',
                    '1 bungkus Nutrijell Jelly Powder Dark Chocolate',
                    '1 bungkus Nutrijell My Vla Vanilla',
                    '1 bungkus biskuit Regal kecil',
                    '1000 ml air',
                    '5 sdm gula pasir',
                    'Sejumput garam (untuk vla)'
                ],
                'instructions' => [
                    'Masukkan pudding dan jelly powder ke dalam panci, tambahkan air. Aduk sampai tercampur rata, lalu masak dengan api sedang hingga mendidih. Matikan api.',
                    'Masak vla vanilla secara terpisah, tambahkan sejumput garam agar lebih gurih.',
                    'Siapkan cetakan. Tuang lapisan pertama pudding dan tunggu hingga set.',
                    'Letakkan biskuit Regal di atas lapisan pertama, lalu tuang kembali pudding untuk lapisan kedua dan tunggu hingga set.',
                    'Pada layer terakhir, tuangkan vla vanilla lalu letakkan kembali biskuit Regal di atasnya.',
                    'Masukkan ke dalam chiller selama 2–5 jam hingga dingin dan set. Pudding Regal siap disantap!'
                ],
                'video_url' => 'https://youtu.be/Z51_8XTYG-k?si=59f4mIZU0JGM-UT9',
                'status' => 'publish'
            ],
            [
                'title' => 'Mango Sticky Rice',
                'description' => 'Makanan penutup khas Thailand yang terdiri dari ketan pulen, potongan mangga manis, dan siraman santan gurih. Kombinasi rasa manis, asin, dan legit yang harmonis.',
                'image' => 'images/recipes/mangosticky.jpg',
                'category' => 'Dessert',
                'rating' => 4.9,
                'likes' => 124,
                'cooking_time' => 40,
                'ingredients' => [
                    '2 buah mangga Thailand ukuran sedang',
                    '100 gram ketan putih',
                    '120 ml santan kelapa atau 2 pouch Kara segitiga',
                    '1 sdm gula pasir',
                    '1 lembar daun pandan'
                ],
                'instructions' => [
                    'Kupas mangga dan sisihkan.',
                    'Cuci beras ketan, lalu rebus dengan santan dan daun pandan selama sekitar 20 menit atau hingga santan meresap ke ketan.',
                    'Pindahkan ketan ke dalam kukusan dan kukus kembali hingga matang sempurna.',
                    'Untuk saus: panaskan santan kental dengan sedikit air, tambahkan sedikit garam, dan jika perlu tambahkan sedikit maizena agar lebih kental.',
                    'Aduk rata dan sisihkan.',
                    'Tata ketan dan irisan mangga di atas piring, siram dengan saus santan, dan sajikan.'
                ],
                'video_url' => 'https://youtu.be/YoOPxqyjLro?si=3MJYEx7O__FEaHb0',
                'status' => 'publish'
            ],
            [
                'title' => 'Salad Buah',
                'description' => 'Campuran aneka buah segar seperti apel, melon, semangka, dan anggur, disajikan dengan saus mayones dan keju parut di atasnya. Segar dan kaya vitamin!',
                'image' => 'images/recipes/saladbuah.jpg',
                'category' => 'Dessert',
                'rating' => 4.6,
                'likes' => 78,
                'cooking_time' => 20,
                'ingredients' => [
                    'Stroberi',
                    'Mangga',
                    'Kiwi',
                    'Anggur',
                    'Melon',
                    'Apel',
                    'Nata de coco (tanpa airnya)',
                    '500 gram mayonnaise',
                    '250 gram yoghurt',
                    '250 gram kental manis',
                    'Keju yang sudah diparut'
                ],
                'instructions' => [
                    'Potong buah-buahan menjadi dadu berukuran kecil.',
                    'Tuangkan semua buah yang sudah dipotong ke dalam mangkuk besar.',
                    'Masukkan semua bahan saus ke dalam mangkuk berisi buah.',
                    'Aduk hingga semua bahan tercampur merata.',
                    'Taburkan parutan keju di atasnya, lalu sajikan.'
                ],
                'video_url' => 'https://youtu.be/u7QfzLYeBBY?si=og9WHLEG1TX6KkBQ',
                'status' => 'publish'
            ],
            [
                'title' => 'Singkong Thai',
                'description' => 'Singkong rebus yang empuk dan legit, disiram dengan kuah santan kental yang gurih dan sedikit manis. Sajian sederhana yang memuaskan.',
                'image' => 'images/recipes/singkongthai.jpg',
                'category' => 'Appetizer',
                'rating' => 4.6,
                'likes' => 78,
                'cooking_time' => 30,
                'ingredients' => [
                    '500 gram singkong',
                    '1 liter air',
                    '1 sdt garam',
                    '2 lembar daun pandan',
                    '300 ml air',
                    '1 sdm maizena',
                    '2 sdm air biasa',
                    '2 sdm gula pasir',
                    'Keju parut'
                ],
                'instructions' => [
                    'Singkong dikupas lalu dicuci sampai bersih, selanjutnya dipotong dadu.',
                    'Siapkan panci, masukkan singkong, garam, dan daun pandan, lalu direbus sampai lunak.',
                    'Sambil menunggu singkong matang, buat vla dengan cara merebus air, gula, dan daun pandan sampai mendidih.',
                    'Kemudian masukkan campuran maizena dan air sambil diaduk hingga kental.',
                    'Setelah singkong lunak, biarkan dingin pada suhu ruang.',
                    'Sajikan singkong dengan vla dan taburan keju parut.'
                ],
                'video_url' => 'https://youtu.be/Buf909Kv37E?si=6SNpv4vs3inf92k9',
                'status' => 'publish'
            ],
            [
                'title' => 'Tahu Isi Bihun',
                'description' => 'Tahu goreng yang diisi dengan campuran bihun dan sayuran berbumbu gurih. Cocok sebagai camilan atau pelengkap makan.',
                'image' => 'images/recipes/tahubihun.jpg',
                'category' => 'Appetizer',
                'rating' => 4.6,
                'likes' => 78,
                'cooking_time' => 20,
                'ingredients' => [
                    '26 buah tahu kulit kotak',
                    '500 ml minyak untuk menggoreng',
                    '50 gram bihun jagung',
                    '2 siung bawang putih iris',
                    '3 butir bawang merah iris',
                    '100 gram wortel potong korek api',
                    '50 gram kol iris halus',
                    '1 1/2 sdt kecap asin',
                    '1 sdt garam',
                    '1/4 sdt merica bubuk',
                    '1/2 sdt gula pasir',
                    '50 ml air',
                    '1 batang daun bawang iris halus',
                    '1 sdm minyak untuk menumis',
                    '150 gram tepung terigu protein sedang',
                    '1/2 sdm tepung sagu',
                    '1/2 sdt baking powder',
                    '1 butir telur',
                    '150 ml air',
                    '1 sdt garam',
                    '1/4 sdt merica bubuk'
                ],
                'instructions' => [
                    'Panaskan minyak di wajan.',
                    'Tumis bawang putih dan bawang merah hingga harum.',
                    'Masukkan wortel dan kol, masak hingga layu.',
                    'Tambahkan bihun, kecap asin, garam, merica bubuk, dan gula pasir. Aduk rata.',
                    'Tuang air, masak sambil diaduk sesekali hingga matang dan air menyusut.',
                    'Isi tahu yang sudah dilubangi dengan tumisan isian sayuran dan bihun.',
                    'Celupkan tahu ke dalam adonan pencelup yang sudah diaduk rata.',
                    'Goreng tahu dalam minyak panas dengan api sedang hingga kuning keemasan. Angkat dan sajikan selagi hangat.'
                ],
                'video_url' => 'https://youtu.be/0gmZsHZFDfQ?si=Xd0PDFQLYOpK9K6y',
                'status' => 'publish'
            ],
            [
                'title' => 'Tiramisu Dessert',
                'description' => 'Versi manis dari tiramisu Italia yang lembut dan creamy, disajikan dalam gelas. Perpaduan kopi, krim, dan biskuit memberikan rasa yang kaya dan elegan.',
                'image' => 'images/recipes/tiramisudessert.jpg',
                'category' => 'Dessert',
                'rating' => 4.6,
                'likes' => 78,
                'cooking_time' => 50,
                'ingredients' => [
                    '250 gram keju mascarpone',
                    '1/2 cup gula pasir',
                    '1 sendok teh vanili ekstrak',
                    '1 paket kue ladyfinger (Savoiardi)',
                    '1 cup kopi yang sudah diseduh dan dingin',
                    '2 sendok makan cokelat bubuk untuk taburan',
                    '1 cup krim kental',
                    '2 sendok makan gula pasir',
                    '1/2 sendok teh vanili ekstrak',
                    'Cokelat parut',
                    'Bubuk kakao',
                    'Kacang almond cincang'
                ],
                'instructions' => [
                    'Campur keju mascarpone, gula pasir, dan vanili ekstrak dalam mangkuk. Aduk hingga tercampur rata dan konsisten. Simpan di lemari es selama persiapan lapisan lain.',
                    'Celupkan ladyfinger ke dalam kopi yang sudah diseduh dan didinginkan, lalu letakkan di bagian dasar jar sebagai lapisan pertama.',
                    'Kocok krim kental, gula pasir, dan vanili ekstrak hingga membentuk puncak yang lembut dan kental.',
                    'Letakkan sebagian krim keju mascarpone di atas lapisan kue.',
                    'Tambahkan lapisan whipped cream di atasnya.',
                    'Ulangi proses ini dengan menambahkan lapisan kue, krim keju mascarpone, dan whipped cream hingga jar terisi penuh.',
                    'Taburi dengan cokelat bubuk.',
                    'Hias dengan cokelat parut, bubuk kakao, dan kacang almond cincang sesuai selera.',
                    'Tutup jar dan simpan dalam lemari es selama beberapa jam atau semalam untuk memadatkan rasa.'
                ],
                'video_url' => 'https://youtu.be/7VTtenyKRg4?si=1Cz0GXIZURoVvd8J',
                'status' => 'publish'
            ],
            [
                'title' => 'Strawberry Matcha Latte',
                'description' => 'Minuman cantik berlapis dengan rasa segar stroberi dan aroma matcha yang khas, dipadukan dengan susu creamy. Cocok dinikmati dingin atau hangat.',
                'image' => 'images/recipes/strawberrymatcha.jpeg',
                'category' => 'Drinks',
                'rating' => 4.6,
                'likes' => 78,
                'cooking_time' => 20,
                'ingredients' => [
                    '2 sendok teh bubuk matcha',
                    '2 buah stroberi segar (plus sedikit untuk hiasan)',
                    '150 ml susu pilihan (susu cair, almond, kedelai, atau sesuai selera)',
                    '1–2 sendok makan madu atau sirup gula (sesuai selera)',
                    'Es batu (opsional, untuk versi dingin)',
                    'Whipped cream atau foam dingin dari stroberi (opsional)'
                ],
                'instructions' => [
                    'Ayak bubuk matcha ke dalam mangkuk kecil.',
                    'Tuang sedikit air panas (sekitar 50 ml) dan kocok dengan whisk atau garpu hingga matcha larut dan berbusa.',
                    'Blender stroberi segar hingga halus untuk membuat puree. Jika ingin rasa lebih manis, tambahkan madu atau sirup gula ke dalam blender dan aduk rata.',
                    'Campurkan matcha yang sudah larut ke dalam gelas. Tambahkan susu pilihan dan aduk rata.',
                    'Jika ingin versi dingin, bisa tambahkan es batu ke dalam gelas.',
                    'Tuang strawberry puree di atasnya secara perlahan sehingga terbentuk lapisan menarik.',
                    'Tambahkan whipped cream atau foam dari stroberi di atas jika suka.',
                    'Hiasi dengan stroberi segar yang dipotong kecil di atasnya.'
                ],
                'video_url' => 'https://youtu.be/y81HrOvgM9o?si=2AuwYMNBWnj_vVTa',
                'status' => 'publish'
            ],
            [
                'title' => 'Es Kuwut Timun',
                'description' => 'Minuman segar khas Bali yang terdiri dari air kelapa, serutan timun, biji selasih, jeruk nipis, dan melon. Rasanya menyegarkan, cocok untuk cuaca panas.',
                'image' => 'images/recipes/eskuwut.png',
                'category' => 'Drinks',
                'rating' => 4.6,
                'likes' => 78,
                'cooking_time' => 20,
                'ingredients' => [
                    '300 gram buah timun, diserut halus',
                    '150 gram daging kelapa muda, diserut panjang',
                    'Biji selasih yang sudah direndam, secukupnya',
                    'Es batu secukupnya',
                    '300 ml air',
                    'Gula cair secukupnya',
                    '150 ml perasan air jeruk nipis',
                    'Potongan jeruk nipis'
                ],
                'instructions' => [
                    'Campurkan buah timun dengan kelapa muda.',
                    'Masukkan air dan gula cair. Aduk semuanya hingga tercampur rata. Koreksi rasa.',
                    'Jika manisnya sudah cukup, tambahkan perasan air jeruk nipis secara perlahan hingga rasa asamnya pas.',
                    'Masukkan juga potongan jeruk nipis ke dalamnya. Jangan lupa masukkan selasih.',
                    'Es kuwut timun sudah siap untuk disajikan. Agar rasanya lebih segar, simpan dalam lemari es atau tambahkan es batu saat disajikan.'
                ],
                'video_url' => 'https://youtu.be/H_8fVsFfxP0?si=4DoGMV0e_Y8sQPEG',
                'status' => 'publish'
            ],
            [
                'title' => 'Wedang Jahe',
                'description' => 'Minuman tradisional hangat dari jahe, gula merah, dan rempah-rempah seperti sereh dan kayu manis. Cocok untuk menghangatkan badan dan menyehatkan.',
                'image' => 'images/recipes/wedangjahe.jpeg',
                'category' => 'Drinks',
                'rating' => 4.6,
                'likes' => 78,
                'cooking_time' => 20,
                'ingredients' => [
                    '1 liter air',
                    '100 gram jahe, kupas, iris kasar dan memarkan',
                    '2 batang serai, memarkan',
                    '2 lembar daun pandan, potong-potong ukuran sedang',
                    '200 gram gula merah, rajang halus (bisa diganti gula batu)',
                    '¼ sendok teh garam',
                    '1 batang kayu manis sekitar 3-4 cm (opsional)'
                ],
                'instructions' => [
                    'Rebus air bersama jahe, serai, daun pandan, kayu manis, gula merah, serta sedikit garam.',
                    'Masak dalam keadaan tertutup dengan api kecil selama 20-30 menit agar sari dari rempah keluar.',
                    'Saring ampas rempah-rempah dan Wedang Jahe siap disajikan.'
                ],
                'video_url' => 'https://youtu.be/3IiC8HD-ZDw?si=GUhdMgUMsNLpTz5f',
                'status' => 'publish'
            ]
        ];

        foreach ($recipes as $recipe) {
            Recipe::create($recipe);
        }
    }
}
