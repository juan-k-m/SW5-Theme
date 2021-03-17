// This tab will be shown in the customer module

Ext.define('Shopware.apps.JkTheme.view.detail.MyOwnTab', {
    extend: 'Ext.container.Container',
    padding: 10,
    alias: 'widget.detail-tab',
    title: 'MyOwnTab',


    initComponent: function() {
        var me = this;
        me.items  =  [

            me.createForm(),

        ];

        me.callParent(arguments);
    },

    createForm: function () {
        var me = this;
        return Ext.create('Shopware.apps.JkTheme.view.detail.Form', {
            shop: me.shop,
            theme: me.theme,
        });

    }

});
