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
    fetch("/admin/blogs/get-all", {
        method: "POST"
    }).then(
        response => response.json()
    ).then(
        data => {
            if (!data.length) {
                return
            }
            new window.simpleDatatables.DataTable(".table", {
                data: {
                    headings: ['Date Created', 'Title', 'Content', 'Category', 'Author', 'Action'],
                    data: data.map(item => [
                        new Date(item.created_at).toLocaleDateString(),
                        item.title, item.content.substring(0, 100),
                        item.category ? item.category.name : '',
                        item.user ? item.user.name : '',
                        `<a href="/admin/blogs/edit/${item.id}">Edit</a>`
                    ])
                },
            })
        }
    )
</script>