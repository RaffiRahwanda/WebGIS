@extends('layouts.app')

@section('content')
 <main class="py-4">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
           <div class="card-header"><h2>Tentang WebGIS</h2></div>

                <div class="card-body">
                    
                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 col-md-8"><p>1. <b>TSS (Total Suspended Solids)</b>:
                  TSS mengacu pada jumlah total partikel padat yang tersuspensi dalam air, seperti lumpur, tanah, bahan organik, dan limbah lainnya. 
                  Pengukuran TSS penting karena partikel-partikel ini dapat mempengaruhi kejernihan air dan kemampuan ekosistem perairan untuk mendukung kehidupan.

                        </p>
                        <p>
                            2. <b>BOD (Biochemical Oxygen Demand)</b>:
                             BOD mengukur jumlah oksigen yang dibutuhkan oleh mikroorganisme untuk menguraikan bahan organik dalam air secara biokimia. 
                             Tingkat BOD yang tinggi menunjukkan adanya polutan organik yang signifikan, yang jika tidak diolah dengan baik, dapat menguras oksigen dalam air dan mengganggu ekosistem akuatik.

                        </p>
                    
                        <p>
                            3. <b>DO (Dissolved Oxygen)</b>:
                                DO adalah konsentrasi oksigen terlarut dalam air, yang sangat penting untuk kehidupan akuatik. Organisme seperti ikan dan plankton membutuhkan DO untuk bernapas. 
                                Kadar DO yang rendah dapat mengakibatkan "kematian" pada zona oksigen rendah (dead zone) di perairan.
                        </p>
                        <p>
                            4. <b>COD (Chemical Oxygen Demand)</b>:
   COD mengukur jumlah total oksigen yang dibutuhkan untuk mengoksidasi bahan kimia dalam air. Berbeda dengan BOD yang mengukur penguraian bahan organik secara biologis, COD mencakup juga bahan kimia non-biologis yang dapat mempengaruhi kualitas air.

                        </p>
                        <p>
                        5. <b>Fosfat</b>:
                            Fosfat adalah bentuk fosfor yang sering kali menjadi pembatas dalam pertumbuhan alga dan dapat menyebabkan eutrofikasi (peningkatan nutrisi yang berlebihan) di perairan. 
                        Pengukuran fosfat penting untuk mengendalikan pertumbuhan alga yang berlebihan.
                        </p>
                        <p>
                            6. <b>Fecal Coliform</b>:
   Fecal coliform adalah kelompok bakteri yang ditemukan dalam usus hewan endotermik (yang berdarah panas) dan manusia. Keberadaannya dalam air umumnya menunjukkan kontaminasi oleh limbah domestik atau hewan yang dapat menyebabkan penyakit jika terpapar

                        </p>
                        <p>
                            7. <b>Total Coliform</b>:
   Total coliform adalah kelompok bakteri yang meliputi tidak hanya fecal coliform tetapi juga bakteri lain yang hidup di lingkungan yang serupa. Pengukuran total coliform dapat memberikan indikasi umum tentang kebersihan air dan kemungkinan adanya kontaminasi dari sumber-sumber alami atau manusia.
        
                        </p>
                        <h4>
                              Metode Analisis untuk Setiap Parameter:      
                        </h4>
                                <ul style="line-height:180%">
                                    <li>
                                        <b>TSS (Total Suspended Solids)</b>: TSS diukur dengan menyaring sampel air dan menimbang padatan yang tersuspensi setelah pengeringan.
                                    </li>
                                    <li>
                                        <b>BOD (Biochemical Oxygen Demand)</b>: BOD diukur dengan mengamati penurunan oksigen terlarut dalam waktu tertentu ketika sampel air diinkubasi pada suhu dan kondisi yang terkontrol.
                                    </li>
                                    <li>
                                        <b>DO (Dissolved Oxygen)</b>: DO diukur dengan elektroda DO atau metode lain yang dapat memberikan nilai konsentrasi oksigen terlarut dalam air.
                                    </li>
                                    <li>
                                        <b>COD (Chemical Oxygen Demand)</b>: COD diukur dengan metode kimia untuk menentukan jumlah oksigen yang dibutuhkan untuk mengoksidasi bahan organik dan anorganik dalam sampel air.
                                    </li>
                                    <li>
                                        <b>Fosfat</b>: Fosfat diukur dengan metode spektrofotometri atau kimia untuk menentukan konsentrasi fosfat total dalam air.
                                    </li>
                                    <li>
                                        <b>Fecal Coliform dan Total Coliform</b>: Coliform diukur dengan teknik kultur bakteri untuk menentukan jumlah koloni bakteri coliform dalam sampel air, yang dapat memberikan indikasi kontaminasi oleh limbah organik.
                                    </li>

                                </ul>
                    </div>
                    <div class="col-6 col-md-4">

                    <div class="card">
                         <div class="card-header">Detail dan Hasil </div>
                                <div class="card-body">
                                    @foreach($item as $items)
                                  <ul>
                                    <li><a href="{{ route('map.show', $items->slug) }}">{{$items->name}}</a></li>
                                </ul>
                                @endforeach
                                </div>
                    </div>
                    </div>
                </div>

                </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>
</main>


@endsection