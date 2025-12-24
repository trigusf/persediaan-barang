const sidebar = document.getElementById('sidebar')

function toggleSidebar() {
    sidebar.classList.toggle('show')
}

function toggleClose() {
    sidebar.classList.remove('show')
}