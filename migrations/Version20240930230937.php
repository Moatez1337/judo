<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240930230937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE belt (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technique_belt (technique_id INT NOT NULL, belt_id INT NOT NULL, INDEX IDX_C652E9D11F8ACB26 (technique_id), INDEX IDX_C652E9D1F8E3ADFE (belt_id), PRIMARY KEY(technique_id, belt_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE technique_belt ADD CONSTRAINT FK_C652E9D11F8ACB26 FOREIGN KEY (technique_id) REFERENCES technique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE technique_belt ADD CONSTRAINT FK_C652E9D1F8E3ADFE FOREIGN KEY (belt_id) REFERENCES belt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_technique DROP FOREIGN KEY FK_68A89D181F8ACB26');
        $this->addSql('ALTER TABLE exam_technique DROP FOREIGN KEY FK_68A89D18578D5E91');
        $this->addSql('DROP TABLE exam_technique');
        $this->addSql('ALTER TABLE exam ADD name_id INT DEFAULT NULL, ADD exam_taker_id INT DEFAULT NULL, ADD date DATE NOT NULL, DROP color');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C671179CD6 FOREIGN KEY (name_id) REFERENCES belt (id)');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C6484A3BF0 FOREIGN KEY (exam_taker_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_38BBA6C671179CD6 ON exam (name_id)');
        $this->addSql('CREATE INDEX IDX_38BBA6C6484A3BF0 ON exam (exam_taker_id)');
        $this->addSql('ALTER TABLE technique ADD category INT NOT NULL, ADD video VARCHAR(255) NOT NULL, DROP is_throw');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C671179CD6');
        $this->addSql('CREATE TABLE exam_technique (exam_id INT NOT NULL, technique_id INT NOT NULL, INDEX IDX_68A89D18578D5E91 (exam_id), INDEX IDX_68A89D181F8ACB26 (technique_id), PRIMARY KEY(exam_id, technique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE exam_technique ADD CONSTRAINT FK_68A89D181F8ACB26 FOREIGN KEY (technique_id) REFERENCES technique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_technique ADD CONSTRAINT FK_68A89D18578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE technique_belt DROP FOREIGN KEY FK_C652E9D11F8ACB26');
        $this->addSql('ALTER TABLE technique_belt DROP FOREIGN KEY FK_C652E9D1F8E3ADFE');
        $this->addSql('DROP TABLE belt');
        $this->addSql('DROP TABLE technique_belt');
        $this->addSql('ALTER TABLE technique ADD is_throw TINYINT(1) NOT NULL, DROP category, DROP video');
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C6484A3BF0');
        $this->addSql('DROP INDEX UNIQ_38BBA6C671179CD6 ON exam');
        $this->addSql('DROP INDEX IDX_38BBA6C6484A3BF0 ON exam');
        $this->addSql('ALTER TABLE exam ADD color VARCHAR(255) NOT NULL, DROP name_id, DROP exam_taker_id, DROP date');
    }
}
