#include <iostream>
using namespace std;

struct Buku {
    int id_buku;
    string judul;
    string genre;
};

struct Node {
    Buku buku;
    Node* next;
};

Node *head = NULL;

void push(Buku b){
    Node *newNode = new Node;
    newNode->buku = b;
    if (head == NULL) {
        newNode->next = NULL;
    } else {
        newNode->next = head;
    }
    head = newNode;
}

void pop() {
    if (head == NULL) {
        cout << "Stack kosong!" << endl;
        return;
    }
    Node* hapus = head;
    head = hapus->next;

    Buku terhapus = hapus->buku;
    cout << "+==============================+\n";
    cout << "|      BUKU YANG KEMBALI       |\n";
    cout << "+==============================+\n";
    cout << "ID\t:" << terhapus.id_buku << endl;
    cout << "Judul\t:" << terhapus.judul << endl;
    cout << "Genre\t:" << terhapus.genre << endl;
    delete hapus;
}

void lihat() {
    Node *tmp = head;

    if (head == NULL) {
        cout << "+==============================+\n";
        cout << "|          RAK KOSONG          |\n";
        cout << "+==============================+\n";
        return;
    }

    cout << "+==============================+\n";
    cout << "|          DAFTAR BUKU         |\n";
    cout << "+==============================+\n";
    while (tmp != NULL) {
        cout << "- " << tmp->buku.judul << endl;
        tmp = tmp->next;
    }
}

void displayMenu() {
    cout << "+==============================+\n";
    cout << "|           MENU UTAMA         |\n";
    cout << "+==============================+\n";
    cout << "1. Tambah buku\n";
    cout << "2. Kembalikan buku ke rak\n";
    cout << "3. Lihat semua buku\n";
    cout << "4. exit\n";
    cout << "\nMasukkan pilihan anda (1-4): ";
}

void addBook() {
    
    Buku bBaru;
    cout << "+==============================+\n";
    cout << "|           Tambah buku        |\n";
    cout << "+==============================+\n";
    cout << "ID buku    : "; cin >> bBaru.id_buku; 
    cin.ignore();
    cout << "Nama buku  : "; getline(cin, bBaru.judul);
    cout << "Genre buku : "; getline(cin,bBaru.genre);
    push(bBaru);
    cout << "\nBuku dengan judul " << bBaru.judul << " telah ditambahkan\n";
}

int main() {
    int choice;
    do {
        displayMenu();
        cin >> choice;

        switch (choice)
        {
        case 1:
            addBook();
            system("read");
            break;
        case 2:
            pop();
            system("read");
            break;
        case 3:
            lihat();
            system("read");
            break;
        case 4:
            exit(0);
            break;
        default:
            break;
        }

    } while (choice < 5 && choice > 0);

    return 0;
}