//{block name="backend/theme/view/detail/window" append}
Ext.define('Shopware.apps.JkTheme.view.detail.Juank', {
    override: 'Shopware.apps.Theme.view.detail.Window',

    initComponent: function () {
        var me = this;
        me.createExtrasTab();
        me.callParent(arguments);

    },

    /**
     * Creates the 'Extras' tab.
     * @returns { Ext.container.Container }
     */
    createExtrasTab: function () {
        var me = this;
        console.log(me.shop.data);
        console.log(me.theme);
        me.configLayout[0].items.splice(6, 0, {
            title: 'Extras',
            bodyPadding: 0,
            xtype: 'detail-tab',
            shop: {
                id: me.shop.data.id,
                name:me.shop.data.name,
                themeId:me.theme.id
            },
            theme: {
                id: me.theme.data.id,
                name: me.theme.data.name

            }
        });

    },


});
//{/block}