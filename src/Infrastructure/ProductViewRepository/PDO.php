<?php
declare(strict_types=1);

namespace App\Infrastructure\ProductViewRepository;

use App\Domain\ProductData;
use App\Infrastructure\ProductViewRepositoryInterface;
use App\SharedKernel\Dictionary\DateFormat;
use DateTimeInterface;
use Doctrine\DBAL\Connection;

final class PDO implements ProductViewRepositoryInterface
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get(int $page, int $limit): array
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('product_view', 'pv')
            ->where('pv.deleted_at IS NULL')
            ->setFirstResult(($page * $limit) - $limit)
            ->setMaxResults($limit);

        $result = $this->connection->executeQuery(
            $qb->getSQL(),
            $qb->getParameters(),
            $qb->getParameterTypes()
        );


        return $result->fetchAll();
    }

    public function total(): int
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('COUNT(*) as cnt')
            ->from('product_view', 'pv')
            ->where('pv.deleted_at IS NULL');

        $result = $this->connection->executeQuery(
            $qb->getSQL(),
            $qb->getParameters(),
            $qb->getParameterTypes()
        );


        return (int)$result->fetchColumn(0);
    }


    public function getByName(string $name): ?array
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('product_view', 'pv')
            ->where('pv.name = :name')
            ->setParameters([
                'name' => $name
            ]);

        $result = $this->connection->executeQuery(
            $qb->getSQL(),
            $qb->getParameters(),
            $qb->getParameterTypes()
        );

        return $result->fetchAll();
    }

    public function add(string $id, ProductData $productData, DateTimeInterface $createdAt): void
    {
        $this->connection->executeUpdate('
            INSERT INTO product_view
                (id, name, price, created_at)
            VALUES(:id, :productName, :price, :createdAt);
        ', [
            'id'          => $id,
            'productName' => $productData->getName(),
            'price'       => $productData->getPrice(),
            'createdAt'   => $createdAt->format(DateFormat::DEFAULT)
        ]);
    }

    public function markDeleted(string $id, DateTimeInterface $deletedAt): void
    {
        $this->connection->executeUpdate('
            UPDATE product_view
            SET deleted_at= :deletedAt
            WHERE id=:id;
        ', [
            'id'        => $id,
            'deletedAt' => $deletedAt->format(DateFormat::DEFAULT)
        ]);
    }

    public function changeName(string $id, string $name): void
    {
        $this->connection->executeUpdate('
            UPDATE product_view
            SET name=:name
            WHERE id=:id;
        ', [
            'id'   => $id,
            'name' => $name
        ]);
    }

    public function changePrice(string $id, float $price): void
    {
        $this->connection->executeUpdate('
            UPDATE product_view
            SET price=:price
            WHERE id=:id;
        ', [
            'id'    => $id,
            'price' => $price
        ]);
    }
}
