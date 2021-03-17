// This is the controller


Ext.define('Shopware.apps.JkTheme.controller.MyOwnController', {
    /**
     * Override the customer main controller
     * @string
     */
    override: 'Shopware.apps.Theme.controller.Detail',

    init: function () {
        var me = this;
        me.callParent(arguments);
    },

    saveConfig: function (theme, shop, formPanel, window) {
        var me = this;
        myStore = Ext.create('Shopware.apps.JkTheme.store.Config');
        var configForm = Ext.getCmp('configFormId');
        myStore.update({
            params: configForm.form.getValues(),
        });
        me.callParent(arguments);

    }



});
