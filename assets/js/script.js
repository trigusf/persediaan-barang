const sidebar = document.getElementById('sidebar')

function toggleSidebar() {
    sidebar.classList.toggle('show')
}

function toggleClose() {
    sidebar.classList.remove('show')
}




let barangMasuk = [];
    
function tambahBarang() {   
    let idDistributor = document.getElementById('distributor').value;
    let idBarang = document.getElementById('barang').value;
    let harga = document.getElementById('harga').value;
    let qty = document.getElementById('qty').value;
    if(!idDistributor || !idBarang || !harga || !qty) {
        alert('Lengkapi semua data!');
        return;
    }
    const total = harga * qty;
    barangMasuk.push({
        idDistributor,
        idBarang,
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
        tbody.innerHTML = `
        <tr>
            <td>${index + 1}</td>
            <td>${item.idDistributor}</td>
            <td>${item.idBarang}</td>
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