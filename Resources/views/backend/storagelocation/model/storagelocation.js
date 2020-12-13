Ext.define('Shopware.apps.Storagelocation.model.Storagelocation', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'Storagelocation',
			detail: 'Shopware.apps.Storagelocation.view.detail.Storagelocation'
        };
    },
    fields: [
		{ name : 'id' },
		{ name : 'sl_id' },
        { name : 'label', type: 'string' }
    ]
});