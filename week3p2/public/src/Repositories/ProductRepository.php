<?php

class ProductRepository
{
    public function __construct(private readonly PDO $pdo) {}

public function findById(int $id): ?Product
{
    $statement = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
    $statement->execute(['id' => $id]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row ? $this->hydrate($row) : null;
}
    

public function findAll(): array    {
    $stmt = $this->pdo->prepare('SELECT * FROM products');
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $products = [];
    foreach ($rows as $row) {
        $products[] = $this->hydrate($row);
    }
    return $products;
}

public function insert(Product $product): Product
    {
    $stmt = $this->pdo->prepare('INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)');
        $stmt->execute([
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock
        ]);
    return new Product(
        id: (int) $this->pdo->lastInsertId(),
        name: $product->name,
        price: $product->price,
        stock: $product->stock
    );
    }

    public function update(Product $product): void
    {
        $stmt = $this->pdo->prepare('UPDATE products SET name = :name, price = :price, stock = :stock WHERE id = :id');
        $stmt->execute([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock
        ]);
    }

    private function hydrate(array $row): Product {
        return new Product(
            id: (int) $row['id'],
            name: $row['name'],
            price: (float) $row['price'],
            stock: (int) $row['stock']
        );
    }

    public function delete(int $id): void
{
    $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
    $stmt->execute(['id' => $id]);
}
}