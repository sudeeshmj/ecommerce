$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // // Function to show the loader
    // function showLoader() {
    //     document.getElementById('loader').style.display = 'flex';
    // }

    // // Show loader on page unload (when navigating away)
    // window.addEventListener('beforeunload', function() {
    //     showLoader();
    // });

    // Global DataTable configuration
    $.extend(true, $.fn.dataTable.defaults, {
        processing: true,
        serverSide: true,
    });

    function initDataTable(selector, columns, columnstyle, addButton = null) {
        $(selector).DataTable({
            ajax: $(selector).data("route"),
            columns: columns,
            columnDefs: columnstyle,
            language: {
                lengthMenu: "_MENU_ entries",
                search: "",
            },
            initComplete: function () {
                const filterContainer = $(this.api().table().container()).find(
                    ".dataTables_filter"
                );

                // Add a placeholder to the search input
                filterContainer.find("input").attr("placeholder", "Search...");

                if (addButton) {
                    filterContainer.append(addButton);
                }
            },
            // language: {
            //     url: `/lang/datatables/es.json`, // Dynamically set based on locale
            // },
        });
    }

    function renderStatus(data) {
        var statusClass =
            data === "Active"
                ? "badge badge-light-success"
                : "badge badge-light-danger";
        // return '<span> <span class="'+statusClass+'">●</span>' + data + '</span>';
        return '<span class="' + statusClass + '">' + data + "</span>";
    }

    function renderOrderStatus(data) {
        var statusClass = "";

        switch (data) {
            case "Confirmed":
                statusClass = "badge badge-light-confirm";
                break;
            case "Shipped":
                statusClass = "badge badge-light-warning";
                break;
            case "Out For Delivery":
                statusClass = "badge badge-light-primary";
                break;
            case "Delivered":
                statusClass = "badge badge-light-success";
                break;
            case "Cancelled":
                statusClass = "badge badge-light-danger";
                break;
            case "Return":
                statusClass = "badge badge-light-return";
                break;
            case "Ready to Pickup":
                statusClass = "badge badge-light-info";
                break;
            case "Refund":
                statusClass = "badge badge-light-refund";
                break;
        }
        return '<span class="' + statusClass + '">' + data + "</span>";
    }

    function renderAmount(data) {
        return "<span >₹" + data + "</span>";
    }

    function renderStockStatus(data) {
        var statusClass =
            data === "In stock"
                ? "badge badge-light-success"
                : "badge badge-light-danger";
        // return '<span> <span class="'+statusClass+'">●</span>' + data + '</span>';
        return '<div class="' + statusClass + '">' + data + "</div>";
    }
    function renderPaymentStatus(data) {
        var statusClass = data === "Paid" ? " text-success" : "text-danger";
        return '<span class="' + statusClass + '">●' + data + "</span>";
        //return '<div class="' + statusClass + '">' + data + "</div>";
    }

    // Category table
    initDataTable(
        "#categories-data-table",
        [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            }, // Serial number column
            { data: "category_name", name: "category_name" },
            { data: "status_text", name: "status", render: renderStatus },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        [
            { width: "10%", targets: 0 },
            { width: "50%", targets: 1 },
            { width: "20%", targets: 2 },
            { width: "20%", targets: 3 },
        ],
        //passing add button
        `<button class='btn btn-sm add_new_btn btn-success ml-3' data-toggle='modal' data-target='#categoryModal'>
        <i class='fa fa-plus mr-2'></i>Add New
        </button>`
    );

    // Sub Category table
    initDataTable(
        "#sub-categories-data-table",
        [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "category.category_name", name: "category.category_name" },
            { data: "subcategory_name", name: "subcategory_name" },
            { data: "status_text", name: "status", render: renderStatus },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        [
            { width: "6%", targets: 0 },
            { width: "30%", targets: 1 },
            { width: "30%", targets: 2 },
            { width: "14%", targets: 3 },
            { width: "13%", targets: 4 },
        ],
        `<button
            class="btn btn-sm add_new_btn btn-success ml-3"
            data-toggle="modal"
            data-target="#subCategoryAddModal"
        >
            <i class="fa fa-plus mr-3"></i>Add New
        </button>`
    );

    // Language table
    initDataTable(
        "#language-data-table",
        [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "language_name", name: "language_name" },
            { data: "status_text", name: "status", render: renderStatus },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        [
            { width: "6%", targets: 0 },
            { width: "30%", targets: 1 },
            { width: "14%", targets: 2 },
            { width: "13%", targets: 3 },
        ]
    );

    // Author table
    initDataTable(
        "#authors-data-table",
        [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "image",
                name: "image",
                orderable: false,
                searchable: false,
            },
            { data: "name", name: "name" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        [
            { width: "5%", targets: 0 },
            { width: "15%", targets: 1 },
            { width: "40%", targets: 2 },
            { width: "20%", targets: 3 },
        ],
        `<a href="#"   id="author-add-btn" class="btn btn-sm add_new_btn btn-success  ml-3" >
        <i class="fa fa-plus mr-2"></i>Add New</a>`
    );

    // Books table
    initDataTable(
        "#books-data-table",
        [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "title", name: "title" },
            { data: "author.name", name: "author.name" },
            { data: "language.language_name", name: "language.language_name" },
            { data: "offer_price", name: "offer_price" },
            { data: "stock_text", name: "stock", render: renderStockStatus },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        [
            { width: "5%", targets: 0 },
            { width: "36%", targets: 1 },
            { width: "14%", targets: 2 },
            { width: "10%", targets: 3 },
            { width: "10%", targets: 4 },
            { width: "10%", targets: 5 },
            { width: "10%", targets: 6 },
        ],
        //passing add button
        `<a href="#"   id="book-add-btn" class="btn btn-sm add_new_btn btn-success  ml-3" >
        <i class="fa fa-plus mr-2"></i>Add New</a>`
    );

    //Customers table
    initDataTable(
        "#customers-data-table",
        [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "customer", name: "customer_name" },
            { data: "phone_number", name: "phone_number" },
            { data: "email", name: "email" },
            { data: "phone_number", name: "phone_number" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        [
            { width: "6%", targets: 0 },
            { width: "30%", targets: 1 },
            { width: "30%", targets: 2 },
            { width: "14%", targets: 3 },
            { width: "13%", targets: 4 },
            { width: "13%", targets: 5 },
        ]
    );

    //Orders table
    initDataTable(
        "#orders-data-table",
        [
            { data: "id", name: "id" },
            { data: "order_date", name: "created_at" },
            { data: "customer", name: "customer.customer_name" },
            {
                data: "order_amount",
                name: "order_amount",
                render: renderAmount,
            },
            {
                data: "payment_status_text",
                name: "payment_status",
                render: renderPaymentStatus,
            },
            {
                data: "order_status.status",
                name: "order_status",
                render: renderOrderStatus,
            },
        ],
        [
            { width: "10%", targets: 0 },
            { width: "20%", targets: 1 },
            { width: "30%", targets: 2 },
            { width: "10%", targets: 3 },
            { width: "15%", targets: 4 },
            { width: "15%", targets: 5 },
        ],
        `<span>
            <input type=date>
            <input type=date>
        </span>`
    );

    $(document).on("click", "#book-add-btn", function (e) {
        e.preventDefault(); // Prevent the default action

        var addBookRoute = $("#book-add-view-url").data("route");
        window.location.href = addBookRoute;
    });
    $(document).on("click", "#author-add-btn", function (e) {
        e.preventDefault(); // Prevent the default action

        var route = $("#author-add-view-url").data("route");
        window.location.href = route;
    });

    $(document).on("click", "#category-edit-btn", function () {
        var categoryId = $(this).data("id");
        var url = $(this).data("url");

        if (categoryId) {
            var editUrl = url; //'{{ route('categories.edit',":id") }}';
            editUrl = editUrl.replace(":id", categoryId);

            $.ajax({
                url: editUrl,
                type: "GET",
                success: function (response) {
                    $("#category_id").val(response.id);
                    $("#category_edt_name").val(response.category_name);
                    $("#category_status").val(response.status);
                    $("#category_update_form").attr(
                        "action",
                        "/books/categories/" + response.id
                    );
                    //  $("#categoryUpdateModal").modal('show');
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        }
    });

    //Delete action start
    $(document).on("click", ".delete-icon-btn", function () {
        const url = $(this).data("url");
        const itemName = $(this).data("text");
        const dataTableId = $(this).data("table");
        $("#deleteForm").attr("action", url);
        $("#data-text").text(itemName);
        $("#data-table").val(dataTableId);
    });

    $("#deleteForm").submit(function (e) {
        e.preventDefault();
        const routeUrl = $(this).attr("action");
        const dataTable = $("#data-table").val();

        console.log(routeUrl);
        $.ajax({
            type: "DELETE",
            url: routeUrl,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $("#DeleteModal").modal("hide");
                    toastr.success(response.message);
                    $("#" + dataTable)
                        .DataTable()
                        .ajax.reload();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (err) {
                console.error("Error:", err);
            },
        });
    });
    //Delete action ends

    $(".modal").on("hidden.bs.modal", function () {
        $(".invalid-feedback").remove();
        $(".is-invalid").removeClass("is-invalid");
        $(this).find("form").trigger("reset");
    });

    $("#subCategoryAddForm").submit(function (e) {
        e.preventDefault();
        const subCategoryData = new FormData(this);
        const routeUrl = $(this).data("url");

        $.ajax({
            type: "POST",
            url: routeUrl,
            data: subCategoryData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status === 400) {
                    $(".invalid-feedback").remove();
                    $(".is-invalid").removeClass("is-invalid");

                    $.each(response.error, function (field, message) {
                        var fieldId = "#" + field;
                        const newDiv = $(
                            '<div class="invalid-feedback">' +
                                message +
                                "</div>"
                        );
                        $(fieldId).addClass("is-invalid");
                        $(fieldId).after(newDiv);
                    });
                } else {
                    $(".invalid-feedback").remove();
                    $(".is-invalid").removeClass("is-invalid");
                    $("#subCategoryAddModal").modal("hide");
                    toastr.success(response.message);
                    $("#sub-categories-data-table").DataTable().ajax.reload();
                }
            },
            error: function (err) {
                console.log(err);
            },
        });
    });

    $(document).on("click", "#subcategory-edit-btn", function () {
        var subCategoryId = $(this).data("id");
        var url = $(this).data("url");

        if (subCategoryId) {
            var editUrl = url; //'{{ route('categories.edit',":id") }}';
            editUrl = editUrl.replace(":id", subCategoryId);

            $.ajax({
                url: editUrl,
                type: "GET",
                success: function (response) {
                    $("#category_edt_id").val(response.category_id);
                    $("#sub_category_id").val(response.id);
                    $("#sub_category_edt_name").val(response.subcategory_name);
                    $("#sub_category_edt_status").val(response.status);

                    $("#subCategoryUpdateForm").attr(
                        "action",
                        "/books/sub-categories/" + response.id
                    );
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        }
    });

    $(document).on("click", "#subcategory-delete-btn", function () {
        var SubCategoryId = $(this).data("id");
        if (SubCategoryId) {
            var form = $("#deleteForm");
            form.attr("action", "/books/sub-categories/" + SubCategoryId);
        }
    });

    $("#languageSubmitForm").submit(function (e) {
        e.preventDefault();
        const languageData = new FormData(this);
        const routeUrl = $(this).data("url");

        $.ajax({
            type: "POST",
            url: routeUrl,
            data: languageData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status === 400) {
                    $(".invalid-feedback").remove();
                    $(".is-invalid").removeClass("is-invalid");

                    $.each(response.error, function (field, message) {
                        var fieldId = "#" + field;
                        const newDiv = $(
                            '<div class="invalid-feedback">' +
                                message +
                                "</div>"
                        );
                        $(fieldId).addClass("is-invalid");
                        $(fieldId).after(newDiv);
                    });
                } else {
                    $(".invalid-feedback").remove();
                    $(".is-invalid").removeClass("is-invalid");
                    toastr.success(response.message);
                    $("#language_name").val("");
                    $("#language_status").val(1);
                    $("#language-data-table").DataTable().ajax.reload();
                }
            },
            error: function (err) {
                console.log(err);
            },
        });
    });

    $(document).on("click", "#language_edit_btn", function () {
        var language = $(this).data("content");
        console.log(language);
        $("#language_name").val(language.language_name);
        $("#language_status").val(language.status);
        $("#language_id").val(language.id);
        $(".language_form_title").html("Update Language");
        $("#btn_language_form").html("Update");
    });

    $(document).on("click", "#language-delete-btn", function () {
        var languageId = $(this).data("id");

        if (languageId) {
            var form = $("#deleteForm");
            form.attr("action", "/books/languages/" + languageId);
        }
    });

    $(document).on("click", "#author-delete-btn", function () {
        var authorId = $(this).data("id");

        if (authorId) {
            var form = $("#deleteForm");
            form.attr("action", "/books/authors/" + authorId);
        }
    });
});
