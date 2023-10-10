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
        <h1>Artists</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/artists">Artists</a></li>
                <li class="breadcrumb-item active">Create New</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php include base_path('backend/common/successErrorAlert.php') ?>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create new artist</h5>
                        <!-- Vertical Form -->
                        <form method="POST" onsubmit="handleCreateBlog(event)">
                            <div class="row g-3">
                                <input type="hidden" name="thumbnail" id="thumbnail" value="<?= old('thumbnail') ?>">

                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-8 mb-3">
                                            <label for="inputName" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" 
                                                value="<?= old('name') ?>" id="inputName" onchange="generateSlug(this.value)">
                                            <?php if (isset($_SESSION['post_errors']['name'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['name'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <label for="inputDur" class="form-label">Role</label>
                                            <input type="text" name="role" class="form-control" value="<?= old('role') ?>" id="inputDur">
                                            <?php if (isset($_SESSION['post_errors']['role'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['role'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-8 mb-3">
                                            <label for="inputShortdesc" class="form-label">Short Description</label>
                                            <textarea rows="2" name="shortdesc" class="form-control" id="inputShortdesc"><?= old('shortdesc') ?></textarea>
                                            <?php if (isset($_SESSION['post_errors']['shortdesc'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['shortdesc'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <label for="inputSeq" class="form-label">Sequence</label>
                                            <input type="text" name="sequence" class="form-control" value="<?= old('sequence') ?>" id="inputSeq">
                                            <?php if (isset($_SESSION['post_errors']['sequence'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['sequence'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputContent" class="form-label">Description</label>
                                            <textarea name="description" class="form-control" id="artistDesc"><?= old('description') ?></textarea>
                                            <?php if (isset($_SESSION['post_errors']['description'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['description'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-4">

                                    <div class="form-group mb-3">
                                        <label for="inputSlug" class="form-label">Slug</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend3">
                                                    https://domain/artist/
                                                </span>
                                            </div>
                                            <input id="inputSlug" type="text" name="slug" class="form-control" value="<?= old('slug') ?>">
                                        </div>
                                        <?php if (isset($_SESSION['post_errors']['slug'])) : ?>
                                            <div class="text-danger"><?= $_SESSION['post_errors']['slug'] ?></div>
                                        <?php endif; ?>
                                    </div>


                                    <div class="form-group">
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
                                            <?php if (isset($_SESSION['post_errors']['thumbnail'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['thumbnail'] ?></div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button> &nbsp;
                                    <a href="/admin/podcasts/create" onclick="return confirm('Are you sure?')">
                                        <button type="button" class="btn btn-secondary">Reset</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </form><!-- Vertical Form -->
    </section>
</main>

<?php include_once base_path('backend/layouts/footer.php') ?>
<?php include_once base_path('backend/layouts/scripts_foot.php') ?>

<script>
    var quilEditorContent;
    (function() {
        initTinymce('#artistDesc');

        new Dropzone('#thumbDrop', {
            url: '/admin/file/upload',
            acceptedFiles: 'image/*',
            maxFiles: 1,
            success(file, response) {
                document.getElementById('thumbnail').value = response.file
                if (file.previewElement) {
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

    function generateSlug(inputString, separator = '-') {
        // Remove special characters, convert to lowercase, and replace spaces with the separator
        const slug = inputString
            .toLowerCase()
            .replace(/[^\w\s-]/g, '') // Remove special characters except spaces and hyphens
            .replace(/\s+/g, separator); // Replace spaces with the separator

        document.getElementById('inputSlug').value = slug;
    }
</script>

<?php unset($_SESSION['post_errors']) ?>