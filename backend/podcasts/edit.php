<?php include_once base_path('backend/layouts/meta.php') ?>
<?php 
$podcast = ORM::table('podcasts')->find($_GET['id']);
if(empty($podcast)) {
    header('Location: /admin/podcasts');
    exit;
}
?>

<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
<style>
    .dropzone {
        width: 98%;
        margin: 1%;
        border: 2px dashed #3498db !important;
        border-radius: 5px;
        transition: 0.2s;
        min-height: 100px;
    }

    .dropzone.dz-drag-hover {
        border: 2px solid #3498db !important;
    }

    .dz-message.needsclick img {
        width: 50px;
        display: block;
        margin: auto;
        opacity: 0.6;
        margin-bottom: 15px;
    }

    span.plus {
        display: none;
    }

    .dropzone.dz-started .dz-message {
        display: inline-block !important;
        width: 120px;
        float: right;
        border: 1px solid rgba(238, 238, 238, 0.36);
        border-radius: 30px;
        height: 120px;
        margin: 16px;
        transition: 0.2s;
    }

    .dropzone.dz-started .dz-message span.text {
        display: none;
    }

    .dropzone.dz-started .dz-message span.plus {
        display: block;
        font-size: 70px;
        color: #AAA;
        line-height: 110px;
    }
</style>

<?php include_once base_path('backend/layouts/nav.php') ?>

<?php include_once base_path('backend/layouts/sidenav.php') ?>

<style>
    .ql-editor {
        height: 300px;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Podcasts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/podcasts">Podcasts</a></li>
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
                        <h5 class="card-title">Create new podcast</h5>
                        <!-- Vertical Form -->
                        <form method="POST" onsubmit="handleCreateBlog(event)">
                            <div class="row g-3">
                                <input type="hidden" name="category_id" value="<?= $podcast->category_id ?? old('category_id') ?>" id="categoryIdInput">
                                <input type="hidden" name="thumbnail" value="<?= $podcast->thumbnail ?? old('thumbnail') ?>" id="thumbnail">
                                <input type="hidden" name="audio_file_path" value="<?= $podcast->audio_file_path ?? old('audio_file_path')?>" id="audio_file_path">

                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-10 mb-3">
                                            <label for="inputTitle" class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="<?= $podcast->title ?? old('title') ?>" id="inputTitle">
                                            <?php if (isset($_SESSION['post_errors']['title'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['title'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-2 mb-3">
                                            <label for="inputDur" class="form-label">Duration</label>
                                            <input type="text" readonly name="duration" class="form-control" value="<?= $podcast->duration ?? old('duration') ?>" id="inputDur">
                                            <?php if (isset($_SESSION['post_errors']['duration'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['duration'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputContent" class="form-label">Description</label>
                                            <textarea name="description" id="podcastDesc" style="display: none;"><?= $podcast->description ?? old('description') ?></textarea>
                                            <div class="card">
                                                <div class="card-body p-0">
                                                    <div class="quill-editor-description"><?= $podcast->description ?? old('description') ?></div>
                                                </div>
                                            </div>
                                            <?php if (isset($_SESSION['post_errors']['description'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['description'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">

                                    <div class="form-group mb-4">
                                        <label for="inputImage" class="form-label">Audio</label>
                                        <div id="audioDrop">
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
                                            <?php if (isset($_SESSION['post_errors']['audio_file_path'])) : ?>
                                                <div class="text-danger"><?= $_SESSION['post_errors']['audio_file_path'] ?></div>
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
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

<script>
    var quilEditorContent;
    (function() {
        quilEditorContent = new Quill(".quill-editor-description", {
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

        function formatAudioDuration(duration) {
            const hours = Math.floor(duration / 3600);
            const minutes = Math.floor((duration % 3600) / 60);
            const seconds = Math.floor(duration % 60);

            return `${hours}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        function calculateAudioDuration(file) {
            const audio = new Audio();
            audio.src = URL.createObjectURL(file);

            audio.onloadedmetadata = function() {
                const duration = audio.duration; // in seconds
                document.getElementById('inputDur').value = formatAudioDuration(duration);
            };
        }

        new Dropzone('#audioDrop', {
            url: '/admin/file/upload/chunk',
            acceptedFiles: 'audio/*',
            maxFiles: 1,
            maxFilesize: 1024,
            chunking: true,
            forceChunking: true,
            chunkSize: 1024*1024*20, // 20MB
            parallelUploads: 5, // Number of simultaneous uploads
            retryChunks: true,
            retryChunksLimit: 3, // Number of times to retry failed chunks
            uploadprogress(file, progress, bytesSent) {
                if(file.previewElement) {
                    file.previewElement.querySelector('.dz-progress').innerHTML = `
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: ${progress}%">
                            </div>
                        </div>
                    `
                }
            },
            success(file, response) {
                calculateAudioDuration(file);
                document.getElementById('audio_file_path').value = response.file;
                if(file.previewElement) {
                    file.previewElement.querySelectorAll('.dz-progress,.dz-error-message,.dz-error-mark').forEach(item => {
                        item.style.display = 'none';
                    });
                    file.previewElement.querySelector('.dz-success-mark').innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
                }
            },
        });
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
        let body = quilEditorContent.root.innerHTML;
        document.getElementById('podcastDesc').value = body.trim();
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

<?php unset($_SESSION['post_errors']) ?>