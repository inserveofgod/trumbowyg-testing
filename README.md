# trumbowyg-testing

trumbowyg Editörü test etme uygulaması

# Kurulum

<ul>
    <li>$ npm i</li>
</ul>

# Kullanım

Ana klasörde bulunan image_upload klasörünü 
'node_modules\trumbowyg\dist\plugins' ve 'node_modules\trumbowyg\plugins' içerisine
kopyalayın (neden 2 tane plugins klasörü var bilmiyorum, vardır bir hikmeti :D)

index.php içerisinde bulunan modal alanını trumbowyg editörünüzün altına yapıştırın.
upload.php dosyasındaki kodları kendi dosya yükleme sisteminizle entegre edin.
Kendi modülümüz bu PHP dosyasıyla AJAX üzerinden etkileşime geçip seçilen
dosyaları sunucuya yükleyecek ve editörün içerisine yan yana tailwind yapısını
kullanarak esnek bir yapıyla yerleştirecektir.

Modal açıldıktan sonra yüklenen dosyaları editörün içine yüklemeden kapatmak istediğinizde
sunucuya yüklenen dosyaları silme işlemi yapmıyor. Ben buraya kadar ilerleyememiştim. Sunucuya yüklenen
gereksiz fotoğrafları, yük yapmaması için silinmesi uygun olabilir.

Bunlar dışında stillerde bir düzenlemeye gitmedim.

Sunucuya dosya yüklerken hatalarla karşılaşabilirsiniz. 405 veya 400 hatalarını alırsanız,
dosya yollarının veya form içerisindeki 'name' değerlerinin doğru verilip verilmediğini kontrol edin.

Fazladan dosya yükleyebilmek için veya yüklenen dosyaların boyutunu artırmak için sunucu tarafında php.ini
dosyasında şöyle bir değişikliğe gidilebilir. (Düşük verilen değerler sonucu kendi modülümüz istendiği gibi çalışmayabilir)

; Maximum allowed size for uploaded files.
; https://php.net/upload-max-filesize
upload_max_filesize = 4M

; Maximum number of files that can be uploaded via a single request
max_file_uploads = 20
