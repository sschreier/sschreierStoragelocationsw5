Ext.define('Shopware.apps.Storagelocation.view.list.Storagelocation', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.storagelocation-listing-grid',
    region: 'center',

    configure: function() {
        return {
			detailWindow: 'Shopware.apps.Storagelocation.view.detail.Window',
			addButton: true,	
			editColumn: true,
			columns: {
				sl_id: { header: '{s name=StoragelocationListSlId}ID{/s}', width: 75, flex: 0},
				label: { header: '{s name=StoragelocationListLabel}Lagerort{/s}'}
            }
        };
    }
});