//

Ext.define('Shopware.apps.JkTheme.view.detail.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.detail-form',
    title: '{s name=jkTheme/form/title}Form{/s}',
    height: 600,
    id: 'configFormId',

    /**,
      * Contains snippets for the view component
      * @object
      */
    snippets: {
        fixNaviagation: {
            fieldLabel: '{s name=jkTheme/form/fixNaviagation/labelBox}Activate{/s}',
            boxLabel: '{s name=jkTheme/form/fixNaviagation/lableElement}Fix Navigation{/s}',
        },
        sloganText: '{s name=jkTheme/form/slogan}Slogan{/s}',
        shop: {
            id: '{s name=jkTheme/form/shopId}Shop Id{/s}',
            name: '{s name=jkTheme/form/shopId}Shop Name{/s}'
        },

    },
    layout: {
        type: 'vbox',
    },
    defaults: {
        labelWidth: 155,
        style: 'margin: 10px !important;',
        labelStyle: 'font-weight: 700;',
        anchor: '100%'
    },
    cls: 'shopware-form',

    initComponent: function () {
        var me = this;
        me.items = me.createItems();
        me.loadStore();
        me.callParent(arguments);
    },

    loadStore: function () {
        var me = this;
        var store = Ext.create('Shopware.apps.JkTheme.store.Config');
        store.getProxy().extraParams.shopId = me.shop.id;
        store.getProxy().extraParams.themeId = me.theme.id;
        store.load({

            callback: function (records, operation) {
                var storeData = records[0];
                me.loadRecord(storeData)
            }

        });


    },


    createItems: function () {
        var me = this;

        return [
            {
                xtype: 'checkboxfield',
                name: 'navigation',
                fieldLabel: me.snippets.fixNaviagation.fieldLabel,
                boxLabel: me.snippets.fixNaviagation.boxLabel,
                inputValue: 1,
                uncheckedValue: 0
            },
            {
                xtype: 'hiddenfield',
                name: 'shop',
                value: me.shop.id,
                fieldLabel: 'Shop ID'
            },
            {
                xtype: 'hiddenfield',
                name: 'theme',
                value: me.theme.id,
                fieldLabel: 'Shop ID'
            },
            {
                xtype: 'displayfield',
                name: 'shopName',
                value: me.shop.name,
                fieldLabel: 'Shop Name'
            },
            {
                xtype: 'displayfield',
                name: 'themeName',
                value: me.theme.name,
                fieldLabel:'Theme Name'
            },


        ];

    },

    readConfig: function (shopId) {

        var me = this;
        Ext.Ajax.request({
            url: '{url controller="JkTheme" action="read"}',
            method: 'POST',
            params: {

                shopJkTheme: shopId,
            },
            success: function (operation) {

                var response = Ext.decode(operation.responseText);

                var record = Ext.create('Shopware.apps.JkTheme.model.Config', response.config);
                if (response.success == true) {

                    me.loadRecord(record);

                } else {

                }

            }


        });
    }


}
);
