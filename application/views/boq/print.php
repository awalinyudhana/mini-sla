<?php

  $this->fpdf->FPDF("L","cm","A4");
  // kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
  $this->fpdf->SetMargins(1,1,1);
  /* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
  di footer, nanti kita akan membuat page number dengan format : number page / total page
  */
  $this->fpdf->AliasNbPages();
  // AddPage merupakan fungsi untuk membuat halaman baru
  $this->fpdf->AddPage();
  // Setting Font : String Family, String Style, Font size
  $this->fpdf->SetFont('Times','B',12);
  $this->fpdf->Cell(30,0.7,'Laporan Produk '.$nama.'  Jasa Jawa Barat',0,'C','C');
  $this->fpdf->Ln();
  $this->fpdf->Cell(30,0.7,'Periode Bulan Agustus',0,'C','C');
  $this->fpdf->Line(1,3.5,30,3.5);
  $this->fpdf->Output("laporan.pdf","I");
?>