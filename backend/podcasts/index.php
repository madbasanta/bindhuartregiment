<?php include_once base_path('backend/layouts/meta.php') ?>


<?php include_once base_path('backend/layouts/nav.php') ?>

<?php include_once base_path('backend/layouts/sidenav.php') ?>

<main id="main" class="main">
    <div class="pagetitle d-flex">
        <div style="flex: 1;">
            <h1 class="">Podcasts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                    <li class="breadcrumb-item"><a href="/admin/podcasts">Podcasts</a></li>
                    <li class="breadcrumb-item active">List All</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="/admin/podcasts/create" class="btn btn-primary">Create New</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <table class="table"></table>
    </section>
</main>

<?php include_once base_path('backend/layouts/footer.php') ?>

<?php include_once base_path('backend/layouts/scripts_foot.php') ?>

<script>
    var dataTable = new window.simpleDatatables.DataTable(".table", {
        columns: [{
            select: 1,
            type: 'date',
            sort: 'desc'
        }, {
            select: 0,
            sortable: false
        }, {
            select: 6,
            sortable: false
        }, {
            select: [2, 3],
            type: 'string',
            render(value) {
                return `<p title="${value}">${value.strLimit(45)}</p>`;
            }
        }],
        data: {
            headings: ['Image','Date Created', 'Title', 'Description', 'Duration', 'Author', 'Action'],
            data: []
        },
    });

    fetch("/admin/podcasts/get-all", {
        method: "POST"
    }).then(
        response => response.json()
    ).then(
        data => {
            let newRows = data.map(item => dataTable.rows.add([
                `<img src="/uploads/${ item.thumbnail }" width="50px" />`,
                moment(item.created_at).format('MM/DD/YYYY hh:mm A'),
                item.title, item.description, item.duration,
                item.user ? item.user.name : '',
                `<a href="/admin/podcasts/edit?id=${item.id}" title="Edit" class="btn btn-icon btn-sm"><i class="bi bi-pencil-square"></i></a>
                <a data-id="${item.id}" href="/admin/podcasts/delete" title="Delete" class="blog--delete btn btn-icon btn-sm text-danger"><i class="bi bi-trash"></i></a>`
            ]));
        }
    );

    addEventListenerClass('blog--delete', 'click', function() {
        if (!confirm('Are you sure?')) {
            return;
        }
        const body = new FormData();
        body.append('id', this.getAttribute('data-id'));
        fetch('/admin/podcasts/delete', {
            method: 'POST',
            body,
        }).then(response => response.json()).then(data => {
            if (data.STATUS === 'SUCCESS') {
                this.closest('tr').remove();
                dataTable.refresh();
            } else {
                alert(data.MESSAGE);
            }
        }).catch(err => {
            console.error(err);
        });
    });
</script>