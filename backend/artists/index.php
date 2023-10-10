<?php include_once base_path('backend/layouts/meta.php') ?>


<?php include_once base_path('backend/layouts/nav.php') ?>

<?php include_once base_path('backend/layouts/sidenav.php') ?>

<main id="main" class="main">
    <div class="pagetitle d-flex">
        <div style="flex: 1;">
            <h1 class="">Artists</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                    <li class="breadcrumb-item"><a href="/admin/artists">Artists</a></li>
                    <li class="breadcrumb-item active">List All</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="/admin/artists/create" class="btn btn-primary">Create New</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <table class="table"></table>
    </section>
</main>

<?php include_once base_path('backend/layouts/footer.php') ?>

<?php include_once base_path('backend/layouts/scripts_foot.php') ?>


<script>
    var dataTable = new DataTable(".table", {
        ajax: {
            url: '/admin/artists/get-all',
            type: 'POST'
        },
        columnDefs: [{
            orderable: false,
            targets: 0
        }],
        order: [[6, 'asc']],
        columns: [
            {
                data: 'thumbnail',
                title: 'Image',
                orderable: false,
                render: function(data, type, row, meta) {
                    return `<img src="/uploads/${data}" width="50px" />`;
                }
            },
            {
                data: 'created_at', title: 'Date Created', render(data, type, row, meta) {
                    return moment(data).format('MM/DD/YYYY hh:mm A');
                }
            },
            {
                data: 'name', title: 'Name'
            },
            {
                data: 'shortdesc', title: 'Description', render(data, type, row, meta) {
                    return data.strLimit(45);
                }
            },
            {
                data: 'role', title: 'Role'
            },
            {
                data: 'slug', title: 'Slug'
            },
            {
                data: 'sequence', title: 'Sequence'
            },
            {
                data: 'action', title: 'Action', render(data, type, item, meta) {
                    return `<a href="/admin/artists/edit?id=${item.id}" title="Edit" class="btn btn-icon btn-sm"><i class="bi bi-pencil-square"></i></a>
                <a data-id="${item.id}" href="/admin/artists/delete" title="Delete" class="blog--delete btn btn-icon btn-sm text-danger"><i class="bi bi-trash"></i></a>`;
                }
            }
        ],
        processing: true,
    });

    addEventListenerClass('blog--delete', 'click', function() {
        if (!confirm('Are you sure?')) {
            return;
        }
        const body = new FormData();
        body.append('id', this.getAttribute('data-id'));
        fetch('/admin/artists/delete', {
            method: 'POST',
            body,
        }).then(response => response.json()).then(data => {
            if (data.STATUS === 'SUCCESS') {
                this.closest('tr').remove();
                dataTable.ajax.reload();
            } else {
                alert(data.MESSAGE);
            }
        }).catch(err => {
            console.error(err);
        });
    });
</script>