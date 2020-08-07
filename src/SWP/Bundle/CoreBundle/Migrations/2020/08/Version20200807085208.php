<?php declare(strict_types=1);

namespace SWP\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200807085208 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE swp_route ADD description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE swp_route ALTER paywall_secured DROP DEFAULT');
        $this->addSql('DROP INDEX swp_article_slug_null_deleted_at_idx');
        $this->addSql('DROP INDEX swp_article_slug_not_null_deleted_at_idx');
        $this->addSql('ALTER TABLE swp_article ALTER extra SET NOT NULL');
        $this->addSql('ALTER TABLE swp_article ALTER paywall_secured DROP DEFAULT');
        $this->addSql('CREATE UNIQUE INDEX swp_article_slug_null_deleted_at_idx ON swp_article (slug, tenant_code, organization_id) WHERE deleted_at IS NULL');
        $this->addSql('CREATE UNIQUE INDEX swp_article_slug_not_null_deleted_at_idx ON swp_article (slug, tenant_code, organization_id, deleted_at) WHERE deleted_at IS NOT NULL');
        $this->addSql('ALTER TABLE swp_output_channel DROP CONSTRAINT FK_AFE4D08F9033212A');
        $this->addSql('ALTER TABLE swp_output_channel ADD CONSTRAINT FK_AFE4D08F9033212A FOREIGN KEY (tenant_id) REFERENCES swp_tenant (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE swp_package ALTER organization_id SET NOT NULL');
        $this->addSql('ALTER TABLE swp_package ALTER genre TYPE TEXT');
        $this->addSql('ALTER TABLE swp_package ALTER genre DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN swp_package.genre IS \'(DC2Type:array)\'');
        $this->addSql('CREATE UNIQUE INDEX swp_package_guid_idx ON swp_package (guid)');
        $this->addSql('ALTER TABLE swp_publish_destination ALTER package_guid SET NOT NULL');
        $this->addSql('ALTER TABLE swp_publish_destination ALTER paywall_secured DROP DEFAULT');
        $this->addSql('ALTER TABLE swp_rule ALTER organization_id SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE swp_rule ALTER organization_id DROP NOT NULL');
        $this->addSql('DROP INDEX swp_package_guid_idx');
        $this->addSql('ALTER TABLE swp_package ALTER organization_id DROP NOT NULL');
        $this->addSql('ALTER TABLE swp_package ALTER genre TYPE TEXT');
        $this->addSql('ALTER TABLE swp_package ALTER genre DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN swp_package.genre IS NULL');
        $this->addSql('ALTER TABLE swp_route DROP description');
        $this->addSql('ALTER TABLE swp_route ALTER paywall_secured SET DEFAULT \'false\'');
        $this->addSql('DROP INDEX swp_article_slug_not_null_deleted_at_idx');
        $this->addSql('DROP INDEX swp_article_slug_null_deleted_at_idx');
        $this->addSql('ALTER TABLE swp_article ALTER extra DROP NOT NULL');
        $this->addSql('ALTER TABLE swp_article ALTER paywall_secured SET DEFAULT \'false\'');
        $this->addSql('CREATE UNIQUE INDEX swp_article_slug_not_null_deleted_at_idx ON swp_article (slug, tenant_code, organization_id, deleted_at) WHERE (deleted_at IS NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX swp_article_slug_null_deleted_at_idx ON swp_article (slug, tenant_code, organization_id) WHERE (deleted_at IS NULL)');
        $this->addSql('ALTER TABLE swp_publish_destination ALTER paywall_secured SET DEFAULT \'false\'');
        $this->addSql('ALTER TABLE swp_publish_destination ALTER package_guid DROP NOT NULL');
        $this->addSql('ALTER TABLE swp_output_channel DROP CONSTRAINT fk_afe4d08f9033212a');
        $this->addSql('ALTER TABLE swp_output_channel ADD CONSTRAINT fk_afe4d08f9033212a FOREIGN KEY (tenant_id) REFERENCES swp_tenant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}