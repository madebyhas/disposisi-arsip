<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Lembar Disposisi</title>

    <style>
        .container {
            max-width: auto;
            margin: auto;
            padding: 5px 10px 0 10px;
            /* Perkecil padding */
            border: 1px solid #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0px 5px 0px;
            /* Kurangi margin */
        }

        td {
            vertical-align: top;
            /* Selaraskan konten di bagian atas sel */
            padding: 5px;
            /* Tambahkan padding untuk jarak */
        }

        td label {
            display: flex;
            /* Gunakan flexbox untuk menyelaraskan checkbox dan label */
            align-items: center;
            /* Selaraskan checkbox dan teks di tengah secara vertikal */
            margin-bottom: 5px;
            /* Tambahkan jarak antar baris */
        }

        td input[type="checkbox"] {
            margin-right: 8px;
            /* Jarak antara checkbox dan label teks */
        }



        .title {
            text-align: center;
            padding: 10px 0;
            /* Kurangi padding atas dan bawah */
            font-weight: bold;
            margin: 5px 0;
            /* Kurangi margin */
        }

        .catatan {
            display: flex;
            flex-direction: column;
            padding: 5px 10px;
            /* Perkecil padding */
            margin: 5px 0;
            /* Kurangi margin */
            border: 1px solid #000;
        }

        .catatan h3 {
            margin-bottom: 5px;
            font-size: 14px;
            /* Opsional: kecilkan font */
        }

        textarea {
            width: 100%;
            resize: none;
            padding: 5px;
            /* Kurangi padding dalam textarea */
            font-size: 12px;
            /* Opsional: kecilkan font */
            border: 1px solid #000;
            border-radius: 4px;
        }

        .footer {
            text-align: right;
            /* Align all text to the right */
            margin-top: 30px;
            /* Add 50px space from the top */
            padding-right: 10px;
            /* Add 10px space from the right edge */
        }

        .footer .dir {
            padding-right: 50px;
            /* Add 10px space from the right edge */
            margin: 0;
            /* Remove margin from .dir */
        }

        .footer .pt {
            margin: 0;
            /* Remove margin from .pt */
        }

        .footer .kab {
            padding-right: 50px;
            /* Add 10px space from the right edge */
            margin: 0;
            /* Remove margin from .kab */
        }

        .footer .signature {
            margin-top: 50px;
            /* Add 50px space from the top */
            margin-bottom: 20px;
            /* Add 20px space from the bottom */
            margin-left: 0;
            /* Optional: ensure no left margin */
            padding-right: 10px;
            /* Add 10px space from the right edge */

        }

        .footer hr {
            margin: 0;
            /* Remove margin from <hr> */
        }

        .footer .ar {
            margin-top: 20px;
            /* Remove margin from <hr> */
            padding-right: 50px;
            /* Add 10px space from the right edge */
        }

        .footer p {
            margin: 0;
            /* Remove margin from <p> */
        }

        hr {
            border: 1px solid #000;
            /* Garis horizontal */
            margin: 10px 0;
        }
    </style>

</head>

