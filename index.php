<!DOCTYPE html>
<html lang="en"> <!-- site dil ayarlaması buradan yapılır. örn: {{ app.request._locale }} -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="website description">
    <meta name="keywords" content="keyword1, keyword2">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <!-- trumbowyg -->
    <link rel="stylesheet" href="node_modules/trumbowyg/dist/ui/trumbowyg.min.css" media="screen">

    <!-- color plugin -->
    <link rel="stylesheet" href="node_modules/trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css" media="screen">

    <!-- table plugin -->
    <link rel="stylesheet" href="node_modules/trumbowyg/dist/plugins/table/ui/trumbowyg.table.min.css" media="screen">

    <!-- diğer stillemeler -->
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/style.css" media="screen">
    <title>Editör</title>
</head>

<body>
    <main>
        <div class="container my-5">
            <textarea id="trumbowyg-demo"></textarea>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary d-none" id="launchFileUploadModal" data-bs-toggle="modal"
                data-bs-target="#fileUploadModal">
                Launch modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="fileUploadModal" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary">Upload File(s)</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="progress mb-3">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" style="width: 0%;" id="fileProgress">0%</div>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data" id="fileUploadForm">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="ImageFiles" name="image_files[]"
                                        accept="image/*" multiple required>
                                    <button type="submit" class="btn btn-outline-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" id="ImageUploadCancelButton"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-outline-success" id="ImageInsertButton">
                                Insert Images
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- bootstrap ve jquery kütüphaneleri -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>

    <!-- trumbowyg editörü -->
    <!-- resimleri mouse ile boyutlandırabilmek için kütüphane -->
    <script src="node_modules/jquery-resizable-dom/dist/jquery-resizable.min.js"></script>

    <!-- editör -->
    <script src="node_modules/trumbowyg/dist/trumbowyg.min.js"></script>

    <!-- plugins -->
    <!-- renkler -->
    <script src="node_modules/trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js"></script>

    <!-- tablo -->
    <script src="node_modules/trumbowyg/dist/plugins/table/trumbowyg.table.min.js"></script>

    <!-- editör içerisindeki resimleri mouse ile boyutlandırabilmek için kütüphane -->
    <script src="node_modules/trumbowyg/dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>

    <!-- kendi upload modülümüz -->
    <script src="node_modules/trumbowyg/dist/plugins/image_upload/trumbowyg.image_upload.js"></script>

    <!-- localization örn: {{ app.request._locale }} -->
    <script src="node_modules/trumbowyg/dist/langs/tr.min.js"></script>
    <script>
        $(function () {
            $('#trumbowyg-demo').trumbowyg({
                btns: [
                    ['viewHTML'],
                    ['formatting'],
                    /* ön ve arka renk ayarlama butonları */
                    ['foreColor', 'backColor'],
                    ['strong', 'em', 'del'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['insertImage', 'upload'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['horizontalRule'],
                    ['removeformat'],
                    /* tablo eklemek için */
                    ['table'],
                    /* kendi upload mödülümüzü eklemek için */
                    ['imageUpload'],
                    ['fullscreen'],
                ],
                /* dil ayarlaması yapmak için örn: {{ app.request._locale }} */
                lang: 'tr',
                /* editörün metinin boyutuna göre otomatik büyümesi için */
                autogrow: true,
                /* etiketlere sınıf vermek isterseniz */
                tagClasses: {
                    table: 'table table-bordered',
                    img: 'img-fluid'
                },
                semantic: {
                    'div': 'div' // Editor does nothing on div tags now
                },
                /* kaldırılmasını istediğiniz etiketleri buraya yazabilirsiniz */
                // tagsToRemove: ['script', 'link', 'table'],
                /* tutmak istediğiniz etiketleri buraya yazabilirsiniz */
                // tagsToKeep: ['p', 'article', 'span']
            })
        })
    </script>

    <!-- diğer script dosyaları -->
    <script src="js/script.js"></script>
</body>

</html>