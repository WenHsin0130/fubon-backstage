window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Chinese.json"
            }
        });
    }
    
});