<body>
    <div id="lembar" class="container">
        {{-- kop surat --}}
        <div class="row justify-content-center" style="align-items: center">
            <table width="100%" style="min-height: 100px;">
                <tr>
                    <td width="25%">

                    </td>
                    <td width="50%" style="text-align: center; vertical-align: middle;">
                        <p style="margin: 0;">PERUSAHAAN UMUM DAERAH AIR MINUM</p>
                        <h1 style="margin: 0;">TIRTA BENING</h1>
                        <h3 style="margin: 0;">KABUPATEN PATI</h3>
                        <p style="margin: 0;">Jl. Raya Pati - Juwana Km. 4 Pati</p>
                        <p style="margin: 0;">Telp. (0295) 382259, 382998 Fax. (0295) 3814102</p>
                        <p style="margin: 0;">Email: pdam_tirtabening@yahoo.com</p>
                    </td>
                    <td width="25%">
                        <img src="../public/logo.jpg" style="width: 100%;" alt="Logo">

                    </td>
                </tr>
            </table>
            <hr>
        </div>
        {{-- end kop surat --}}

        <div class="title"
            style="text-align: center; vertical-align: middle; margin-top: 10px; margin-bottom: 10px padding-top: 20px; padding-bottom: 20px">
            LEMBAR DISPOSISI
        </div>

        <hr>
        <div class="container">
            <table style="width: 100%; min-height: 100px; border-collapse: collapse; padding-bottom: 0;">
                <tr>
                    <!-- Left Column -->
                    <td style="width: 50%; vertical-align: top; border-right: 1px solid #000000; padding: 3px;">
                        <strong>Surat dari:</strong> {{ $disposisi->suratmasuk->asal_surat }} <br>
                        <strong>No. Surat:</strong> {{ $disposisi->suratmasuk->no_surat }} <br>
                        <strong>Tgl. Surat:</strong> {{ $disposisi->suratmasuk->tgl_surat->format('d-M-Y') }}
                        <br>
                    </td>

                    <!-- Right Column -->
                    <td style="width: 50%; vertical-align: top;  padding-left: 10px; padding: 3px;">
                        <strong>Perihal:</strong> {{ $disposisi->suratmasuk->perihal }} <br>
                        <strong>Diterima Tgl:</strong> {{ date('d-M-Y', strtotime($disposisi->suratmasuk->tgl_diterima)) }} <br>
                        <strong>No. Agenda:</strong> {{ $disposisi->no_agenda }} <br>
                        <strong>Sifat:</strong> {{ $disposisi->sifat }} <br>
                    </td>
                </tr>
            </table>
        </div>

        {{-- <div class="container">
            <table style="width: 100%; min-height: 100px; border-collapse: collapse;">
                <tr>
                    <!-- Left Column -->
                    <td style="width: 50%; vertical-align: top;  padding: 3px; border-right: 1px solid #000000;">
                        <p style="font-weight: bold; padding-bottom: 5px;">Diteruskan kepada sdr.:</p>

                        @php
                        $tujuanDispoArray = explode(', ', $disposisi->suratmasuk->tujuan_dispo ?? '');
                        @endphp

                        <label><input type="checkbox" {{ in_array('Direktur Teknik', $tujuanDispoArray) ? 'checked' : ''
                                }} />
                            Direktur Teknik</label>
                        <label><input type="checkbox" {{ in_array('Kabag Keuangan', $tujuanDispoArray) ? 'checked' : ''
                                }} />
                            Kabag. Keuangan</label><br>
                        <label><input type="checkbox" {{ in_array('Kepala SPI', $tujuanDispoArray) ? 'checked' : ''
                                }} />
                            Kepala SPI</label>
                        <label><input type="checkbox" {{ in_array('Kabag Perencanaan', $tujuanDispoArray) ? 'checked'
                                : '' }} />
                            Kabag Perencanaan</label><br>
                        <label><input type="checkbox" {{ in_array('Kabag Prod & Dist', $tujuanDispoArray) ? 'checked'
                                : '' }} />
                            Kabag Prod &amp; Dist</label>
                        <label><input type="checkbox" {{ in_array('Kabag Umum', $tujuanDispoArray) ? 'checked' : ''
                                }} />
                            Kabag Umum</label><br>
                        <label><input type="checkbox" {{ in_array('Kabag Hublang', $tujuanDispoArray) ? 'checked' : ''
                                }} />
                            Kabag Hublang</label>
                    </td>

                    <!-- Right Column -->
                    <td style="width: 50%;  padding-top: 3px; padding-left: 10px; vertical-align: top;">
                        <p style="font-weight: bold;  padding-bottom: 5px;">Dengan Hormat Harap:</p>

                        @php
                        $sifatArray = explode(', ', $disposisi->keterangan ?? '');
                        @endphp

                        <label><input type="checkbox" {{ in_array('Tanggapan dan Saran', $sifatArray) ? 'checked' : ''
                                }} />
                            Tanggapan dan Saran</label><br>
                        <label><input type="checkbox" {{ in_array('Proses lebih lanjut', $sifatArray) ? 'checked' : ''
                                }} />
                            Proses lebih lanjut</label><br>
                        <label><input type="checkbox" {{ in_array('Koordinasi/konfirmasikan', $sifatArray) ? 'checked'
                                : '' }} />
                            Koordinasi / konfirmasikan</label>
                    </td>
                </tr>
            </table>
        </div> --}}

        <div class="container">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <!-- Left Column -->
                    <td style="width: 50%; border-right: 1px solid #000;">
                        <p style="font-weight: bold;">Diteruskan kepada sdr.:</p>

                        @php
                        $tujuanDispoArray = explode(', ', $disposisi->suratmasuk->tujuan_dispo ?? '');
                        @endphp


                        <label><input type="checkbox" {{ in_array('Direktur Teknik', $tujuanDispoArray) ? 'checked' : '' }}> Direktur Teknik</label>
                        <label><input type="checkbox" {{ in_array('Kabag Keuangan', $tujuanDispoArray) ? 'checked' : '' }}> Kabag. Keuangan</label>
                        <label><input type="checkbox" {{ in_array('Kepala SPI', $tujuanDispoArray) ? 'checked' : '' }}> Kepala SPI</label>
                        <label><input type="checkbox" {{ in_array('Kabag Perencanaan', $tujuanDispoArray) ? 'checked' : '' }}> Kabag Perencanaan</label>
                        <label><input type="checkbox" {{ in_array('Kabag Prod & Dist', $tujuanDispoArray) ? 'checked' : '' }}> Kabag Prod &amp; Dist</label>
                        <label><input type="checkbox" {{ in_array('Kabag Umum', $tujuanDispoArray) ? 'checked' : '' }}> Kabag Umum</label>
                        <label><input type="checkbox" {{ in_array('Kabag Hublang', $tujuanDispoArray) ? 'checked' : '' }}> Kabag Hublang</label>
                    </td>
        
                    <!-- Right Column -->
                    <td style="width: 50%; padding-left: 10px;">
                        <p style="font-weight: bold;">Dengan hormat harap :</p>
                        
                        @php
                        $sifatArray = explode(', ', $disposisi->keterangan ?? '');
                        @endphp

                        <label><input type="checkbox" {{ in_array('Tanggapan dan Saran', $sifatArray) ? 'checked' : '' }}> Tanggapan dan Saran</label>
                        <label><input type="checkbox" {{ in_array('Proses Lebih Lanjut', $sifatArray) ? 'checked' : '' }}> Proses lebih lanjut</label>
                        <label><input type="checkbox" {{ in_array('Koordinasi/Konfirmasikan', $sifatArray) ? 'checked' : '' }}> Koordinasi / konfirmasikan</label>
                    </td>
                </tr>
            </table>
        </div>
        

        <div class="catatan">

            <p style="font-weight: bold; margin-bottom: 5px;">Catatan:</p>
            <div class="cat" style="border: 1px solid #000; padding: 5px; margin: 5px 0;">
                @if($disposisi->catatan->isEmpty())
                <p style="margin: 0;">Tidak ada catatan untuk disposisi ini.</p>
                @else
                @foreach($disposisi->catatan as $catatan)
                <div style="margin-bottom: 10px;">
                    <p style="margin: 0; font-weight: bold;">{{ $catatan->pegawai->hak_akses }} {{ $catatan->pegawai->divisi }}:</p>
                    <p style="margin: 0; padding-left: 10px; color: #333;"> - {{ $catatan->catatan }}</p>
                </div>
                <br>
                @endforeach
                @endif
            </div>

            <div class="footer" style="padding-right: 5px; padding-top: 20px;">
                <div class="dir">
                    <p>Direktur Utama</p>
                </div>
                <div class="pt">
                    <p>Perumda Air Minum Tirta Bening</p>
                </div>
                <div class="kab">
                    <p>Kabupaten Pati</p>
                </div>
                <p class="signature">( ........................................... )</p>
            </div>
        </div>
        <p>
            Arsip: 
            {{ $disposisi->arsip ? $disposisi->arsip->id_arsip : 'Belum tersedia' }}
            Tanggal: 
            {{ $disposisi->arsip ? date('d-M-Y', strtotime($disposisi->arsip->tgl_arsip)) : 'Belum tersedia' }}
        </p>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>