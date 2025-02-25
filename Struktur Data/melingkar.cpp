#include <iostream>

using namespace std;

struct LGanda
{
    int data;
    LGanda *next, *prev;
};

LGanda *head, *tail;

void init(int data)
{
    if (head != NULL)
    {
        cout << "Sudah Init!" << endl;
        return;
    }

    head = tail = new LGanda;
    head->data = data;
    head->next = NULL;
    head->prev = NULL;
}

void sisipDepan(int IB)
{
    LGanda *newNode = new LGanda();
    newNode->data = IB;

    newNode->next = head;
    newNode->prev = NULL;
    head->prev = newNode;

    head = newNode;
}

void sisipBelakang(int IB)
{
    LGanda *newNode = new LGanda;
    newNode->data = IB;
    newNode->prev = tail;
    newNode->next = NULL;
    tail->next = newNode;
    tail = newNode;
}

void sisip(int IB) {
    LGanda *newNode = new LGanda;
    newNode->data = IB;

    if (IB <= head->data) {
        sisipDepan(IB);
        cout << "Sisip Depan" << endl;
    } else if (IB >= tail->data) {
        sisipBelakang(IB);
        cout << "Sisip Belakang" << endl;
    } 
    else if(IB < tail->data) {
        LGanda *bantu = head;
        cout << "Sisip Tengah" << endl;
        cout << "Bantu " << bantu->data << endl;
        while (bantu->next != NULL && bantu->next->data < IB) {
            bantu = bantu->next;
            cout << "Bantu " << bantu->data << endl;
        }
        newNode->prev = bantu;
        newNode->next = bantu->next;
        bantu->next->prev = newNode;
        bantu->next = newNode;


    }     
}

void hapus(int target) {
    LGanda *nodeHapus = head;
    while (nodeHapus != NULL && nodeHapus->data != target )
    {
        nodeHapus = nodeHapus->next;
    }
    if (nodeHapus->prev == NULL) {
        nodeHapus->next->prev = NULL;
        delete nodeHapus;
    } else if (nodeHapus->next == NULL) {
        nodeHapus->prev->next = NULL;
        delete nodeHapus;
    } else {
        nodeHapus->prev->next = nodeHapus->next;
    }


}

void display() {
    LGanda *bantu = head;
    while  (bantu != NULL) {
        cout << bantu->data << " | ";
        bantu = bantu->next;
    }
    cout << endl;
}

void reverse() {
    LGanda *bantu = tail;
    while  (bantu != NULL) {
        cout << bantu->data << " | ";
        bantu = bantu->prev;
    }
    cout << endl;

}



int main()
{
    init(5);
    sisip(1);
    sisip(2);
    sisip(3);
    display();
    reverse();
}