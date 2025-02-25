#include <iostream>
using namespace std;

struct Peminjam {
    string nama;
    string tipe;
    string plat;
};

struct Node {
    Peminjam p;
    Node* next;
};


Node *head = NULL; 

void enqueue(Peminjam p) {
    Node* newNode = new Node;
    newNode->p = p;
    newNode->next = NULL;
    if (head == NULL) {
        head = newNode;
        return;
    }
    Node *last = head;
    while (last->next != NULL) last = last->next;
    last->next = newNode;
}

void dequeue() {
    if (head == NULL) {
        cout << "Antrian Kosong!" << endl;
        return;
    }
    Node* deq = head;
    head = head->next;

    cout << "Menghapus: " << deq->p.nama << "(" << deq->p.plat << ") | " << deq->p.tipe << endl;
    delete deq;
}


void view_input();
void view_print();
void view_hapus();
void view_jumlah();

int main(){
    int choice;
    do {
        cout << "--MENU--" << endl;
        cout << "1. Input data" << endl;
        cout << "2. Hapus data" << endl;
        cout << "3. Print queue" << endl;
        cout << "4. Jumlah queue" << endl;
        cout << "5. Exit" << endl;
        cout << "Pilih: "; cin >> choice;

        switch (choice)
        {
        case 1:
            view_input();
            break;
        case 2:
            view_hapus();
            break;
        case 3:
            view_print();
            break;
        case 4:
            view_jumlah();
            break;
        
        default:
            break;
        }


    } while (choice != 5);
}

void view_input(){
    Peminjam p;
    cin.ignore();
    cout << "Nama Peminjam: "; getline(cin, p.nama);
    cout << "Tipe mobil: "; getline(cin, p.tipe);
    cout << "Plat nomor: "; getline(cin, p.plat);

    enqueue(p);

    cout << "Data berhasil di tambahkan!" << endl << endl;
    char back;
    do {
        cout << "Kembali? (y/n): "; cin >> back;
    } while (back != 'y' && back != 'Y');
    
}

void view_hapus(){
    dequeue();
    char back;
    do {
        cout << "Kembali? (y/n)"; cin >> back;
    } while (back != 'y' && back != 'Y');
}

void view_print(){
    Node *tmp = head;
    char back;
    if (tmp == NULL){
        cout << "Data kosong" << endl;
        do {
            cout << "Kembali? (y/n)"; cin >> back;
        } while (back != 'y' && back != 'Y');
        return;
    }
    cout << "---Daftar Antrian---" << endl;
    while (tmp != NULL) {
        Peminjam p = tmp->p;
        cout << "Nama: " << p.nama << endl;
        cout << "Plat: " << p.plat << endl;
        cout << "Jenis: " << p.tipe << endl;
        cout << "-----------------------" << endl;
        tmp = tmp->next;
    }
    do {
        cout << "Kembali? (y/n)"; cin >> back;
    } while (back != 'y' && back != 'Y');
}

void view_jumlah(){
    Node *tmp = head;
    int jumlah = 0;
    while (tmp != NULL) {
        jumlah++;
        tmp = tmp->next;
    }

    cout << "Jumlah Antrian: " << jumlah << endl;

    char back;
    do {
        cout << endl << "Kembali? (y/n): "; cin >> back;
    } while (back != 'y' && back != 'Y');

}