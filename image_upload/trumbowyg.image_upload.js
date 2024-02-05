(function ($) {
    'use strict';

    // Plugin default options
    var defaultOptions = {
    }

    // If the plugin is a button
    function buildButtonDef(trumbowyg) {
        return {
            fn: function () {
                $('#launchFileUploadModal').trigger('click')

                // upload handler
                $('#fileUploadForm').on('submit', function (e) {
                    e.preventDefault() // Prevent the form from submitting normally

                    var formData = new FormData()
                    var files = $('#ImageFiles')[0].files

                    // Append each file to the FormData object
                    for (var i = 0; i < files.length; i++) {
                        formData.append('image_files[]', files[i])
                    }

                    $('#fileProgress').css('width', 0 + '%').text(0 + '%').removeClass('bg-danger')

                    $.ajax({
                        url: 'upload.php', // PHP script to handle file upload
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        xhr: function () {
                            var xhr = new XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function (e) {
                                if (e.lengthComputable) {
                                    var percent = (e.loaded / e.total) * 100;
                                    $('#fileProgress').css('width', percent + '%').text(percent + '%')
                                }
                            })

                            return xhr
                        },
                        success: function (response) {
                            // Handle success response from server

                            const json_response = JSON.parse(response)
                            const files = json_response.urls ?? []
                            const file_count = files.length
                            let cols = ""

                            files.forEach(file => {
                                if (file_count === 1) {
                                    cols = "<div class='col-12'>" +
                                        `<img src='${file}' alt='${file}' class='img-fluid'>` +
                                        "</div>"
                                }

                                if (file_count === 2) {
                                    cols += "<div class='col-sm-6'>" +
                                        `<img src='${file}' alt='${file}' class='img-fluid'>` +
                                        "</div>"
                                }

                                if (file_count === 3) {
                                    cols += "<div class='col-md-4 col-sm-6'>" +
                                        `<img src='${file}' alt='${file}' class='img-fluid'>` +
                                        "</div>"
                                }

                                if (file_count >= 4) {
                                    cols += "<div class='col-lg-3 col-md-4 col-sm-6'>" +
                                        `<img src='${file}' alt='${file}' class='img-fluid'>` +
                                        "</div>"
                                }
                            })

                            let container = `<section class='container'><div class='row gx-sm-5 gx-0 gy-5'>${cols}</div></section>`

                            $('#ImageInsertButton').on('click', () => {
                                $('#trumbowyg-demo').trumbowyg('html', container)
                            })
                        },
                        error: function (xhr, status, error) {
                            // Handle error response from server
                            $('#fileProgress').css('width', 100 + '%').text("Error uploading files").addClass('bg-danger')
                        }
                    })
                })
            }
        }
    }

    // If the plugin is a button
    function buildButtonIcon() {
        if ($("#trumbowyg-image-upload").length > 0) {
            return
        }

        /*
        When your button is created, an SVG will be inserted with an xref to a
        symbol living at the fragment "#trumbowyg-imageUpload". For Trumbowyg's
        own plugins, this will come from a sprite sheet which is injected into
        the document, built from the icon SVG in "ui/icons" in your plugin's
        source tree. This is how you should organise things if you are
        proposing your plugin to be included in the Trumbowyg main
        distribution, or if you are rolling your own custom build of Trumbowyg
        for your site.

        But, nothing says it *has* to come from Trumbowyg's injected sprite
        sheet; it only requires that this symbol exists in your document. To
        allow stand-alone distribution of your plugin, we're going to insert a
        custom SVG symbol into the document with the correct ID.
        */
        const iconWrap = $(document.createElementNS("http://www.w3.org/2000/svg", "svg"))
        iconWrap.addClass("trumbowyg-icons")

        // For demonstration purposes, we've taken the "File" icon from
        // Remix Icon - https://remixicon.com/
        iconWrap.html(`
            <symbol id="trumbowyg-image-upload" viewBox="0 0 24 24">
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path d="M20 13C18.3221 13 16.7514 13.4592 15.4068 14.2587C16.5908 15.6438 17.5269 17.2471 18.1465 19H20V13ZM16.0037 19C14.0446 14.3021 9.4079 11 4 11V19H16.0037ZM4 9C7.82914 9 11.3232 10.4348 13.9738 12.7961C15.7047 11.6605 17.7752 11 20 11V3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H6V1H8V5H4V9ZM18 1V5H10V3H16V1H18ZM16.5 10C15.6716 10 15 9.32843 15 8.5C15 7.67157 15.6716 7 16.5 7C17.3284 7 18 7.67157 18 8.5C18 9.32843 17.3284 10 16.5 10Z"/>
            </symbol>
        `).appendTo(document.body)
    }


    $.extend(true, $.trumbowyg, {
        // Add some translations
        langs: {
            en: {
                imageUpload: 'Image Upload'
            },
            tr: {
                imageUpload: 'Resim Yükleme'
            },
            ar: {
                imageUpload: ''
            },
            ru: {
                imageUpload: ''
            }
        },
        // Register plugin in Trumbowyg
        plugins: {
            imageUpload: {
                // Code called by Trumbowyg core to register the plugin
                init: function (trumbowyg) {
                    // Fill current Trumbowyg instance with the plugin default options
                    trumbowyg.o.plugins.imageUpload = $.extend(true, {},
                        defaultOptions,
                        trumbowyg.o.plugins.imageUpload || {}
                    )

                    // If the plugin is a button
                    buildButtonIcon()
                    trumbowyg.addBtnDef('imageUpload', buildButtonDef(trumbowyg))
                },
                // Return a list of button names which are active on current element
                tagHandler: function (element, trumbowyg) {
                    return []
                },
                destroy: function (trumbowyg) {
                }
            }
        }
    })
})(jQuery)