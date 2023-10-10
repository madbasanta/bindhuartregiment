<?php include_once base_path('backend/layouts/meta.php') ?>


<?php include_once base_path('backend/layouts/nav.php') ?>

<?php include_once base_path('backend/layouts/sidenav.php') ?>

<main id="main" class="main">
    <div class="pagetitle d-flex">
        <div style="flex: 1;">
            <h1 class="">Blogs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                    <li class="breadcrumb-item"><a href="/admin/blogs">Blogs</a></li>
                    <li class="breadcrumb-item active">List All</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="/admin/blogs/create" class="btn btn-primary">Create New</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <table class="table"></table>
    </section>
</main>

<?php include_once base_path('backend/layouts/footer.php') ?>

<?php include_once base_path('backend/layouts/scripts_foot.php') ?>

<script>
    const table = new window.DataTable(".table", {
      columns: [
        { title: 'Image', orderable: false },
        { title: 'Date Created', orderable: true },
        { title: 'Title', orderable: true },
        { title: 'Content', orderable: true },
        { title: 'Author', orderable: true },
        { title: 'Category', orderable: true },
        { title: 'Action', orderable: false }
      ],
      ajax: {
        url: "/admin/blogs/get-all",
        method: "POST",
        dataSrc: function(data) {
          return data.map(function(item) {
            return [
              renderImage(item.thumbnail),
              moment(item.created_at).format('MM/DD/YYYY hh:mm A'),
              item.title,
              item.shortdesc?.strLimit(45) || '',
              item.author,
              item.category ? item.category.name : '',
              renderActions(item.id)
            ];
          });
        }
      },
      order: [[1, 'desc']] // Sort by the second column (Date Created) in descending order
    });
    
    function renderImage(thumbnail) {
      return `<img src="/uploads/${thumbnail}" width="50px" />`;
    }
    
    function renderActions(id) {
      return `
        <a href="/admin/blogs/edit?id=${id}" title="Edit" class="btn btn-icon btn-sm"><i class="bi bi-pencil-square"></i></a>
        <a data-id="${id}" href="/admin/blogs/delete" title="Delete" class="blog--delete btn btn-icon btn-sm text-danger"><i class="bi bi-trash"></i></a>
      `;
    }

    addEventListenerClass('blog--delete', 'click', function() {
        if (!confirm('Are you sure?')) {
            return;
        }
        const body = new FormData();
        body.append('id', this.getAttribute('data-id'));
        fetch('/admin/blogs/delete', {
            method: 'POST',
            body,
        }).then(response => response.json()).then(data => {
            if (data.STATUS === 'SUCCESS') {
                this.closest('tr').remove();
                table.ajax.reload();
            } else {
                alert(data.MESSAGE);
            }
        }).catch(err => {
            console.error(err);
        });
    });
</script>