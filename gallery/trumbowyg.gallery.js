(function ($) {
    'use strict';

    // Plugin default options
    let defaultOptions = {
    }

    // If the plugin is a button
    function buildButtonDef(trumbowyg) {
        return {
            fn: function () {
                // Plugin button logic

                // creating modal for adding images
                $("#trumbowyg-demo").trumbowyg('openModalInsert', {
                    title: 'Resim Ekle',
                    fields: {
                        url1: {
                            label: '1. Resim URL',
                            name: 'url1',
                            value: null,
                            type: 'text'
                        },
                        url2: {
                            label: '2. Resim URL',
                            name: 'url2',
                            value: null,
                            type: 'text'
                        },
                        url3: {
                            label: '3. Resim URL',
                            name: 'url3',
                            value: null,
                            type: 'text'
                        },
                        url4: {
                            label: '4. Resim URL',
                            name: 'url4',
                            value: null,
                            type: 'text'
                        },
                    },
                    callback: function (values) {
                        // fetching values given from client
                        let imageUrl1 = values['url1']
                        let imageUrl2 = values['url2']
                        let imageUrl3 = values['url3']
                        let imageUrl4 = values['url4']

                        // html is being created
                        let container = '<div class="container">'+
                            '<div class="row gx-sm-3 gx-0 gy-3">'+
                                '<div class="col-lg-3 col-md-4 col-sm-6">'+
                                    '<img src="' + imageUrl1 + '" alt="photo1" width="800" height="600" class="img-fluid">'+
                                '</div>'+
                                '<div class="col-lg-3 col-md-4 col-sm-6">'+
                                    '<img src="' + imageUrl2 + '"  alt="photo1" width="800" height="600" class="img-fluid">'+
                                '</div>'+
                                '<div class="col-lg-3 col-md-4 col-sm-6">'+
                                    '<img src="' + imageUrl3 + '"  alt="photo1" width="800" height="600" class="img-fluid">'+
                                '</div>'+
                                '<div class="col-lg-3 col-md-4 col-sm-6">'+
                                    '<img src="' + imageUrl4 + '"  alt="photo1" width="800" height="600" class="img-fluid">'+
                                '</div>'+
                            '</div>'+
                        '</div>';

                        console.log(container)

                        // insert images into editor
                        $('#trumbowyg-demo').trumbowyg('html', container);


                        // close modal with value 1
                        return true
                    }
                })

                // You can also listen for modal confirm/cancel events to do some custom things
                // Note: the openModalInsert callback is called on tbwconfirm
                $modal.on('tbwconfirm', function (e) {
                    console.log(e)
                    console.log('confirmed')
                })

                $modal.on('tbwcancel', function (e) {
                    trumbowyg.closeModal()
                })
            }
        }
    }

    // If the plugin is a button
    function buildButtonIcon() {
        if ($("#trumbowyg-gallery").length > 0) {
            return
        }

        /*
        When your button is created, an SVG will be inserted with an xref to a
        symbol living at the fragment "#trumbowyg-gallery". For Trumbowyg's
        own plugins, this will come from a sprite sheet which is injected into
        the document, built from the icon SVG in "ui/icons" in your plugin's
        source tree. This is how you should organise things if you are
        proposing your plugin to be included in the Trumbowyg main
        distribution, or if you are rolling your own custom build of Trumbowyg
        for your site.

        But, nothing says it *has* to come from Trumbowyg's injected sprite
        allow stand-alone distribution of your plugin, we're going to insert a
        sheet; it only requires that this symbol exists in your document. To
        custom SVG symbol into the document with the correct ID.
        */
        const iconWrap = $(document.createElementNS("http://www.w3.org/2000/svg", "svg"))
        iconWrap.addClass("trumbowyg-icons")

        // For demonstration purposes, we've taken the "File" icon from
        // Remix Icon - https://remixicon.com/
        iconWrap.html(`
            <symbol id="trumbowyg-gallery" viewBox="0 0 24 24">
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path d="M20 13C18.3221 13 16.7514 13.4592 15.4068 14.2587C16.5908 15.6438 17.5269 17.2471 18.1465 19H20V13ZM16.0037 19C14.0446 14.3021 9.4079 11 4 11V19H16.0037ZM4 9C7.82914 9 11.3232 10.4348 13.9738 12.7961C15.7047 11.6605 17.7752 11 20 11V3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H6V1H8V5H4V9ZM18 1V5H10V3H16V1H18ZM16.5 10C15.6716 10 15 9.32843 15 8.5C15 7.67157 15.6716 7 16.5 7C17.3284 7 18 7.67157 18 8.5C18 9.32843 17.3284 10 16.5 10Z"/>
            </symbol>
        `).appendTo(document.body)
    }


    $.extend(true, $.trumbowyg, {
        // Add some translations
        langs: {
            en: {
                gallery: 'Gallery'
            },
            tr: {
                gallery: 'Galeri'
            },
            ru: {
                gallery: 'галерея'
            },
            ar: {
                gallery: 'مُعَرَّض'
            }
        },
        // Register plugin in Trumbowyg
        plugins: {
            gallery: {
                // Code called by Trumbowyg core to register the plugin
                init: function (trumbowyg) {
                    // Fill current Trumbowyg instance with the plugin default options
                    trumbowyg.o.plugins.gallery = $.extend(true, {},
                        defaultOptions,
                        trumbowyg.o.plugins.gallery || {}
                    )

                    // If the plugin is a button
                    buildButtonIcon()
                    trumbowyg.addBtnDef('gallery', buildButtonDef(trumbowyg))
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