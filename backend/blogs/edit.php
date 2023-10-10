<?php include_once base_path('backend/layouts/meta.php') ?>

<?php
$blog = ORM::table('blog_posts')->find($_GET['id']);
if(empty($blog)) {
    header('Location: /admin/blogs');
    exit;
}
$categories = ORM::table('categories')->get();
?>

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
                            <input type="hidden" name="category_id" id="categoryIdInput" value="<?= $blog->category_id?>">
                            <input type="hidden" name="thumbnail" id="thumbnail" value="<?= $blog->thumbnail?>">

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group mb-3">
                                        <label for="inputTitle" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" value="<?= $blog->title ?>" id="inputTitle">
                                        <?php if (isset($_SESSION['post_errors']['title'])) : ?>
                                            <div class="text-danger"><?= $_SESSION['post_errors']['title'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputShortdesc" class="form-label">Short Description</label>
                                        <textarea rows="2" name="shortdesc" class="form-control" id="inputShortdesc"><?= $blog->shortdesc ?></textarea>
                                        <?php if (isset($_SESSION['post_errors']['shortdesc'])) : ?>
                                            <div class="text-danger"><?= $_SESSION['post_errors']['shortdesc'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputContent" class="form-label">Content</label>
                                        <textarea name="content" id="blogContent"><?= $blog->content ?></textarea>
                                        
                                        <?php if (isset($_SESSION['post_errors']['content'])) : ?>
                                            <div class="text-danger"><?= $_SESSION['post_errors']['content'] ?></div>
                                        <?php endif; ?>
                                    </div>
        
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button> &nbsp;
                                        <a href="/admin/blogs/create" onclick="return confirm('Are you sure?')">
                                            <button type="button" class="btn btn-secondary">Reset</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Author</label>
                                        <input type="text" name="author" class="form-control" value="<?= $blog->author ?>">
                                        <?php if (isset($_SESSION['post_errors']['author'])) : ?>
                                            <div class="text-danger"><?= $_SESSION['post_errors']['author'] ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputImage" class="form-label">Thumbnail</label>
                                        <div id="thumbDrop">
                                            <div class="dropzone needsclick d-flex" id="demo-upload">
                                                <div class="dz-message needsclick m-auto">
                                                    <span class="text">
                                                        <i class="bi bi-cloud-upload"></i>
                                                        Drop files here or click to upload.
                                                    </span>
                                                </div>
                                            </div>
                                            <?php if (isset($_SESSION['post_errors']['audio_file_path'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['audio_file_path'] ?></div>
                                            <?php endif; ?>

                                            <div class="dz-preview dz-processing dz-complete dz-image-preview">
                                                <div class="dz-image">
                                                    <img width="100" class="img-fluid" src="/uploads/<?= $blog->thumbnail ?>" data-dz-thumbnail alt="">
                                                    <br>
                                                    <a href="/uploads/<?= $blog->thumbnail ?>">/uploads/<?= $blog->thumbnail ?></a> 
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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
                            <option 
                                value="<?= $category->id ?>" 
                                <?= $category->id == $blog->category_id ? 'selected' : ''?> 
                                > 
                                <?= $category->name ?>
                            </option>
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
        initTinymce('#blogContent')

        new Dropzone('#thumbDrop', {
            url: '/admin/file/upload',
            acceptedFiles: 'image/*',
            maxFiles: 1,
            success(file, response) {
                document.getElementById('thumbnail').value = response.file
                if(file.previewElement) {
                    file.previewElement.querySelectorAll('.dz-progress,.dz-error-message,.dz-error-mark').forEach(item => {
                        item.style.display = 'none';
                    });
                    file.previewElement.querySelector('.dz-success-mark').innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
                }
            }
        });
    })();

    function handleCreateBlog(event) {
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