<?php
/**
 * One time setup for database tables: photosets, photos and photourl.
 *
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketing.io)
 * @package HayesMarketing_Gallery
 */

namespace HayesMarketing\Gallery\Setup;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        //START table 'hayesmarketing_gallery_photosets' setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('hayesmarketing_gallery_photosets')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true ],
            'Entity ID'
        )->addColumn(
            'album_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_BIGINT,
            null,
            [ 'nullable' => false, 'unsigned' => true],
            'Photoset ID'
        )->addColumn(
            'photo_url',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, 'unsigned' => true],
            'Primary Photo URL'
        )->addColumn(
            'url_key',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false],
            'Photoset URL Key'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false],
            'Photoset Title'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '1', ],
            'Is Active'
        );
        $installer->getConnection()->createTable($table);
        //END table 'hayesmarketing_gallery_photosets' setup

        //START table 'hayesmarketing_gallery_photos' setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('hayesmarketing_gallery_photos')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'photo_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_BIGINT,
            null,
            [ 'nullable' => false, 'unsigned' => true ],
            'Photo ID'
        )->addColumn(
            'album_url',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, 'unsigned' => true ],
            'Album URL'
        )->addColumn(
            'photo_url',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Photo URL'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => true],
            'Photo Title'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        );
        $installer->getConnection()->createTable($table);
        //END table 'hayesmarketing_gallery_photos' setup

        $installer->endSetup();
    }
}