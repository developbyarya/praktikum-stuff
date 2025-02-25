#include <iostream>
using namespace std;

struct Node {
    int data;
    Node *next;
};

Node *top = NULL;

bool isEmpty(){
    if (top == NULL) {
        return true;
    }
    return false;
}

void push(int data) {
    Node *newNode = new Node;
    newNode->data = data;
    newNode->next = top;
    top = newNode;
}

void pop() {
    if (isEmpty()) {
        cout << "Stack Kosong!" << endl;
        return;
    }
    Node *tmp = top;
    top = top->next;
    cout << "Pop:" << tmp->data << endl;
    delete tmp;
    
}

int peek(){
    if (isEmpty()) {
        cout << "Stack Kosong!" << endl;
        return -1;
    }
    return top->data;
}

void display() {
    Node *tmp = top;
    while(tmp != NULL) {
        cout << tmp->data << endl;
        tmp = tmp->next;
    }
}




int main() {
    cout << "Sebelum dihapus!" << endl;
    push(1);
    push(2);
    push(3);
    push(4);
    display();
    pop();
    cout << "----------------" << endl;
    cout << "setelah dihapus!" << endl;
   
    display();
    cout << "PEEK: ";
    cout << peek() << endl;
    
}