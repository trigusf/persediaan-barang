    <nav id="sidebar">
        <div class="list">
            <button class="close" onclick="toggleClose()">X</button>
            <ul>
                <li>
                    <div class="img"></div>
                    <p><?php echo $_SESSION['username'];?></p>
                    <a href="#" class="edit-profile">edit profie </a>
                </li>
                <li>
                    <a href="../views/dashboard.php" class="<?= ($page == 'dashboard') ? 'active' : '' ?>">dashboard</a>
                </li>
                <li>
                    <a href="../views/dataPegawai.php"  class="<?= ($page == 'dataPegawai') ? 'active' : '' ?>">Data Pegawai</a>
                </li>
                <li>
                    <a href="../views/dataBarang.php" class="<?= ($page == 'dataBarang') ? 'active' : '' ?>">Data Barang</a>
                </li>
                <li>
                    <a href="../views/dataDistributor.php" class="<?= ($page == 'dataDistributor') ? 'active' : '' ?>">Data Distributor</a>
                </li>
                <li>
                    <a href="../views/barangMasuk.php" class="<?= ($page == 'barangMasuk') ? 'active' : '' ?>">Barang Masuk</a>
                </li>
                <li>
                    <a href="#">Barang Keluar</a>
                </li>
                <li>
                    <a href="#">Laporan</a>
                </li>
                <li>
                    <a href="../controller/logout.php?action=logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>