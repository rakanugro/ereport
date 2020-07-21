<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PT. Pelabuhan Tanjung Priok</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td colspan="4">&nbsp;</td>
    <td width="16%">NO</td>
    <td width="3%">:</td>
    <td width="31%">&nbsp;</td>
  </tr>
  <tr>
    <td width="17%" rowspan="3"><img src="templateslide/assets/img/icon/ptplogo.png" width="130" alt=""></td>
    <td colspan="3" rowspan="3"><b>FORM PERINTAH TINDAKAN KOREKTIF ATAS KETIDAKSESUAIAN (FORM PTKAK)</b></td>
    <td>REVISI</td>
    <td>:</td>
    <td>{{$items->REVISION}}</td>
  </tr>
  <tr>
    <td>TANGGAL</td>
    <td>:</td>
    <td><?php echo tgl_indo(date('Y-m-d',  strtotime($items->PTKAK_DATE)));  ?></td>
  </tr>
  <tr>
    <td>HALAMAN</td>
    <td>:</td>
    <td>{{$items->PAGE}}</td>
  </tr>
  <tr>
    <td><b>No. PTKAK</b></td>
    <td width="1%">:</td>
    <td colspan="5">{{$items->NO_PTKAK}}</td>
  </tr>
  <tr style="background-color: #d1e0e0;">
    <td style="padding: 10px;"><b>Jenis</b></td>
    <td>:</td>
    <td style="padding: 10px;" width="20%"><input type="checkbox" name="name1" {{ $items->TYPE == "1" ? 'checked' : '' }} /> Tindakan Perbaikan</td>
    <td style="padding: 10px;" width="20%"><input type="checkbox" name="name1" {{ $items->TYPE == "2" ? 'checked' : '' }} /> Tindakan Pencegahan</td>
    <td style="padding: 10px;"><b>Sumber</b></td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Pengusul/Auditor</td>
    <td>:</td>
    <td colspan="2">{{$items->F_SUB_DIVISION_NAME}}</td>
    <td colspan="3"><input type="checkbox" name="name1" {{ $items->TYPE == "1" ? 'checked' : '' }}/> Audit Internal [AI]</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="name1" {{ $items->TYPE == "2" ? 'checked' : '' }}/> Komplain/ Keluhan Pelanggan [KP]</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="name1" {{ $items->TYPE == "3" ? 'checked' : '' }}/> Trend Proses/ Layanan Tidak Sesuai [TP]</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="name1" {{ $items->TYPE == "4" ? 'checked' : '' }}/> Tinjauan Manajemen [TM]</td>
  </tr>
  <tr>
    <td>Ditujukan /Auditan </td>
    <td>:</td>
    <td colspan="2">{{$items->T_SUB_DIVISION_NAME}}</td>
    <td colspan="3"><input type="checkbox" name="name1" {{ $items->TYPE == "5" ? 'checked' : '' }}/> Program Improvement/ Peningkatan [PI]</td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td>:</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="3"><input type="checkbox" name="name1" {{ $items->TYPE == "6" ? 'checked' : '' }}/> Lain-Lain [LL]</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr style="background-color: #d1e0e0;">
    <td colspan="6" style="padding: 10px;"><b>Temuan/ Ketidaksesuaian/ Masalah Potensial</b></td>
    <td style="padding: 10px;">Diterima PIC /Auditan :</td>
  </tr>
  <tr>
    <td>Uraian</td>
    <td>:</td>
    <td colspan="4" rowspan="3">{{$items->DESCRIPTION}}<</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Tanggal : </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="background-color: #d1e0e0;padding: 10px;"><b>Tgl. Penyelesaian :</b></td>
  </tr>
  <tr>
    <td>Lokasi</td>
    <td>:</td>
    <td colspan="4">{{$items->LOCATION}}</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Bukti</td>
    <td>:</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="background-color: #d1e0e0;padding: 10px;">Pengusul/Auditor :</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>Referensi</td>
    <td>:</td>
    <td colspan="4">{{$items->PTKAK_REFERENCES}}</td>
    <td>Tanggal :</td>
  </tr>
   <tr style="background-color: #d1e0e0;">
    <td colspan="7" style="padding: 10px;" ><b>Tindakan Awal</b></td>
  </tr>
   <tr>
    <td height="78" colspan="7">{{$items->FIRST_ACT}}</td>
  </tr>
   <tr style="background-color: #d1e0e0;">
    <td colspan="7" style="padding: 10px;"><b>Tindakan Pencegahan</b></td>
  </tr>
   <tr>
    <td height="78" colspan="7">{{$items->CAUSE}}</td>
  </tr>
  <tr style="background-color: #d1e0e0;">
    <td colspan="7" style="padding: 10px;"><b>Tindakan Koreksi/ Tindakan Perbaikan</b></td>
  </tr>
   <tr>
    <td height="78" colspan="7">{{$items->ACT}}</td>
  </tr>
   <tr style="background-color: #d1e0e0;">
    <td colspan="7" style="padding: 10px;"><b>Tindakan Pencegahan</b></td>
  </tr>
   <tr>
    <td height="78" colspan="7">{{$items->PREVENTIVE}}</td>
  </tr>
  <tr>
    <td style="background-color: #d1e0e0;padding: 10px;"><b>Verifikasi 1</b></td>
    <td>&nbsp;</td>
    <td style="background-color: #d1e0e0;padding: 10px;"><b>Tanggal :</b></td>
    <td>&nbsp;</td>
    <td style="background-color: #d1e0e0;padding: 10px;">&nbsp;</td>
    <td style="background-color: #d1e0e0;padding: 10px;">&nbsp;</td>
    <td style="background-color: #d1e0e0;padding: 10px;">Status :</td>
  </tr>
  <tr>
    <td>Komentar</td>
    <td>:</td>
    <td colspan="4">&nbsp;</td>
    <td><input type="checkbox" name="name1" {{ $items->VERIFIED_STATUS_2 == "0" ? 'checked' : '' }}/>
      OPEN (blm selesai/belum efektif)</td>
  </tr>
  <tr>
    <td colspan="4">{{$items->NAMA_VERIFIED_BY_2}}</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="name1" {{ $items->VERIFIED_STATUS_2 == "1" ? 'checked' : '' }}/>
      CLOSED (sdh selesai/efektif)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Diverifikasi Oleh :</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Pihak Terkait/ Auditor</td>
  </tr>
  <tr>
    <td>Mengetahui</td>
    <td>:</td>
    <td colspan="2">(Koordinator Audit InternaL)</td>
    <td colspan="2">Catatan Tambahan :</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="113">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">PTKAK yang telah selesai diverifikasi, harus dikembalikan kepada Koord. Audit Internal dan atau <br />
    VP/DVP terkait untuk disimpan.</td>
  </tr>
</table>

</body>
<?php
  function tgl_indo($tanggal){

    $bulan = array (
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );

    $pecahkan = explode('-', $tanggal);

      // variabel pecahkan 0 = tanggal
      // variabel pecahkan 1 = bulan
      // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }
?>
</html>
