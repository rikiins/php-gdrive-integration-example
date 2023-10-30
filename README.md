
# Integrasi PHP dengan Penyimpanan Google Drive
Repo ini merupakan contoh integrasi aplikasi web PHP menggunakan ```CodeIgniter 4``` dengan penyimpanan ```Google Drive```. Kode yang dibuat hanya sebatas operasi sederhana seperti Read dan Delete file, untuk best practice dan use case lainnya silahkan sesuaikan dengan project masing-masing.

# Cara Membuat Google OAuth Consent Screen
Mengingat step yang sedikit lebih panjang dibanding membuat Service Account, silahkan lihat dokumentasi atau tutorial yang ada di internet.

# Cara Membuat Service Account Google
1. Buka https://console.cloud.google.com kemudian lihat ke bagian ```APIs & Services``` lalu cari ```Google Drive API``` dan klik ```Enable```.
2. Di dalam tab menu ```Credentials``` klik ```Create Credentials``` -> ```Service Account```.
3. Isi account name lalu klik ```Create & Continue```.
4. Pada bagian ```Grant this service account access to project (optional)``` pilih Role di bagian ```Basic``` sebagai ```Editor``` dan klik ```Continue```.
5. Klik ```Done```.
6. Edit Service Account yang baru dibuat, kemudian klik tab menu ```KEYS```, klik ```Add Key``` -> ```Create New Key``` dan kemudian pilih ```JSON``` lalu yang terakhir klik ```Create``` pada pop up tersebut.
7. Credentials JSON otomatis terdownload.

# Informasi
Pastikan env ```drive.folderId``` disesuaikan dengan Folder Drive yang sudah dishare ke Service Account dan ```Akses umum``` / ```General access``` diset ke ```Siapa saja yang memiliki link``` / ```Anyone with the link```

![Drive Permission](/doc/pic/drive-access-permission.png)

# Screenshot Aplikasi
Upload File
![Drive Upload](/doc/pic/drive-upload.png)

File Terupload
![Drive File Lists](/doc/pic/drive-file-lists.png)