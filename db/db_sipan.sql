-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Jan 2022 pada 09.51
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `nip` int(11) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp_guru` varchar(12) NOT NULL,
  `setoran` double NOT NULL,
  `jk_guru` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_entri` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`nip`, `nama_guru`, `alamat`, `telp_guru`, `setoran`, `jk_guru`, `tgl_entri`) VALUES
(1010, 'SITI NURLAELAH, SKM', 'Tangerang', '08999754257', 20000, 'Perempuan', '2021-12-02 00:00:00'),
(1011, 'Ristiwati', 'Jakarta', '083874169714', 10000, 'Perempuan', '2022-01-16 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kepalasekolah`
--

CREATE TABLE `tb_kepalasekolah` (
  `nip` int(11) NOT NULL,
  `nama_kepsek` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp_kepsek` varchar(12) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kepalasekolah`
--

INSERT INTO `tb_kepalasekolah` (`nip`, `nama_kepsek`, `alamat`, `telp_kepsek`, `jenis_kelamin`) VALUES
(11112, 'YANTO SARIPUDIN, S.E', 'Tangerang', '08123456765', 'Laki-laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengambilan`
--

CREATE TABLE `tb_pengambilan` (
  `kode_ambil` int(5) NOT NULL,
  `nip` int(11) NOT NULL,
  `kode_tabungan` int(15) NOT NULL,
  `besar_ambil` int(20) NOT NULL,
  `tgl_ambil` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengambilan`
--

INSERT INTO `tb_pengambilan` (`kode_ambil`, `nip`, `kode_tabungan`, `besar_ambil`, `tgl_ambil`) VALUES
(1, 1010, 8, 2000, '2022-01-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengambilansiswa`
--

CREATE TABLE `tb_pengambilansiswa` (
  `kode_ambil` int(15) NOT NULL,
  `nis` int(11) NOT NULL,
  `kode_tabungan` int(15) NOT NULL,
  `besar_ambil` float NOT NULL,
  `tgl_ambil` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengambilansiswa`
--

INSERT INTO `tb_pengambilansiswa` (`kode_ambil`, `nis`, `kode_tabungan`, `besar_ambil`, `tgl_ambil`) VALUES
(0, 11111, 4, 2000, '2022-01-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_setorsiswa`
--

CREATE TABLE `tb_setorsiswa` (
  `kode_setor` int(11) NOT NULL,
  `besar_simpanan` float NOT NULL,
  `nis` int(11) NOT NULL,
  `u_entry` varchar(20) NOT NULL,
  `tgl_entri` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_setorsiswa`
--

INSERT INTO `tb_setorsiswa` (`kode_setor`, `besar_simpanan`, `nis`, `u_entry`, `tgl_entri`) VALUES
(1, 10000, 11124, 'ISNAWATI, S.Pd', '2021-12-02'),
(2, 15000, 11123, 'admin', '2022-01-15'),
(3, 2000, 11123, 'admin', '2022-01-15'),
(4, 10000, 11111, 'ISNAWATI, S.Pd', '2022-01-16'),
(5, 10000, 11124, 'ISNAWATI, S.Pd', '2022-01-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_setroguru`
--

CREATE TABLE `tb_setroguru` (
  `kode_setor` int(11) NOT NULL,
  `besar_simpanan` double NOT NULL,
  `nip` int(11) NOT NULL,
  `u_entri` varchar(20) NOT NULL,
  `tgl_entri` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_setroguru`
--

INSERT INTO `tb_setroguru` (`kode_setor`, `besar_simpanan`, `nip`, `u_entri`, `tgl_entri`) VALUES
(1, 10000, 1010, '', '2022-01-15'),
(2, 90000, 1011, '', '2022-01-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `telp_siswa` varchar(20) NOT NULL,
  `setoran` double NOT NULL,
  `jk_siswa` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_entri` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `nama_siswa`, `kelas`, `alamat`, `telp_siswa`, `setoran`, `jk_siswa`, `tgl_entri`) VALUES
(11111, 'niall', '11', 'Tangerang', '089127831182', 10000, 'Laki-laki', '2022-01-15 00:00:00'),
(11123, 'Nada Nurhanifah', '10', 'JL.KH.M.Hasan', '089127831182', 20000, 'Perempuan', '2021-11-23 00:00:00'),
(11124, 'Luthfia Assyifa', '11', 'Tangerang', '083812881391', 10000, 'Perempuan', '2021-11-28 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tabungan`
--

CREATE TABLE `tb_tabungan` (
  `kode_tabungan` int(15) NOT NULL,
  `nip` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `besar_tabungan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tabungan`
--

INSERT INTO `tb_tabungan` (`kode_tabungan`, `nip`, `tgl_mulai`, `besar_tabungan`) VALUES
(8, 1010, '2021-12-02', 28000),
(11, 1011, '2022-01-16', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tabungansiswa`
--

CREATE TABLE `tb_tabungansiswa` (
  `kode_tabungan` int(15) NOT NULL,
  `nis` int(11) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `besar_tabungan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tabungansiswa`
--

INSERT INTO `tb_tabungansiswa` (`kode_tabungan`, `nis`, `tgl_mulai`, `besar_tabungan`) VALUES
(1, 11123, '2021-11-23 00:00:00', 106000),
(3, 11124, '2021-11-28 00:00:00', 30000),
(4, 11111, '2022-01-15 00:00:00', 18000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `kode_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','kepsek','walikelas','guru','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`kode_user`, `nama`, `username`, `password`, `level`) VALUES
(2, 'admin', 'admin', 'admin', 'admin'),
(5, 'ISNAWATI, S.Pd', 'walikelas10', 'walikelas10', 'walikelas'),
(6, 'Luthfia Assyifa', '11124', '11124', 'siswa'),
(7, 'YANTO SARIPUDIN, S.E', '11112', '11112', 'kepsek'),
(8, 'GURU', 'guru', 'guru', 'guru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_kepalasekolah`
--
ALTER TABLE `tb_kepalasekolah`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_pengambilan`
--
ALTER TABLE `tb_pengambilan`
  ADD PRIMARY KEY (`kode_ambil`);

--
-- Indexes for table `tb_pengambilansiswa`
--
ALTER TABLE `tb_pengambilansiswa`
  ADD PRIMARY KEY (`kode_ambil`);

--
-- Indexes for table `tb_setorsiswa`
--
ALTER TABLE `tb_setorsiswa`
  ADD PRIMARY KEY (`kode_setor`);

--
-- Indexes for table `tb_setroguru`
--
ALTER TABLE `tb_setroguru`
  ADD PRIMARY KEY (`kode_setor`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tb_tabungan`
--
ALTER TABLE `tb_tabungan`
  ADD PRIMARY KEY (`kode_tabungan`);

--
-- Indexes for table `tb_tabungansiswa`
--
ALTER TABLE `tb_tabungansiswa`
  ADD PRIMARY KEY (`kode_tabungan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pengambilan`
--
ALTER TABLE `tb_pengambilan`
  MODIFY `kode_ambil` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_setorsiswa`
--
ALTER TABLE `tb_setorsiswa`
  MODIFY `kode_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_setroguru`
--
ALTER TABLE `tb_setroguru`
  MODIFY `kode_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_tabungan`
--
ALTER TABLE `tb_tabungan`
  MODIFY `kode_tabungan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_tabungansiswa`
--
ALTER TABLE `tb_tabungansiswa`
  MODIFY `kode_tabungan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `kode_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
