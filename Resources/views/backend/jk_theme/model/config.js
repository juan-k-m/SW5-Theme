//
Ext.define('Shopware.apps.JkTheme.model.Config', {
    extend: 'Ext.data.Model',
    fields: [

        { name: 'navigation', type: 'boolean' },
        { name: 'shop', type: 'int'},
        { name: 'theme', type: 'int'},
        { name: 'id', type: 'int' },


    ],

    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="JkTheme" action="read"}',
            update: '{url controller="JkTheme" action="update"}',

        },
        reader: {
            type: 'json',
            root: 'config',
            totalProperty:'total',
        }
    }
});
