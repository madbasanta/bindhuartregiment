<?php include_once base_path('backend/layouts/meta.php') ?>


<?php include_once base_path('backend/layouts/nav.php') ?>

<?php include_once base_path('backend/layouts/sidenav.php') ?>

<style>
    .ql-editor {
        height: 300px;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Blogs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/blogs">Blogs</a></li>
                <li class="breadcrumb-item active">Create New</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php include base_path('backend/common/successErrorAlert.php') ?>

    <section class="section">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create new blog</h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" method="POST" onsubmit="handleCreateBlog(event)">
                            <input type="hidden" name="category_id" id="categoryIdInput">
                            <div class="col-12">
                                <label for="inputTitle" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="<?= old('title') ?>" id="inputTitle">
                                <?php if (isset($_SESSION['post_errors']['title'])) : ?>
                                    <div class="text-danger"><?= $_SESSION['post_errors']['title'] ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-12">
                                <label for="inputContent" class="form-label">Content</label>
                                <textarea name="content" id="blogContent" style="display: none;"></textarea>
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="quill-editor-content"><?= old('content') ?></div>
                                    </div>
                                </div>
                                <?php if (isset($_SESSION['post_errors']['content'])) : ?>
                                    <div class="text-danger"><?= $_SESSION['post_errors']['content'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button> &nbsp;
                                <a href="/admin/blogs/create" onclick="return confirm('Are you sure?')">
                                    <button type="button" class="btn btn-secondary">Reset</button>
                                </a>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating mb-2">
                    <select name="category_id" class="form-select" id="floatingSelectCategory" aria-label="Choose Category">
                        <option value="" selected disabled>-- Choose Category --</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingSelectCategory">Category</label>
                </div>
                <?php if (isset($_SESSION['post_errors']['category_id'])) : ?>
                    <div class="text-danger"><?= $_SESSION['post_errors']['category_id'] ?></div>
                <?php endif; ?>
                <div>or</div>
                <div class="card mt-2">
                    <div class="card-body">
                        <h4 class="my-2">Create a category</h4>
                        <form action="/admin/category/create" method="POST" onsubmit="return false">
                            <div class="form-group mb-2">
                                <label for="inputCat">Name</label>
                                <input type="text" name="name" class="form-control" id="inputCat">
                            </div>
                            <div class="form-group">
                                <label for="inputCatParent">Parent</label>
                                <select name="parent_id" class="form-control" id="inputCat">
                                    <option value="" selected disabled>-- Choose Category --</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mt-3">
                                <button type="button" onclick="createNewCategory(event)" class="btn btn-light">Save</button>
                            </div>
                        </form>
                    </div>
                    </fieldset>
                </div>
            </div>
    </section>
</main>

<?php include_once base_path('backend/layouts/footer.php') ?>
<?php include_once base_path('backend/layouts/scripts_foot.php') ?>

<script>
    var quilEditorContent;
    (function() {
        quilEditorContent = new Quill(".quill-editor-content", {
            modules: {
                toolbar: [
                    [{
                            font: []
                        },
                        {
                            size: []
                        }
                    ],
                    ["bold", "italic", "underline", "strike"],
                    [{
                            color: []
                        },
                        {
                            background: []
                        }
                    ],
                    [{
                            script: "super"
                        },
                        {
                            script: "sub"
                        }
                    ],
                    [{
                            list: "ordered"
                        },
                        {
                            list: "bullet"
                        },
                        {
                            indent: "-1"
                        },
                        {
                            indent: "+1"
                        }
                    ],
                    ["direction", {
                        align: []
                    }],
                    ["link", "image", "video"],
                    ["clean"]
                ]
            },
            theme: "snow"
        });
    })();

    function handleCreateBlog(event) {
        let body = quilEditorContent.root.innerHTML;
        document.getElementById('blogContent').value = body.trim();
        document.getElementById('categoryIdInput').value = document.getElementById('floatingSelectCategory').value;
    }

    function errorHandler(errResponse) {
        for (let key in errResponse) {
            if (errResponse.hasOwnProperty(key)) {
                alert(errResponse[key]);
            }
        }
    }

    function createNewCategory(event) {
        event.preventDefault();
        let form = event.target.closest('form');
        fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            }).then(response => response.json())
            .then(data => {
                if (data && data.errors) {
                    errorHandler(data.errors);
                } else {
                    // success
                    form.reset();
                    location.reload();
                }
            });
    }
</script>