Ext.define('Shopware.apps.Storagelocation.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.storagelocation-list-window',
    height: 500,
    width: 1000,
    title: '{s name=StoragelocationListTitle}Lagerorte{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.Storagelocation.view.list.Storagelocation',
            listingStore: 'Shopware.apps.Storagelocation.store.Storagelocation'
        };
    }
});