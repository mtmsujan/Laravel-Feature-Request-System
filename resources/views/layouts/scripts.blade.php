<div id="notify" hx-swap-oob="true">
    <x-notify::notify />
    @notifyJs
</div>
@jQuery
<script src="{{ asset('assets/js/htmx.min.js') }}"></script>

<div id="counter-script"></div>
<script>
    $(document).on('htmx:beforeSend',function () {
        let hxIndicatorOpposition = $('.htmx-indicator-opposition')
        hxIndicatorOpposition.each((i, el)=>{
            $(el).hide()
        })
    });
</script>

<div id="editor" hx-swap-oob="true">
    <script src="{{ asset('vendor/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.editor').each((i, el) => {
                let editor = new FroalaEditor('#' + el.id, {
                    // Set the image upload parameter.
                    imageUploadParam: 'image',

                    // Set the image upload URL.
                    imageUploadURL: '/upload-editor-images',

                    // Additional upload params.
                    imageUploadParams: {
                        '_token': '{{ csrf_token() }}'
                    },

                    // Set request type.
                    imageUploadMethod: 'POST',

                    // Set max image size to 5MB.
                    imageMaxSize: 5 * 1024 * 1024,

                    // Allow to upload PNG and JPG.
                    imageAllowedTypes: ['jpeg', 'jpg', 'png', 'svg', 'webp'],

                    events: {
                        'image.beforeUpload': function(images) {
                            // Return false if you want to stop the image upload.
                        },
                        'image.uploaded': function(response) {
                            // Image was uploaded to the server.
                        },
                        'image.inserted': function($img, response) {
                            // Image was inserted in the editor.
                        },
                        'image.replaced': function($img, response) {
                            // Image was replaced in the editor.
                        },
                        'image.error': function(error, response) {
                            // Bad link.
                            if (error.code == 1) {
                                console.log(error)
                            }

                            // No link in upload response.
                            else if (error.code == 2) {
                                console.log(error)
                            }

                            // Error during image upload.
                            else if (error.code == 3) {
                                console.log(error)
                            }

                            // Parsing response failed.
                            else if (error.code == 4) {
                                console.log(error)
                            }

                            // Image too text-large.
                            else if (error.code == 5) {
                                console.log(error)
                            }

                            // Invalid image type.
                            else if (error.code == 6) {
                                console.log(error)
                            }

                            // Image can be uploaded only to same domain in IE 8 and IE 9.
                            else if (error.code == 7) {
                                console.log(error)
                            }

                            // Response contains the original server response to the request if available.
                        }
                    }
                })
            })
        });
    </script>
</div>

@stack('scripts')
@bukScripts(true)