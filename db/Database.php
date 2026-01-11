<?php
/**
 * User: Systemx
 * Date: Date: 11/11/2022
 * Time: 8:09 AM
 */

namespace systemx\SystemxCore\db;


use systemx\SystemxCore\Systemx;

/**
 * Class Database
 *
 * @author  Lawrence John <thelaw111@gmail.com> 
 * @package systemx\SystemxCore
 */
class Database
{
    public \PDO $pdo;

    public function __construct($dbConfig = [])
    {
        $dbDsn = $dbConfig['dsn'] ?? '';
        $username = $dbConfig['user'] ?? '';
        $password = $dbConfig['password'] ?? '';

        $this->pdo = new \PDO($dbDsn, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Systemx::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Systemx::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("There are no migrations to apply");
        }
    }

    protected function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }

    public function rollbackMigrations()
    {
        // 1. Get the very last migration record from the database
        $statement = $this->pdo->prepare("SELECT migration FROM migrations ORDER BY id DESC LIMIT 1");
        $statement->execute();
        $lastMigration = $statement->fetchColumn();

        if (!$lastMigration) {
            $this->log("No migrations found to rollback.");
            return;
        }

        // 2. Locate the migration file
        $file = Systemx::$ROOT_DIR . '/migrations/' . $lastMigration;
        if (file_exists($file)) {
            require_once $file;
            $className = pathinfo($lastMigration, PATHINFO_FILENAME);
            $instance = new $className();

            $this->log("Rolling back migration $lastMigration");
            
            // 3. Execute the down() method in your migration file
            $instance->down(); 
            
            // 4. Remove the record from the migrations table
            $this->deleteMigration($lastMigration);
            $this->log("Rolled back migration $lastMigration");
        } else {
            $this->log("Migration file $lastMigration not found on disk.");
        }
    }

    protected function deleteMigration($migrationName)
    {
        $statement = $this->pdo->prepare("DELETE FROM migrations WHERE migration = :mig");
        $statement->bindValue(':mig', $migrationName);
        $statement->execute();
    }

    protected function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    protected function saveMigrations(array $newMigrations)
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
            $str
        ");
        $statement->execute();
    }

    public function prepare($sql): \PDOStatement
    {
        return $this->pdo->prepare($sql);
    }

    private function log($message)
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }
}