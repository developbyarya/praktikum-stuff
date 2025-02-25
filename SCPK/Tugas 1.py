import sys, os, platform

daftar_buku = []
# Ambil platform (linux, windows, macos)
user_os = platform.system()

clear_console = lambda: os.system('clear' if user_os == 'Linux' else 'cls')
pause_console = lambda: os.system('read' if user_os == 'Linux' else 'pause')

def cek_id(id: int):
    daftar_id = set([buku['id'] for buku in daftar_buku]) # set agar pencarian O(1)
    return id in daftar_id

def view_input_buku():
    clear_console()
    print("===Tambahkan buku===")

    while True:

        try:
            i_id = int(input("ID Buku: "))
        except ValueError:
            print("Angka bosss")
            continue
        if (cek_id(i_id)):
            print("ID sudah digunakan....")
            continue
        i_judul = input("Judul Buku: ")
        i_penulis= input("Penulis Buku: ")
        try:
            i_tahun = int(input("Tahun terbit: "))
        except ValueError:
            print("Angka bosss")
            continue
        daftar_buku.append({
            "id": i_id,
            "judul": i_judul,
            "penulis": i_penulis,
            "tahun_terbit": i_tahun
        })
        conti = str(input("Apakah ingin menambahkan lagi? (y/n)"))
        if conti != 'y':
            break

def view_daftar_buku(d_buku):
    print("==Daftar Buku==")
    print("------------------------------")
    if (not len(d_buku)):
        print("Belum ada buku...")
        pause_console()
        return
    for buku in d_buku:
        print("ID: ", buku['id'])
        print("Judul: ", buku['judul'])
        print("Penulis: ", buku['penulis'])
        print("Tahun terbit: ", buku['tahun_terbit'])
        print("--------------------------")
    print("Enter untuk lanjut")
    pause_console()

    
def view_cari_buku():
    print("===Cari Bukuu===")
    print("-----------------")
    judul_cari = str(input("Masukan judul: "))
    hasil_cari = [buku for buku in daftar_buku if judul_cari in buku['judul']]
    view_daftar_buku(hasil_cari)
    print("Enter untuk lanjut")
    pause_console()

def view_hapus_buku():
    global daftar_buku
    if (not len(daftar_buku)):
        print("Buku kosong!")
        return
    print("===Hapus Bukuu===")
    print("-----------------")
    id_hapus = int(input("Masukan ID: "))
    if (cek_id(id_hapus)):
        daftar_buku = [buku for buku in daftar_buku if buku['id'] != id_hapus]
        print("Berhasil Hapus buku! (enter untuk lanjut)")
        pause_console()
        return daftar_buku
    else:
        print("Buku yang dicari tidak ada")
        pause_console()


while True:
    clear_console()
    print("===Perpustakaan Plug IF-C===")
    print("1. Input Buku")
    print("2. Daftar Buku")
    print("3. Cari Buku")
    print("4. Hapus Buku")
    print("0. Exit")
    try:
        pilih = int(input("Pilih opsi: "))
    except ValueError:
        print("tidak boleh kosong bang!")
        continue

    match (pilih):
        case 0:
            exit(0)
        case 1:
            view_input_buku()
        case 2:
            view_daftar_buku(daftar_buku)
        case 3:
            view_cari_buku()
        case 4:
            daftar_buku = view_hapus_buku()

