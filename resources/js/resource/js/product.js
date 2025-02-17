
document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-product-get"]');
    let requestUrlProduct = metaTag ? metaTag.content : null;

    if (!requestUrlProduct) {
        console.error("Meta tag route-product-get tidak ditemukan.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let productTable = document.getElementById("ProductTable");
    if (!productTable) {
        console.error("Table #ProductTable tidak ditemukan di halaman ini.");
        return;
    }

    $("#ProductTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlProduct,
            type: "GET",
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name_product", name: "name_product" },
            { data: "name_category", name: "id_category" },
            { data: "description_product", name: "description_product" },
            { data: "action", name: "action", orderable: false, searchable: true },
        ],
        responsive: true,
        autoWidth: false,
        language: {
            processing: "Loading Data...",
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries to show",
            infoFiltered: "(filtered from _MAX_ total entries)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous",
            },
            zeroRecords: "No matching records found",
        },
    });
});

window.confirmDelete = function (productid) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            let form = document.getElementById("delete-form-product-" + productid);
            if (form) {
                form.submit();
            } else {
                console.error(`Form dengan ID delete-form-product-${productid} tidak ditemukan.`);
            }
        }
    });
};

