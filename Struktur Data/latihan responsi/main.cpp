#include <iostream>
using namespace std;

struct Menu {
    string namaMenu;
    int jumlah;
    int harga;
};

struct Node {
    Menu menu;
    Node *next;
};

Node *headStack = NULL;
Node *headQueue = NULL;

bool stackEmpty(){
    return headStack == NULL ? true : false;
}

bool queueEmpty(){
    return headQueue == NULL ? true : false;
}
/*
Push Data (*Menu) to Stack
*/
void push(Menu menu){
    Node *newNode = new Node;
    newNode->menu = menu;
    if (headStack == NULL) {
        headStack = newNode;
        return;
    }
    newNode->next = headStack;
    headStack = newNode;
}
/*
Poping Data from Stack: Return Menu
*/
Menu pop(){
    if (headStack == NULL){
        return Menu();
    }
    Node* poped = headStack;
    headStack = headStack->next;
    Menu menu = poped->menu;

    delete poped;
    return menu;
}


/*
Add data to queue
*/
void enqueue(Menu menu){
    Node* newNode = new Node;
    newNode->menu = menu;
    newNode->next = NULL;
    if (headQueue == NULL){
        headQueue = newNode;
        return;
    }

    Node* tail = headQueue;
    // O(n)
    while (tail->next != NULL) {
        tail = tail->next;
    }
    tail->next = newNode;
}

/* Get queue: Menu*/
Menu dequeue(){
    if (headQueue == NULL) {
        return Menu();
    }
    Node* deq = headQueue;
    headQueue = headQueue->next;
    Menu menu = deq->menu;
    return menu;
}

/* Move stack to queue */
void move(){
    while (!stackEmpty()){
        Menu poped = pop();
        cout << "- " << poped.namaMenu << endl;
        enqueue(poped);
    }
}

void pause(){
    char y;
    do {
        cout << "Apakah ingin lanjut? (y) "; cin >> y;
    }while(y != 'y' && y != 'Y');
}

void viewTambahData();
void viewPindahData();
void viewCekData();
void viewhapusData();

int main(){
    int choice;
    do {
        cout << "+========================+" << endl;
        cout << "|        Restoran        |" << endl;
        cout << "+========================+" << endl;
        cout << "1. Tambah Data" << endl;
        cout << "2. Pindah data" << endl;
        cout << "3. Cek data" << endl;
        cout << "4. Hapus data" << endl;
        cout << "5. Exit" << endl;
        cout << "Pilih: "; cin >> choice;

        switch (choice)
        {
        case 1:
            viewTambahData();
            break;
        case 2:
            viewPindahData();
            break;
        case 3:
            viewCekData();
            break;
        case 4:
            viewhapusData();
            break;
        case 5:
            continue;
            break;
        default:
            cout << "Pilihan tidak tersedia" << endl;
            break;
        }

    } while (choice != 5);
    return 0;
}

void viewTambahData(){
    char lnjt;
    do {
        Menu menu;
        cout << "+========================+" << endl;
        cout << "|      Tambah Data       |" << endl;
        cout << "+========================+" << endl;
        cin.ignore();
        cout << "Nama menu: ";
        getline(cin, menu.namaMenu);
        cout << "Harga: "; cin >> menu.harga;
        cout << "Jumlah: "; cin >> menu.jumlah;

        push(menu);
        cout << endl << "Data berhasil ditambahkan!" << endl;
        cout << "Tambah data lain? (y/n): "; cin >> lnjt;

    }while(lnjt == 'y');

}
void viewPindahData(){
    cout << "Memindahkan data" << endl;
    move();
    cout << "Pesanan dilanjutkan ke Chef!" << endl;
    pause();
}
void viewCekData(){
        cout << "+================================+" << endl;
        cout << "| Stack Data (Dari yang terbaru) |" << endl;
        cout << "+================================+" << endl;
        Node* stack = headStack;
        if (stackEmpty()) {
            cout << "KOSONG!" << endl;
        }
        while (stack != NULL){
            cout << "Pesanan: " << stack->menu.namaMenu << endl; 
            cout << "Harga: " << stack->menu.harga << endl; 
            cout << "Jumlah: " << stack->menu.jumlah << endl; 
            cout << "----------------------------------" << endl;
            stack = stack->next;
        }
        
        cout << "+================================+" << endl;
        cout << "|  Queue Data (Dari yang awal)   |" << endl;
        cout << "+================================+" << endl;
        Node* queue = headQueue;
        if (queueEmpty()) {
            cout << "KOSONG!" << endl;
        }
        while (queue != NULL){
            cout << "Pesanan: " << queue->menu.namaMenu << endl; 
            cout << "Harga: " << queue->menu.harga << endl; 
            cout << "Jumlah: " << queue->menu.jumlah << endl; 
            cout << "----------------------------------" << endl;
            queue = queue->next;
        }
        pause();
        
}
void viewhapusData(){
    cout << "+================================+" << endl;
    cout << "|   Menghapus data dari Queue    |" << endl;
    cout << "+================================+" << endl;
    Menu hapus = dequeue();
    cout << "Pesanan terhapus: " << hapus.namaMenu << endl;
    cout << "Jumlah: " << hapus.jumlah << endl;
    cout << "Harga: " << hapus.harga << endl;
    cout << "----------------------------------" << endl;
    pause();

};