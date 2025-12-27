const sidebar = document.getElementById('sidebar')

function toggleSidebar() {
    sidebar.classList.toggle('show')
}

function toggleClose() {
    sidebar.classList.remove('show')
}




let barangMasuk = [];
    
function tambahBarang() {   
    let distributorSelect = document.getElementById('distributor');
    let barangSelect = document.getElementById('barang');

    let idDistributor = distributorSelect.value;
    let namaDistiributor = distributorSelect.options[distributorSelect.selectedIndex].text;

    let idBarang = barangSelect.value;
    let namaBarang = barangSelect.options[barangSelect.selectedIndex].text;

    let harga = document.getElementById('harga').value;
    let qty = document.getElementById('qty').value;

    if(!idDistributor || !idBarang || !harga || !qty) {
        alert('Lengkapi semua data!');
        return;
    }
    const total = harga * qty;
    barangMasuk.push({
        idDistributor,
        namaDistiributor,
        idBarang,
        namaBarang,
        harga,
        qty,
        total
    });
    
    console.log(barangMasuk);
    renderTable();
    hitungTotal();  
}

function renderTable() {
    let tbody = document.getElementById('tableBarang');
    tbody.innerHTML = '';
    barangMasuk.forEach((item, index) => {
        tbody.innerHTML += `
        <tr>
            <td>${index + 1}</td>
            <td>${item.namaDistiributor}</td>
            <td>${item.namaBarang}</td>
            <td>${item.qty}</td>
            <td>${item.total}</td>
        </tr>
        `;
    });
}

function hitungTotal() {
    let totalQTY = 0;
    let totalHarga = 0;
    barangMasuk.forEach(item => {
        totalQTY += parseInt(item.qty);
        totalHarga += parseInt(item.total);
    });
    document.getElementById('totalQTY').innerText = totalQTY;
    document.getElementById('totalHarga').innerText = totalHarga;
}

function simpanBarangMasuk() {
    if(barangMasuk.length === 0) {
        alert('Tidak ada data barang masuk!');
        return;
    }

    fetch('simpanBarangMasuk.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(barangMasuk)
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Data barang masuk berhasil disimpan!');
            barangMasuk = [];
            renderTable();
            hitungTotal();
        } else {
            alert('Gagal menyimpan data barang masuk!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data barang masuk!');
    });
}