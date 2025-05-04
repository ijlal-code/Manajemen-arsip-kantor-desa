# MANSIP (Manajemen Arsip Kantor Desa)

![Image](https://github.com/user-attachments/assets/a67c3794-246e-4ad4-afb6-cbe2a894abb9)

## 📌 Fitur Utama

### 👤 Admin
- Mengelola pengguna (CRUD User)
- Mengelola kategori arsip
- Melihat semua arsip

### 🧾 Sekretaris Desa
- Upload arsip baru
- Melihat dan mengedit arsip yang diunggah
- Menghapus arsip

### 🧑‍💼 Kepala Desa
- Melihat daftar arsip
- Mencetak / mengunduh arsip (PDF / DOCX)

## 🗃️ Struktur Database

### Tabel `users`
| Field       | Tipe Data    | Keterangan                  |
|-------------|--------------|-----------------------------|
| id          | BIGINT       | Primary Key                 |
| name        | VARCHAR(255) | Nama Pengguna               |
| email       | VARCHAR(255) | Email (unik)                |
| password    | VARCHAR(255) | Password                    |
| role        | ENUM         | Admin, Sekretaris, Kepala Desa |
| created_at  | TIMESTAMP    | Timestamp dibuat            |
| updated_at  | TIMESTAMP    | Timestamp diperbarui        |

### Tabel `kategori_arsip`
| Field         | Tipe Data    | Keterangan            |
|---------------|--------------|-----------------------|
| id            | BIGINT       | Primary Key           |
| nama_kategori | VARCHAR(255) | Nama Kategori Arsip   |
| created_at    | TIMESTAMP    | Timestamp dibuat      |
| updated_at    | TIMESTAMP    | Timestamp diperbarui  |

### Tabel `arsip`
| Field         | Tipe Data    | Keterangan                       |
|---------------|--------------|----------------------------------|
| id            | BIGINT       | Primary Key                      |
| judul_arsip   | VARCHAR(255) | Nama arsip / judul               |
| file_arsip    | VARCHAR(255) | Nama file yang diupload          |
| tanggal_upload| DATE         | Tanggal pengarsipan              |
| kategori_id   | BIGINT       | Foreign Key ke `kategori_arsip` |
| user_id       | BIGINT       | Foreign Key ke `users`           |
| created_at    | TIMESTAMP    | Timestamp dibuat                 |
| updated_at    | TIMESTAMP    | Timestamp diperbarui             |

## 🔄 Relasi Antar Tabel

- **One-to-Many:** `users` → `arsip`
- **One-to-Many:** `kategori_arsip` → `arsip`

