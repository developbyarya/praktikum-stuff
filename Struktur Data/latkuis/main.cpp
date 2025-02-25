// Linked List Melingkar dengan kepala dan ekor
#include <iostream>
#include <iomanip>
using namespace std;

struct Nilai {
    int tugas, kuis, responsi;
    Nilai(){};
    Nilai(int t, int k, int r){
        tugas = t;
        kuis = k;
        responsi = r;
    }
};

struct Mahasiswa {
    string nama, nim;
    Nilai nilai;
    Mahasiswa(){};
    Mahasiswa(string nm, string im, Nilai nil){
        nama = nm;
        nim = im;
        nilai = nil;
    };
    
};

struct Node {
    Mahasiswa mhs;
    Node *next;
};

int getNilaiRataRata(Nilai nilai) {
    int nilaiTugas = nilai.tugas * 0.25;
    int nilaiKuis = nilai.kuis * 0.35;
    int nilaiResponsi = nilai.responsi * 0.4;

    return nilaiTugas + nilaiKuis + nilaiResponsi;
}

Node *kepala, *ekor = NULL;

void init() {
    if (kepala != NULL) return;
    kepala = new Node;
    ekor = new Node;
    kepala->mhs = Mahasiswa("-", "000000000", Nilai(-1,-1,-1)); 
    ekor->mhs = Mahasiswa("+", "999999999", Nilai(101,101,101)); 
    kepala->next = ekor;
    ekor->next = kepala;
}

void sisip(Mahasiswa mhs) {
    Node *newNode = new Node;
    newNode->mhs = mhs;
    newNode->next = newNode;
    int nilai = getNilaiRataRata(mhs.nilai);
    if (nilai <= getNilaiRataRata(kepala->next->mhs.nilai)) {
        // Sisip depan;
        newNode->next = kepala->next;
        kepala->next = newNode;
    } else{
        Node *tmp = kepala->next;
        while (tmp->next != ekor && nilai < getNilaiRataRata(tmp->next->mhs.nilai)) {
            tmp = tmp->next;
        }
        newNode->next = tmp->next;
        tmp->next = newNode;
    }

}

void hapus(string nim) {

    Node *search = kepala;
    while (search->next->mhs.nim != nim && search->next != ekor) {
        search = search->next;
    }
    Node* hapus = search->next;
    search->next = hapus->next;

    free(hapus);

}

// fungsi utilitas
void lots_of_eq() {
    // fungsi untuk ========
    cout << setw(51) << setfill('=') << " " << endl;
}

void njir_bisa_tengah(string data) {
    // fungsi untuk menampilkan data ditengah
    int size = data.size();
    int left_space = (51-size) / 2;
    int right_space = 51-size-left_space;

    cout << setw(left_space + size) << right << setfill(' ') << data << left << setw(right_space) << setfill(' ') << right << endl;
} 

bool is_nim_used(string nim) {
    if (kepala == NULL) return false;
    Node *start, *moved;
    start = moved = kepala;
    while (moved->next != start) {
        if (moved->mhs.nim == nim) {
            return true;
        }
        moved = moved->next;
    }
    return false;
}

void add_mhs_view() {
    lots_of_eq();
    njir_bisa_tengah("TAMBAH MAHASISWA");
    lots_of_eq();

    Mahasiswa mhs;
    do {
        cout << "Masukan NIM: ";
        cin >> mhs.nim;
        if (is_nim_used(mhs.nim)) {
            cout << "NIM Sudah Terpakai!" << endl;
        } else {
            break;
        }
    } while (!is_nim_used(mhs.nim));
    cin.ignore();
    cout << "Masukan Nama: "; getline(cin, mhs.nama);
    Nilai nilai;
    cout << "Masukan \n\tNilai Tugas (25%): "; cin >> nilai.tugas;
    cout << "\tNilai Kuis (35%): "; cin >> nilai.kuis;
    cout << "\tNilai Responsi (40%): "; cin >> nilai.responsi;
    mhs.nilai = nilai;

    sisip(mhs);

}

void view_mhs() {
    lots_of_eq();
    njir_bisa_tengah("DAFTAR MAHASISWA");
    lots_of_eq();

    if (kepala->next == ekor) {
        cout << "DATA KOSONG!" << endl;
    }

    Node *tmp = kepala->next;
    system("clear");
    while (tmp != ekor) {
        cout << "NIM: " << tmp->mhs.nim << endl;
        cout << "Nama: " << tmp->mhs.nama << endl;
        cout << "Nilai Rata-rata: " << getNilaiRataRata(tmp->mhs.nilai) << endl;
        tmp = tmp->next;
        cout << setw(50) << setfill('-') << " " << endl; 
    }
    cout << "Press Enter to Continue: " << endl;
    system("read");

}

void hapus_view() {
    lots_of_eq();
    njir_bisa_tengah("HAPUS MAHASISWA");
    lots_of_eq();
    string nim;
    cout << "Masukan NIM: "; cin >> nim;
    
    if (!is_nim_used(nim)) {
        cout << "HAPUS GAGAL: DATA TIDAK ADA!" << endl;
        system("read");
        return;
    }
    hapus(nim);
    cout << "Hapus berhasil! Enter to Continue..." << endl; 
    system("read");



}


void main_view() {
    int choice;
    do {
        lots_of_eq();
        njir_bisa_tengah("DATA MAHASISWA");
        lots_of_eq();

        cout << "1. Input Data Mahasiswa" << endl;
        cout << "2. Lihat Data Mahasiswa" << endl;
        cout << "3. Hapus Data Mahasiswa" << endl;
        cout << "4. Exit" << endl;
        cout << "Pilih: "; cin >> choice;

        switch (choice)
        {
            case 1:
                add_mhs_view();
                break;
            case 2:
                view_mhs();
                break;
            case 3:
                hapus_view();
                break;
            case 4:
                exit(0);
                break;
            default:
                cout << "Pilih yang bener!" << endl;
                break;
        }
    } while (true);

}

int main() {
    init();
    main_view();

    return 0;
}