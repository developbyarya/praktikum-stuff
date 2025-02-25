#include <iostream>
using namespace std;


int queue[8];
int front = -1, back = -1; // sentinel;

void enqueue(int info) {
    back = (back + 1) % 7;
    queue[back] = info;
}
int dequeue() {
    front = (front+1) % 7;
    return queue[front];
}

void dispArray(){
    cout << "ISi Array: " << endl;
    for (int i=0; i < 7; i++) {
        cout << queue[i] << ", ";
    }
    cout << endl;
}

void dispQueue(){
    cout << "Isi Queue: " << endl;
    int t = front+1;

    while (t != back){
        cout << queue[t] << ", ";
        t = (t+1) % 7;
    }

    cout << endl;

}

int main(){
    enqueue(1);
    enqueue(2);
    enqueue(3);

    cout << dequeue() << endl;

}