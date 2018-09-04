<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180809091546 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, type_visit_id INT DEFAULT NULL, booking_code VARCHAR(255) NOT NULL, date_visit DATE NOT NULL, nb_ticket INT NOT NULL, date_booking DATETIME NOT NULL, email VARCHAR(255) NOT NULL, paymentvalid TINYINT(1) NOT NULL, INDEX IDX_E00CEDDEB805280E (type_visit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_visit (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visitor (id INT AUTO_INCREMENT NOT NULL, booking_id INT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birth_date DATETIME NOT NULL, country VARCHAR(255) DEFAULT NULL, reduction TINYINT(1) NOT NULL, price VARCHAR(255) NOT NULL, INDEX IDX_CAE5E19F3301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEB805280E FOREIGN KEY (type_visit_id) REFERENCES type_visit (id)');
        $this->addSql('ALTER TABLE visitor ADD CONSTRAINT FK_CAE5E19F3301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visitor DROP FOREIGN KEY FK_CAE5E19F3301C60');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEB805280E');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE type_visit');
        $this->addSql('DROP TABLE visitor');
    }
}
