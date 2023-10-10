function initTinymce(selector, options = {}) {
    tinymce.init({
        selector,
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link codesample | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        content_css: '/assets/vendor/tinymce/skins/ui/codepen.min.css',
        link_list: [
            { title: 'My page 1', value: 'http://www.tinymce.com' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_list: [
            { title: 'My page 1', value: 'http://www.tinymce.com' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_class_list: [
            { title: 'None', value: '' },
            { title: 'ImgFluid', value: 'img-fluid' }
        ],
        importcss_append: true,
        file_picker_callback: function (callback, value, meta) {
            // For example, you can trigger a file input element to open the file dialog:
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.style.display = 'none';

            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                // fileInput
            }
            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                fileInput.accept = 'image/*';
            }
            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                fileInput.accept = 'video/*;audio/*';
            }

            document.body.appendChild(fileInput);

            fileInput.addEventListener('change', (event) => {
                const selectedFile = event.target.files[0];
                if (selectedFile) {
                    // modify the name
                    let name = generateUUID() + '.' + selectedFile.name.split('.').pop();
                    uploadFileToServer(new File([selectedFile], name, {type: selectedFile.type}), function(data) {
                        callback('/uploads/'+ data.file, {
                            alt: selectedFile.file,
                            width: '400px', height: 'auto'
                        });
                    });
                }
                document.body.removeChild(fileInput); // Remove the file input element
            });

            fileInput.click(); // Trigger the file input click event to open the dialog
        },
        height: 520,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: "mceNonEditable",
        toolbar_mode: 'sliding',
        contextmenu: "link image imagetools table",
        ...options
    });
}


function uploadFileToServer(file, callback) {
    const formData = new FormData();
    formData.append('file', file);
    fetch('/admin/file/upload', {
        method: 'POST',
        body: formData
    }).then(resp => resp.json()).then(data => {
        callback(data);
    });
}

function generateUUID() {
    const crypto = window.crypto || window.msCrypto; // Check for browser support
    if (crypto) {
        const buffer = new Uint8Array(16);
        crypto.getRandomValues(buffer);
        buffer[6] = (buffer[6] & 0x0f) | 0x40;
        buffer[8] = (buffer[8] & 0x3f) | 0x80;
        return Array.from(buffer).map(byte => byte.toString(16).padStart(2, '0')).join('');
    } else {
        // Fallback for browsers without crypto support (less secure)
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            const r = Math.random() * 16 | 0;
            const v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }
}