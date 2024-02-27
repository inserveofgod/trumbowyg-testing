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

    <!-- tailwind css -->
    <link rel="stylesheet" href="css/tailwind.min.css" media="screen">
    <title>Trumbowyg Editör</title>
</head>

<body>
    <main>
        <div class="container mx-auto my-5">
            <textarea id="trumbowyg-demo"></textarea>

            <!-- Modal toggle -->
            <button id="launchFileUploadModal" data-modal-target="fileUploadModal" data-modal-toggle="fileUploadModal"
                class="hidden" type="button">
                Toggle modal
            </button>

            <!-- Main modal -->
            <div id="fileUploadModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Upload File(s)
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="fileUploadModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">
                                <div class="bg-blue-600 h-6 rounded-full" style="width: 0%;" id="fileProgress">
                                    0%
                                </div>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data" id="fileUploadForm">
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <input type="file" id="ImageFiles" name="image_files[]" accept="image/*"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        multiple required>
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                                </div>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button id="ImageInsertButton" data-modal-hide="fileUploadModal" type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Insert Images</button>
                            <button id="ImageUploadCancelButton" data-modal-hide="fileUploadModal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- jquery -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>

    <!-- flowbite js for modal -->
    <script src="node_modules/flowbite/dist/flowbite.min.js"></script>

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
    <script src="node_modules/trumbowyg/dist/plugins/image_upload/trumbowyg.image_upload.min.js"></script>

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
</body>

</html>