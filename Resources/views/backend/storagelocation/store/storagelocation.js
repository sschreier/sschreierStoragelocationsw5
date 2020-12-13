Ext.define('Shopware.apps.Storagelocation.store.Storagelocation', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return { controller: 'Storagelocation' };
    },
    model: 'Shopware.apps.Storagelocation.model.Storagelocation'
});