#include <iostream>
using namespace std;

const int m = 5;
int top = -1;

int stack[m];

bool isFull() {
    if (top == m-1) return true;
    return false; 
}

bool isEmpty() {
    return top == -1 ? true : false;
}

void push(int data) {
    if (isFull()) {
        cout << "Stack Overflow!" << endl;
        return;
    }
    stack[++top] = data; 
}

void pop() {
    if (isEmpty()){
        cout << "Stack Kosong!" << endl;
        return;
    }
    cout << stack[top--] << endl;
}

void peek() {
    if (isEmpty()) {
        cout << "Stack kosong!" << endl;
        return;
    }
    cout << stack[top] << endl;
}

void display() {
    if (isEmpty()) {
        cout << "Stack kosong!" << endl;
    }
    for (int i=top; i >= 0; i--) {
        cout << stack[i] << endl;
    }
}



int main() {
    push(1);
    push(2);
    push(3);
    push(4);
    display();
    cout << "SEBELUM DIHAPUS!^^^" << endl;
    pop();
    cout << "SETElAH DIHAPUS!" << endl;
    display();

    
}