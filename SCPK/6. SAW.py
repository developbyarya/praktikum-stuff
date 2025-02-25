import numpy as np

C_dict = np.array(["Harga", "Nilai Investasi", "Daya dukung", "Prioritas Kebutuhan", "Ketersedian"])
C_weight = np.array([.25, .15, .3, .25, .05])
C_norm_rule = np.array([0, 1, 1, 0, 1]) # 0 for cost, 1 for benefit


assert sum(C_weight) == 1.0, "Bobot harus sama dengan 1"
assert len(C_dict) == len(C_weight), "Panjang array tidak sama"
assert len(C_dict) == len(C_norm_rule), "Panjang array tidak sama"

A_dict = np.array(["Beli mobil box", "Beli tanah", "Maintenance IT", "Pengembangan produk baru"])

def norm(X, j):
    if C_norm_rule[j]:
        X[:, j] = X[:, j] / np.max(X[:, j])
    else:
        X[:, j] = np.min(X[:, j]) / X[:, j]  
    return X

X = np.array([
    [150, 15, 2, 2, 3],
    [500, 200, 2, 3, 2],
    [250, 10, 3, 1, 3],
    [350, 100, 3, 1, 2],
], dtype=float)

for j in range(len(C_dict)):
    # Normalisasi
    X = norm(X, j)

print("Setelah di normalisasi: ", X)

result = np.sum(X * C_weight, axis=1)

print("Final decision: ", A_dict[np.argmax(result)])