Ext.define('Shopware.apps.Storagelocation', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.Storagelocation',

	loadPath: '{url controller="Storagelocation" action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'list.Window',
        'list.Storagelocation',
        'detail.Window',
        'detail.Storagelocation'
    ],

    models: [
        'Storagelocation'
    ],
    stores: [
        'Storagelocation'
    ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});